<?php

use Pusher\Pusher;
use App\Models\User;
use App\Helpers\Encryption;
use Illuminate\Support\Str;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CronjobController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ReferralController;


Route::middleware('guest')->group(function () {
    Route::get('/', AuthController::class . '@landing')->name('landing');

    Route::get('add-user', function () {
        $jsonUser = Storage::get('json/users.json');
        $contentUser = json_decode($jsonUser, true);
        $dataUser = $contentUser[2]['data'];

        $jsonUserApi = Storage::get('json/users_api.json');
        $contentUserApi = json_decode($jsonUserApi, true);
        $dataUserApi = $contentUserApi[2]['data'];

        $arrayData = [];
        User::truncate();
        foreach ($dataUser as $d) {
            foreach ($dataUserApi as $dApi) {
                if ($d['username'] == $dApi['user']) {
                    $params = [
                        'name' => $d['name'],
                        'username' => $d['username'],
                        'email' => $d['email'],
                        'password' => $d['password'],
                        'whatsapp' => $d['phone'],
                        'remember_token' => null,
                        'api_key' => Encryption::encrypt(random(5) . '-' . random(5) . '-' . random(5) . '-' . random(5)),
                        'api_id' => rand(1000, 9999),
                        'google2fa' => '0',
                        'secret_google' => null,
                        'is_verified' => '0',
                        'balance' => $d['balance'],
                        'omzet' => 0,
                        'whitelist_ip' => $dApi['whitelist'] ?? null,
                        'level' => 'Basic',
                        'is_referral' => '0',
                        'is_mail' => '1',
                        'referral' => $d['referral'],
                        'gender' => 'male',
                        'zona' => 'Asia/Jakarta',
                        'image' => null,
                        'status' => (string) $d['status'] != 'active' ? 'banned' : 'active',
                    ];

                    if ($d['level'] == 'Admin') {
                        $params['role'] = 'admin';
                    } else if ($d['level'] == 'Premium') {
                        $params['role'] = 'reseller';
                    } else {
                        $params['role'] = 'user';
                    }
                    User::create($params);
                    // $arrayData[] = $params;
                }
            }
        }
        // dump($arrayData);
    });
    Route::controller(HomeController::class)->group(function () {
        Route::get('list-layanan', 'listLayanan')->name('home.list.layanan');
        Route::get('pemesanan', 'pemesanan')->name('pemesanan');
        Route::post('categoy-filter', 'filterCategory')->name('filter');
        Route::post('ambil-layanan', 'getLayanan')->name('ambil.layanan');
        Route::post('ambil/deskripsi', 'getDeskripsi')->name('ambil.detail.layanan');
        Route::post('ambil/metode', 'get_methode')->name('ambil.metode');
        Route::post('proses-order', 'prosesOrder')->name('proses.order');
        Route::get('invoice/{order_id}', 'invoice')->name('home.invoice');
    });
});
Route::get('dokumentasi-api', [UserController::class, 'dokumentasi'])->name('dokumentasi');
Route::controller(HomeController::class)->group(function () {
    Route::prefix('sitemap')->group(function () {
        Route::get('kontak', 'kontak')->name('sitemap.kontak');
        Route::get('ketentuan-layanan', 'ketentuanLayanan')->name('ketentuan.layanan');
        Route::get('contoh-pesanan', 'contohPesanan')->name('contoh.pesanan');
    });
    Route::get('return-invoice', 'returnInvoice');
});
Route::post('detail/service', OrderController::class . '@detailService')->name('detail.service');
Route::controller(AuthController::class)->middleware('guest')->group(function () {
    Route::get('auth/login', 'login')->name('login');
    Route::post('proses/login', 'prosesLogin');
    Route::get('reff/{referral:code}', 'reff');
    Route::get('auth/register', 'register')->name('register');
    Route::post('proses/register', 'prosesRegister');
    Route::get('auth/forgot', 'forgot')->name('forgot');
    Route::post('proses-forgot', 'prosesForgot');
    Route::get('verify-user/{forgot}/{token}', 'verifyUser');
    Route::post('proses/reset-password', 'resetPassword');
    Route::get('auth/google/redirect/{type}', 'googleRedirect');
    Route::get('auth/google/callback', 'googleCallback');
});
Route::get('authenticate', AuthController::class . '@authenticate')->name('authenticate');
Route::post('proses/authenticator', AuthController::class . '@authenticateVerify')->name('proses.authenticate');
Route::middleware('auth')->group(function () {
    Route::controller(UserController::class)->group(function () {
        // Route::get('/', '')
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('kontak-kami', 'kontak')->name('kontak');
        Route::get('page/log-login', 'logLogin')->name('log.login');
        Route::get('page/log-balance', 'logBalance')->name('log.balance');

        Route::get('news/berita', 'news')->name('user.berita');
        Route::get('logout', 'logout')->name('logout');
    });
    Route::controller(OrderController::class)->group(function () {
        // Main page after login - redirect to single order page
        Route::get('order/single', 'single')->name('order.single');
        Route::post('get/layanan', 'getLayanan')->name('get.layanan');
        Route::post('get/service/search-id', 'getLayananSearchId')->name('search-id');
        Route::post('get/layanan/massal', 'getLayananMassal')->name('get.layanan.massal');
        Route::post('filterCategory', 'filterCategory')->name('filterCategory');
        Route::post('get/deskripsi', 'getDeskripsi')->name('get.detail.layanan');
        Route::post('order/single-proses', 'Singleproses')->name('single.proses');
        Route::get('order/massal', 'massal')->name('order.massal');
        Route::post('order/massal-proses', 'massalProses')->name('massal.proses');
        Route::get('order/history', 'riwayat')->name('history');
        Route::post('history/detail', 'historyDetail')->name('history.detail');
        Route::post('history/detail-order', 'historyDetailOrder')->name('history.detail.order');
        Route::post('history/update-pesanan', 'updatePesanan')->name('update.pesanan');
        Route::post('order/refill', 'refill')->name('refill');
        Route::post('order/cancel', 'cancel')->name('cancel');
        Route::get('history/refill', 'riwayatRefill')->name('history.refill');
        Route::post('refill/detail', 'refillDetail')->name('refill.detail');
        Route::get('list/layanan', 'listLayanan')->name('list.layanan');
        Route::post('rating/service', 'ratingService')->name('rating.service');
        Route::post('submit-rating', 'submitRatings')->name('rating.service');
        Route::post('favorit/service', 'favoritService')->name('favorit.service');
        Route::post('unfav/service', 'unfavService')->name('unfav.service');
        Route::post('get/layanan/favorite', 'getLayananFavorite')->name('get.layanan.favorite');
        Route::post('get/layanan/recommended', 'getLayananRecommended')->name('get.layanan.recommended');
        Route::get('layanan/favorit', 'LayananFavorit')->name('list.layanan');
        Route::post('favorit/delete', 'favoritDelete')->name('favorit.delete');
    });

    Route::controller(DepositController::class)->prefix('deposit')->group(function () {
        Route::get('new', 'deposit')->name('deposit');
        Route::post('get-methode', 'get_methode')->name('get.methode');
        Route::post('bonus', 'get_bonus')->name('deposit.bonus');
        Route::post('get-fees', 'get_fee')->name('deposit.fees');
        Route::post('proses', 'proses_deposit')->name('proses.deposit');
        Route::get('invoice/{deposit:trxid}', 'invoice')->name('invoice');
        Route::post('cancel', 'cancel')->name('deposit.cancel');
        Route::post('canceled', 'update_status_deposit')->name('canceled');
        Route::get('history', 'history')->name('deposit.history');
    });

    Route::controller(TicketController::class)->prefix('ticket')->group(function () {
        Route::get('new', 'new')->name('ticket.new');
        Route::post('proses', 'proses')->name('ticket.proses');
        Route::get('chat/{ticket:ticket_id}', 'chat')->name('ticket.chat');
        Route::post('send/message/ticket', 'sendMessageTicket')->name('send.message');
        Route::get('list', 'history')->name('ticket.history');
        Route::post('detail', 'detail')->name('ticket.detail');
        Route::post('reply', 'reply')->name('ticket.reply');
    });

    Route::controller(UserController::class)->prefix('account')->group(function () {
        Route::get('authentication', 'authentication')->name('account.authentication');
        Route::post('proses-authentication', 'prosesAuthentication')->name('proses.authentication');
        Route::get('disable-authentication', 'disableAuthentication')->name('disable.authentication');
        Route::get('pengaturan', 'pengaturan')->name('account.pengaturan');
        Route::post('change-data', 'changeData')->name('change.data');
        Route::get('keamanan', 'keamanan')->name('account.keamanan');
        Route::get('session', 'session')->name('account.session');
        Route::post('resetapi', function () {
            $user = User::find(auth()->user()->id);
            $user->api_key = Encryption::encrypt(Str::random(35));
            $user->save();
            return response()->json([
                'status' => true,
                'message' => 'Berhasil reset api key',
            ]);
        });
        Route::post('update/secret-key', 'secretKey')->name('secret.key');
        Route::post('update/whitelist-ip', 'whitelistIp')->name('whitelist.ip');
        Route::get('bot', 'bot')->name('account.bot');
    });
    Route::controller(ReferralController::class)->prefix('referral')->group(function () {
        Route::get('/', 'index')->name('referral');
        Route::post('withdraw', 'withdraw')->name('referral.withdraw');
    });
});
Route::middleware(isAdmin::class, 'auth')->group(function () {
    Route::controller(AdminController::class)->prefix('admin')->group(function () {
        Route::get('/', 'dashboard')->name('admin.dashboard');
        Route::prefix('konfigurasi')->group(function () {
            Route::get('website', 'configWebsite')->name('config.website');
            Route::get('payment-konfigurasi', 'paymentConfig')->name('payment.config');
            Route::get('level', 'level')->name('level');
            Route::get('bot', 'bot')->name('bot');
            Route::get('provider', 'provider')->name('provider');
            Route::post('set_profit', 'setProfit')->name('set.profit');
            Route::post('add-database', 'addDatabase')->name('add.database');
            Route::post('edit-provider', 'editProvider')->name('edit.provider');
            Route::post('setting-profit', 'settingProfit')->name('setting.profit');
            Route::post('update-provider', 'updateProvider')->name('update.provider');
            Route::post('get-setting', 'getSetting')->name('get.setting');
        });
        Route::get('berita', 'berita')->name('berita');
        Route::get('tambah-berita', 'tambahBerita')->name('tambah.berita');
        Route::get('tiket', 'tiket')->name('tiket');
        Route::get('tiket/chat/{ticket:ticket_id}', 'chat')->name('tiket.chat');
        Route::get('deposit', 'deposit')->name('admin.deposit');
        Route::prefix('pemesanan')->group(function () {
            Route::get('konfigurasi', 'konfigurasi')->name('pemesanan.konfigurasi');
            Route::get('riwayat', 'riwayat')->name('pemesanan.riwayat');
            Route::get('riwayat-manual', 'riwayatManual')->name('pemesanan.riwayat.manual');
            Route::get('riwayat-refill', 'riwayatRefill')->name('pemesanan.riwayat.refill');
            Route::get('riwayat-nonlogin', 'riwayatNonlogin')->name('pemesanan.riwayat.nonlogin');
        });
        Route::prefix('layanan')->group(function () {
            Route::get('category', 'category')->name('category');
            Route::get('konfigurasi', 'konfigurasiLayanan')->name('layanan.konfigurasi');
            Route::get('rekomendasi', 'rekomendasi')->name('layanan.rekomendasi');
            Route::get('icon', 'icon')->name('layanan.icon');
            Route::post('edit-icon', 'editIcon')->name('edit.icon');
            Route::post('search-icon', 'searchIcon')->name('search.icon');
        });
        Route::prefix('referral')->group(function () {
            Route::get('konfigurasi', 'konfigurasiReferral')->name('referral.konfigurasi');
            Route::get('list-referral', 'listReferral')->name('referral.list');
            Route::get('withdraw', 'withdraw')->name('referral.withdraw');
        });
        Route::get('landing-page', 'landingPage')->name('landing.page');
        Route::post('page-2', 'page2')->name('page2');
        Route::post('page-3', 'page3')->name('page3');
        Route::get('manage-users', 'manageUsers')->name('manage.users');
        Route::get('sitemap', 'sitemap')->name('sitemap');
        Route::get('log-masuk', 'logMasuk')->name('log.masuk');
        Route::get('log-saldo', 'logSaldo')->name('log.saldo');
    });
});
Route::controller(CronjobController::class)->prefix('cronjob')->group(function () {
    Route::get('metode-payment', 'MetodePayment');
    Route::get('layanan', 'layanan');
    Route::get('layanan/{nama}', 'layanans');
    Route::get('category', 'category');
    Route::get('status-pesanan', 'status_pesanan');
    Route::get('status-refill', 'status_refill');
    // Route::post('tripayCallback', 'tripayCallback');
});
function sendmessage($data)
{
    $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
    );

    $pusher = new Pusher(
        env('PUSHER_APP_KEY'),
        env('PUSHER_APP_SECRET'),
        env('PUSHER_APP_ID'),
        $options
    );
    $pusher->trigger('chat', 'chat-live', $data);
}
// API route to hide the guide for users
Route::post('/api/hide-guide', function () {
    session(['hide_guide' => true]);
    return response()->json(['status' => 'success']);
})->middleware('auth');

Route::get('decrypt', function () {
    return view('user.decrypt');
});
