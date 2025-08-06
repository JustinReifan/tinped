<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bot;
use App\Models\Smm;
use App\Mail\Forgot;
use App\Mail\Verify;
use App\Models\User;
use App\Models\Config;
use App\Models\LogMasuk;
use App\Models\Referral;
use App\Models\LevelUser;
use App\Models\UserVerify;
use App\Helpers\Encryption;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Session\Middleware\StartSession;

class AuthController extends Controller
{
    public function landing(Request $request)
    {
        $allowedSocialMedia = ['facebook', 'instagram', 'tiktok', 'youtube', 'twitch', 'twitter', 'website'];

        // Ambil 1 harga termurah untuk setiap kata pertama kategori
        $results = Smm::select(DB::raw('SUBSTRING_INDEX(category, " ", 1) as first_word'), DB::raw('MIN(price) as min_price'))
            ->groupBy('first_word')
            ->get();

        // Siapkan array asosiatif untuk menyimpan hasil
        $socialMediaPrices = [];

        // Filter dan simpan data ke dalam array
        foreach ($results as $result) {
            if (in_array(strtolower($result->first_word), $allowedSocialMedia)) {
                $socialMediaPrices[$result->first_word] = $result->min_price;
            }
        }

        // Output hasil
        // dump($socialMediaPrices);
        // die;
        return view('landing.index', [
            'servicesPrices' => $socialMediaPrices
        ]);
    }
    public function login()
    {
        if (!headers_sent()) {
            setcookie('google', '', time() - 3600, '/');
        } else {
            // Opsional: Logging atau debugging
            error_log("Headers already sent, cannot modify cookies.");
        }
        return view('auth.login');
    }
    public function prosesLogin(Request $request)
    {
        $username = $request->input('username');
        $email = $request->input('username');
        $password = $request->input('password');
        $remember = $request->input('remember');
        if (!$username || !$password) {
            return redirect()->back()->with('error', 'Username atau password harus diisi');
        }
        $user = User::where('username', $username)->orWhere('email', $email)->first();
        if ($user) {
            if ($user->status == 'banned') {
                return redirect()->back()->with('error', 'Akun anda diblokir');
            } elseif ($user->status == 'nonverif') {
                return redirect()->back()->with('error', 'Akun anda belum diverifikasi');
            }
        }
        if (env('CLOUDFLARE_SITEKEY') != null && env('CLOUDFLARE_SECRETKEY') != null) {
            $verify = verifyCloudflare($request['cf-turnstile-response']);
            if ($verify == false) {
                return redirect()->back()->with('error', 'Verifikasi cloudflare gagal');
            }
        }
        if (auth()->attempt(['username' => $username, 'password' => $password], $remember)) {
            if ($user->google2fa == '1') {
                $user->is_verified = '0';
                $user->save();
            }
            LogMasuk::create([
                'user_id' => Auth::user()->id,
                'ip' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);
            return redirect()->route('dashboard');
        } elseif (auth()->attempt(['email' => $email, 'password' => $password], $remember)) {
            if ($user->google2fa == '1') {
                $user->is_verified = '0';
                $user->save();
            }
            LogMasuk::create([
                'user_id' => Auth::user()->id,
                'ip' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Username atau password salah');
        }
    }
    public function reff(Referral $referral)
    {
        setcookie('referral', $referral->code, time() + 3600, '/');
        $referral = Referral::where('code', $referral->code)->first();
        if ($referral) {
            $referral->visitors = $referral->visitors + 1;
            $referral->save();
        }
        return redirect('auth/register');
    }
    public function register()
    {
        if (isset($_COOKIE['google'])) {
            $cookie = explode('|', $_COOKIE['google']);
        } else {
            $cookie = null;
        }
        return view('auth.register', compact('cookie'));
    }
    public function prosesRegister(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|unique:users,email',
                'full_name' => 'required|string',
                'whatsapp' => 'required|numeric|min:15',
                'username' => 'required|unique:users,username',
                'password' => 'required|string|min:6',
                'cpassword' => 'required|same:password',
                'gender' => 'required|string',
                'timezone' => 'required|string',
            ],
            [
                'email.required' => 'Email harus diisi',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'full_name.required' => 'Nama lengkap harus diisi',
                'full_name.string' => 'Nama lengkap harus berupa huruf',
                'whatsapp.required' => 'Nomor whatsapp harus diisi',
                'whatsapp.numeric' => 'Nomor whatsapp harus berupa angka',
                'whatsapp.min' => 'Nomor whatsapp minimal 15 digit',
                'username.required' => 'Username harus diisi',
                'username.unique' => 'Username sudah terdaftar',
                'password.required' => 'Password harus diisi',
                'password.string' => 'Password harus berupa huruf',
                'password.min' => 'Password minimal 6 karakter',
                'cpassword.required' => 'Konfirmasi password harus diisi',
                'cpassword.same' => 'Konfirmasi password tidak sama dengan password',
                'gender.required' => 'Jenis kelamin harus diisi',
                'gender.string' => 'Jenis kelamin harus berupa huruf',
                'timezone.required' => 'Zona waktu harus diisi',
            ]
        );
        if (env('CLOUDFLARE_SITEKEY') != null && env('CLOUDFLARE_SECRETKEY') != null) {
            $verify = verifyCloudflare($request['cf-turnstile-response']);
            if ($verify == false) {
                return redirect()->back()->with('error', 'Verifikasi cloudflare gagal');
            }
        }
        if ($request->tos != 'on') {
            return redirect()->back()->with('error', 'Anda harus menyetujui syarat dan ketentuan');
        } else {
            if (substr($request->whatsapp, 0, 2) != '62') {
                return redirect()->back()->with('error', 'Nomor whatsapp harus diawali dengan 62');
            }
            $referral = $_COOKIE['referral'] ?? random(6);

            $config = Config::first();
            $decode = json_decode($config->konfigurasi_mail);
            $code = random(20);
            if ($decode->send_mail == true && !isset($_COOKIE['google'])) {
                try {
                    $mailData = [
                        'name' => $request->full_name,
                        'link' => url('verify-user/verify/' . $code),
                    ];
                    $mailSent = Mail::to($request->email)->send(new Verify($mailData));
                    UserVerify::create([
                        'type' => 'verify',
                        'email' => $request->email,
                        'token' => $code,
                        'expired_at' => Carbon::parse(date('Y-m-d H:i:s'))->addMinutes(15),
                    ]);
                    $status = 'nonverif';
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Gagal mengirim email, silahkan coba lagi');
                }
            } else {
                $status = 'active';
            }
            $level = LevelUser::where('default', '1')->first();
            User::create([
                'name' => $request->full_name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'whatsapp' => $request->whatsapp,
                'api_key' => Encryption::encrypt(random(5) . '-' . random(5) . '-' . random(5) . '-' . random(5)),
                'api_id' => rand(1000, 9999),
                'balance' => 0,
                'omzet' => 0,
                'level' => strtolower($level->name),
                'role' => 'user',
                'referral' => $referral,
                'is_mail' => $decode->send_mail == true ? '0' : '1',
                'gender' => $request->gender,
                'zona' => $request->timezone,
                'status' => $status,
            ]);

            if (isset($_COOKIE['referral'])) {
                $code = $_COOKIE['referral'];
                $referral = Referral::where('code', $code)->first();
                if ($referral) {
                    $referral->registered = $referral->registered + 1;
                    $referral->save();
                }
            }

            if ($status == 'active') {
                return redirect('auth/login')->with('success', 'Registrasi berhasil, silahkan login');
            } else {
                return redirect('auth/login')->with('success', 'Registrasi berhasil, silahkan check email untuk verifikasi');
            }
        }
    }
    public function forgot()
    {
        return view('auth.forgot');
    }
    public function prosesForgot(Request $request)
    {
        if (env('CLOUDFLARE_SITEKEY') != null && env('CLOUDFLARE_SECRETKEY') != null) {
            $verify = verifyCloudflare($request['cf-turnstile-response']);
            if ($verify == false) {
                return redirect()->back()->with('error', 'Verifikasi cloudflare gagal');
            }
        }
        $user = User::where('username', $request->username)->orWhere('email', $request->username)->first();
        if ($user) {
            $random = random(20);
            $mailData = [
                'name' => $user->name,
                'link' => url('verify-user/forgot/' . $random),
            ];
            if ($request->method == 'email') {
                $config = Config::first();
                $decode = json_decode($config->konfigurasi_mail, true);
                if ($decode['send_mail'] == false) {
                    return redirect()->back()->with('error', 'Fitur email belum tersedia');
                }
                $mailSent = Mail::to($user->email)->send(new Forgot($mailData));
                if ($mailSent) {
                    UserVerify::create([
                        'type' => 'forgot',
                        'email' => $user->email,
                        'token' => $random,
                        'expired_at' => Carbon::parse(date('Y-m-d H:i:s'))->addMinutes(15),
                    ]);
                    return redirect()->back()->with('success', 'Silahkan cek email anda untuk reset password');
                } else {
                    return redirect()->back()->with('error', 'Gagal mengirim email, silahkan coba lagi');
                }
            } else {
                $bot = Bot::where('user_id', $user->id)->where('type', 'whatsapp')->where('status', '1')->first();
                if ($bot) {
                    $mailData['user_id'] = $user->id;
                    $response = Senderwhatsapp('forgot_password', $mailData);
                    $decode = json_decode($response, true);
                    if (isset($decode['status']) && $decode['status'] == 'ok') {
                        UserVerify::create([
                            'type' => 'forgot',
                            'email' => $user->email,
                            'token' => $random,
                            'expired_at' => Carbon::parse(date('Y-m-d H:i:s'))->addMinutes(15),
                        ]);
                        return redirect()->back()->with('success', 'Silahkan cek whatsapp anda untuk reset password');
                    } else {
                        return redirect()->back()->with('error', 'Gagal mengirim whatsapp, silahkan coba lagi');
                    }
                } else {
                    return redirect()->back()->with('error', 'Anda belum mengatur bot whatsapp');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Username atau email tidak terdaftar');
        }
    }
    public function verifyUser($type, $token)
    {
        $verify = UserVerify::where('token', $token)->where('type', $type)->first();
        if ($verify->expired_at < Carbon::parse(date('Y-m-d H:i:s'))) {
            return redirect('auth/login')->with('error', 'Token sudah kadaluarsa');
        }
        if ($type == 'verify') {
            $user = User::where('email', $verify->email)->first();
            if ($user) {
                $user->status = 'active';
                $user->save();
            }
            $verify->delete();
            return redirect('auth/login')->with('success', 'Email berhasil diverifikasi');
        } elseif ($type == 'forgot') {
            return view('auth.reset', compact('token', 'verify'));
        } else {
            return redirect('auth/login')->with('error', 'Token tidak valid');
        }
    }
    public function resetPassword(Request $request)
    {
        $request->validate(
            [
                'new_password' => 'required|string|min:6',
                'confirm_password' => 'required|same:new_password',
            ],
            [
                'new_password.required' => 'Password baru harus diisi',
                'new_password.string' => 'Password baru harus berupa huruf',
                'new_password.min' => 'Password baru minimal 6 karakter',
                'confirm_password.required' => 'Konfirmasi password harus diisi',
                'confirm_password.same' => 'Konfirmasi password tidak sama dengan password baru',
            ]
        );
        if (env('CLOUDFLARE_SITEKEY') != null && env('CLOUDFLARE_SECRETKEY') != null) {
            $verify = verifyCloudflare($request['cf-turnstile-response']);
            if ($verify == false) {
                return redirect()->back()->with('error', 'Verifikasi cloudflare gagal');
            }
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $verify = UserVerify::where('email', $request->email)->where('type', 'forgot')->delete();
            $user->password = bcrypt($request->new_password);
            $user->save();
            return redirect('auth/login')->with('success', 'Password berhasil diubah');
        } else {
            return redirect('auth/login')->with('error', 'Email tidak terdaftar');
        }
    }
    public function authenticate()
    {
        if (auth()->user()->is_verified == '1') {
            return redirect('dashboard');
        }
        return view('auth.authenticate');
    }
    public function authenticateVerify(Request $request)
    {
        if (!$request->code) {
            return response()->json([
                'status' => false,
                'message' => 'Code authenticator harus diisi'
            ]);
        }
        $google = new Google2FA();
        $user = User::find(auth()->id());
        if ($google->verifyKey($user->secret_google, $request->code)) {
            $user->is_verified = '1';
            $user->save();
            return response()->json([
                'status' => true,
                'message' => 'Verifikasi berhasil',
                'direct' => 'dashboard'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Code authenticator salah'
            ]);
        }
    }
    public function googleRedirect($type, Request $request)
    {
        setcookie('type', $type, time() + 3600, '/');
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();

        $cekuser = User::where('email', $user->email)->first();
        $cookie = $_COOKIE['type'] ?? null;
        if ($cookie == 'register') {
            if ($cekuser) {
                return redirect('auth/register')->with('error', 'Email sudah terdaftar,silahkan login menggunakan email dan password');
            } else {
                $cookie = $user->name . '|' . $user->email . '|' . $user->avatar;
                setcookie('google', $cookie, time() + 3600, '/');
                return redirect('auth/register')->with('google', 'Berhasil daftar menggunakan google, silahkan lengkapi data berikut');
            }
        } else {
            if ($cekuser) {
                auth()->login($cekuser);
                LogMasuk::create([
                    'user_id' => Auth::user()->id,
                    'ip' => $request->ip(),
                    'user_agent' => $request->header('User-Agent'),
                ]);
                return redirect('auth/login');
            } else {
                return redirect('auth/login')->with('error', 'Email tidak terdaftar');
            }
        }
    }
}
