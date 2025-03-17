<?php

namespace App\Http\Controllers;

use App\Models\IconLayanan;
use App\Models\Landing;
use App\Models\Provider;
use App\Models\Smm;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function configWebsite()
    {
        return view('admin.configWebsite');
    }
    public function paymentConfig()
    {
        return view('admin.payment-config');
    }
    public function berita()
    {
        return view('admin.berita');
    }
    public function tambahBerita()
    {
        return view('admin.tambah_berita');
    }
    public function level()
    {
        return view('admin.level');
    }
    public function provider()
    {
        if (env('LOCK_PROVIDER') != null) {
            return abort(404);
        }
        return view('admin.provider');
    }
    public function bot()
    {
        return view('admin.bot');
    }
    public function setProfit(Request $request)
    {
        $provider = Provider::find($request->id);
        if ($provider) {

            $existingData = $provider->json ? json_decode($provider->profit, true) : [];
            $updatedData = [
                '1' => array_merge($existingData['1'] ?? [], $request['1']),
                '2' => array_merge($existingData['2'] ?? [], $request['2']),
                '3' => array_merge($existingData['3'] ?? [], $request['3']),
                '4' => array_merge($existingData['4'] ?? [], $request['4']),
            ];
            $provider->update([
                'profit' => json_encode($updatedData),
            ]);
            return redirect()->back()->with('success', 'Profit berhasil diupdate.');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }
    public function addDatabase(Request $request)
    {
        $provider = Provider::find($request->id_provider);
        if ($provider) {
            $existingData = $provider->json ? json_decode($provider->json, true) : [];
            $updatedData = [
                'provider_id' => $request->provider_id,
                'provider_key' => $request->provider_key,
                'provider_secret' => $request->provider_secret,
                'default_type' => $request->default_type,
                'endpoint' => array_merge($existingData['endpoint'] ?? [], $request->endpoint),
                'permintaan' => array_merge($existingData['permintaan'] ?? [], $request->permintaan),
                'response' => array_merge($existingData['response'] ?? [], $request->response),
                'status_value' => array_merge($existingData['status_value'] ?? [], $request->status_value),
                'other_value' => array_merge($existingData['other_value'] ?? [], $request->other_value),
            ];
            $provider->update([
                'json' => json_encode($updatedData),
                'refill_support' => $request['other_value']['service']['is_refill_support'] == true ? 1 : 0,
            ]);
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
    public function editProvider(Request $request)
    {
        $provider = Provider::find($request->id);
        if ($provider) {
            return response()->json([
                'status' => true,
                'html' => view('admin.edit_provider', compact('provider'))->render()
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
    }
    public function settingProfit(Request $request)
    {
        $provider = Provider::find($request->id);
        if ($provider) {
            if ($provider->profit == null || $provider->profit == '') {
                $provider->profit = '{"1":{"min":"1","max":"99999","type":"percent","profit":"10"},"2":{"min":"100000","max":"499999","type":"percent","profit":"5"},"3":{"min":"500000","max":"999999","type":"percent","profit":"10"},"4":{"min":"1000000","max":"1000000","type":"percent","profit":"60"}}';
                $provider->save();
            }
            return response()->json([
                'status' => true,
                'html' => view('admin.setting_profit', compact('provider'))->render()
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
    }
    public function updateProvider(Request $request)
    {
        // return $request;
        $provider = Provider::find($request->id);
        if ($provider) {
            $provider->nama = $request->nama_provider;
            $provider->currency = $request->currency;
            $provider->profit = $request->profit;
            $provider->rate = $request->rate;
            $provider->proses_manual = $request->proses_manual;
            $provider->auto_nologin = $request->auto_nologin;
            $provider->save();
            return redirect()->back()->with('success', 'Data berhasil diupdate.');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }
    public function getSetting(Request $request)
    {
        $provider = Provider::find($request->id);
        if ($provider) {
            return response()->json([
                'status' => true,
                'html' => view('admin.get_setting', compact('provider'))->render()
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan.'
            ]);
        }
    }
    public function konfigurasiLayanan()
    {
        return view('admin.layanan_konfigurasi');
    }
    public function rekomendasi()
    {
        return view('admin.layanan_rekomendasi');
    }
    public function icon()
    {
        return view('admin.layanan_icon');
    }
    public function editIcon(Request $request)
    {
        return response()->json([
            'status' => true,
            'html' => view('admin.edit_icon', compact('request'))->render()
        ]);
    }
    public function searchIcon(Request $request)
    {
        $icon = IconLayanan::where('name', 'like', '%' . $request->icon . '%')->get();
        return response()->json([
            'status' => true,
            'html' => view('admin.search_icon', compact('icon', 'request'))->render()
        ]);
    }
    // ------------------------- End konfigurasi  ---------------
    public function tiket()
    {
        return view('admin.tiket');
    }
    public function chat(Ticket $ticket)
    {
        return view('admin.tiket_chat', compact('ticket'));
    }
    public function deposit()
    {
        return view('admin.deposit');
    }
    public function konfigurasi()
    {
        return view('admin.pemesanan_konfigurasi');
    }
    public function riwayat()
    {
        return view('admin.pemesanan_riwayat');
    }
    public function riwayatManual()
    {
        return view('admin.pemesanan_riwayat_manual');
    }
    public function riwayatRefill()
    {
        return view('admin.pemesanan_riwayat_refill');
    }
    public function riwayatNonlogin()
    {
        return view('admin.pemesanan_riwayat_nonlogin');
    }
    public function landingPage()
    {
        return view('admin.landing_page');
    }
    public function page2(Request $request)
    {
        $landing = Landing::first();
        if ($landing) {
            $existingData = $landing->page_two ? json_decode($landing->page_two, true) : [];
            $updatedData = [
                'title_page' => $request->title_page,
                'small_text' => $request->small_text,
            ];

            // Loop untuk setiap card
            foreach (['card_one', 'card_two', 'card_three'] as $cardName) {
                $updatedData[$cardName] = array_merge($existingData[$cardName] ?? [], $request->$cardName);
                if ($request->hasFile($cardName . '_image')) {
                    $image = $request->file($cardName . '_image');
                    $imageName = time();
                    $image->move(public_path('landing'), $imageName);
                    $updatedData[$cardName]['image'] = 'landing/' . $imageName; // Simpan path gambar
                }
            }

            $landing->update([
                'page_two' => json_encode($updatedData),
            ]);

            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }
    public function page3(Request $request)
    {
        $landing = Landing::first();
        if ($landing) {
            $existingData = $landing->page_three ? json_decode($landing->page_three, true) : [];
            $updatedData = [
                'title_page' => $request->title_page,
                'small_text' => $request->small_text,
            ];

            // Loop untuk setiap card
            foreach (['tab_one', 'tab_two', 'tab_three', 'tab_four'] as $tabName) {
                $updatedData[$tabName] = array_merge($existingData[$tabName] ?? [], $request->$tabName);
                if ($request->hasFile($tabName . '_image')) {
                    $image = $request->file($tabName . '_image');
                    $imageName = time();
                    $image->move(public_path('landing'), $imageName);
                    $updatedData[$tabName]['image'] = 'landing/' . $imageName;
                }
            }

            $landing->update([
                'page_three' => json_encode($updatedData),
            ]);

            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }
    public function category()
    {
        return view('admin.category');
    }
    public function konfigurasiReferral()
    {
        return view('admin.konfigurasi_referral');
    }
    public function listReferral()
    {
        return view('admin.list_referral');
    }
    public function withdraw()
    {
        return view('admin.withdraw');
    }
    public function manageUsers()
    {
        return view('admin.manage_users');
    }
    public function sitemap()
    {
        return view('admin.sitemap');
    }
    public function logMasuk()
    {
        return view('admin.log_masuk');
    }
    public function logSaldo()
    {
        return view('admin.log_saldo');
    }
}