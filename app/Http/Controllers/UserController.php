<?php

namespace App\Http\Controllers;

use App\Models\Smm;
use App\Models\User;
use App\Models\Config;
use App\Models\Favorit;
use App\Models\Session;
use App\Models\Category;
use App\Models\LogMasuk;
use App\Helpers\Encryption;
use Illuminate\Http\Request;
use chillerlan\QRCode\QRCode;
use PragmaRX\Google2FA\Google2FA;
use App\Models\LayananRekomendasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {
        $session = Session::where('id', session()->getId())->first();
        if ($session) {

            if ($session->last_login == null) {
                $session->last_login = strtotime(date('Y-m-d H:i:s'));
                $session->save();
            }
        }

        $layananRekomendasi = LayananRekomendasi::with(['smm' => function ($query) {
            $query->where('status', 'aktif')->orderBy('price', 'asc');
        }])->paginate(2);
        // dd($layananRekomendasi->first());

        return view('user.dashboard', compact('layananRekomendasi'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect('auth/login');
    }
    public function logLogin()
    {
        $log = LogMasuk::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('user.log-login', compact('log'));
    }
    public function logBalance()
    {
        return view('user.log-balance');
    }
    public function dokumentasi()
    {
        return view('user.dokumentasi_api');
    }
    public function authentication()
    {
        $config = Config::first();
        $google = new Google2FA();
        $secret = $google->generateSecretKey();
        $email = auth()->user()->email;
        $app = $config->name_panel;

        $url = $google->getQRCodeUrl($app, $email, $secret);
        $currentOTP = $google->getCurrentOtp($secret);
        $qr = new QRCode();
        $render = $qr->render($url);
        return view('user.authentication', compact('render', 'secret'));
    }
    public function prosesAuthentication(Request $request)
    {
        $request->validate(
            [
                'password' => 'required',
            ],

            [
                'password.required' => 'Password harus diisi'
            ]
        );
        $google = new Google2FA();
        $secret = $request->secret;
        $currentOTP = $google->getCurrentOtp($secret);
        $user = User::find(auth()->id());
        if (!password_verify($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Password salah');
        } else {
            if ($google->verifyKey($secret, $request->token)) {
                $user->google2fa = '1';
                $user->secret_google = $secret;
                $user->save();
                return redirect()->back()->with('success', 'Authentication berhasil diaktifkan');
            } else {
                return redirect()->back()->with('error', 'Kode verifikasi salah');
            }
        }
    }
    public function disableAuthentication()
    {
        $user = User::find(auth()->id());
        $user->google2fa = '0';
        $user->secret_google = null;
        $user->save();
        return redirect('account/authentication')->with('success', 'Authentication berhasil dinonaktifkan');
    }
    public function pengaturan()
    {
        return view('user.pengaturan');
    }
    public function changeData(Request $request)
    {
        $request->validate(
            [
                'full_name' => 'required',
                'password' => 'required',
            ],
            [
                'full_name.required' => 'Nama lengkap harus diisi',
                'password.required' => 'Password harus diisi',
            ]
        );
        $user = User::find(auth()->id());
        if (!password_verify($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Password salah');
        } else {
            $user->name = $request->full_name;
            $user->save();
            return redirect()->back()->with('success', 'Data berhasil diubah');
        }
    }
    public function keamanan()
    {
        return view('user.keamanan');
    }
    public function secretKey(Request $request)
    {
        $request->validate([
            'secret_key' => 'required',
            'password' => 'required'
        ]);
        if (password_verify($request->password, Auth::user()->password)) {
            User::where('id', Auth::user()->id)->update([
                'secret_key' => Encryption::encrypt($request->secret_key)
            ]);
            return redirect()->back()->with('success', 'Secret key berhasil diubah');
        } else {
            return redirect()->back()->with('error', 'Password salah');
        }
    }
    public function whitelistIp(Request $request)
    {
        if (Auth::attempt(['username' => Auth::user()->username, 'password' => $request->password])) {
            $user = User::where('id', Auth::user()->id)->first();
            $ip = $request->whitelist_ip;
            $ip = explode(',', $ip);
            $ip = array_map('trim', $ip);
            $ip = array_filter($ip);
            $ip = array_unique($ip);
            $ip = implode(',', $ip);
            $user->whitelist_ip = $ip;
            if ($user->save()) {
                return redirect()->back()->with('success', 'Whitelist IP berhasil diubah');
            } else {
                return redirect()->back()->with('error', 'Whitelist IP gagal diubah');
            }
        } else {
            return redirect()->back()->with('error', 'Password salah');
        }
    }
    public function bot()
    {
        return view('user.bot');
    }
    public function session()
    {
        return view('user.session');
    }
    public function news()
    {
        return view('user.berita');
    }
}
