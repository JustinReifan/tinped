<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\ConfigReferral;
use App\Models\Referral;
use App\Models\ReferralWithdraw;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReferralController extends Controller
{
    public function index(Request $request)
    {
        if ($request->action == 'agree') {
            $user = User::find(auth()->user()->id);
            if ($user->is_referral == 1) {
                return redirect('referral');
            }
            $config = ConfigReferral::where('level', $user->level)->first();
            if ($config) {
                $user->is_referral = '1';
                $user->save();
                Referral::create([
                    'user_id' => auth()->user()->id,
                    'code' => random(10),
                    'level' => 'basic',
                    'komisi' => 0,
                    'visitors' => 0,
                    'registered' => 0,
                ]);
            }
            return redirect('referral');
        }
        if (auth()->user()->is_referral == 1) {
            $referral = Referral::where('user_id', Auth::user()->id)->first();
            if (!$referral) {
                $user = User::find(auth()->user()->id);
                $user->is_referral = '0';
                $user->save();
                return redirect('referral');
            }
            return view('referral.statistik', compact('referral'));
        }
        if (!Schema::hasColumn('configs', 'tos_referral')) {
            DB::statement("ALTER TABLE configs ADD COLUMN tos_referral TEXT NULL AFTER path");
        }
        return view('referral.index');
    }
    public function withdraw(Request $request)
    {
        $request->validate(
            [
                'amount' => 'required|numeric',
            ],
            [
                'amount.required' => 'Jumlah penarikan tidak boleh kosong',
                'amount.numeric' => 'Jumlah penarikan harus berupa angka',
            ]
        );
        $config = Config::first();
        $referral = Referral::where('user_id', Auth::user()->id)->first();
        if ($request->amount < $config->min_withdraw) {
            return redirect()->back()->with('error', 'Jumlah penarikan minimal ' . $config->min_withdraw);
        } elseif ($request->amount > $referral->komisi) {
            return redirect()->back()->with('error', 'Saldo komisi anda tidak mencukupi');
        } else {
            $array = [
                'date' => tanggal(date('Y-m-d')) . ' ' . date('H:i:s'),
                'amount' => $request->amount,
            ];
            $rate = $request->amount - $request->amount * $config->rate_withdraw / 100;
            $sebelum = auth()->user()->balance;
            $user = User::find(auth()->user()->id);
            $sesudah = $user->balance + $rate;
            $user->balance = $user->balance + $rate;
            $referral->komisi = $referral->komisi - $request->amount;
            if ($sesudah - $sebelum == $rate) {
                $referral->save();
                ReferralWithdraw::create([
                    'user_id' => auth()->user()->id,
                    'amount' => $request->amount,
                    'rate' => $config->rate_withdraw,
                    'balance' => $rate,
                ]);
                $user->save();
                return redirect()->back()->with('success', 'Withdraw berhasil, saldo anda bertambah Rp ' . number_format($rate, 0, ',', '.'));
            } else {
                return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan coba lagi');
            }
        }
    }
}
