<?php

namespace App\Http\Middleware;

use App\Models\Session;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProtectSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = session()->getId();
        $session = Session::where('user_id', auth()->id())->where('id', $id)->first();
        try {
            if (auth()->check()) {
                if ($session) {
                    if ($session->status == 'remove') {
                        Auth::logout();
                        session()->invalidate();
                        session()->regenerateToken();
                        return redirect()->route('login');
                    }
                }
                // set timezone
                if (auth()->user()->zona) {
                    date_default_timezone_set(auth()->user()->zona);
                }
                if (auth()->user()->status != 'active') {
                    Auth::logout();
                    session()->invalidate();
                    session()->regenerateToken();
                    return redirect()->route('login')->with('error', 'Akun anda tidak aktif');
                }
                if (auth()->user()->is_verified == '0' && $request->url() != route('authenticate') && $request->url() != route('proses.authenticate') && auth()->user()->google2fa == '1') {
                    return redirect()->route('authenticate');
                }
            }
            return $next($request);
        } catch (Exception $e) {
            return $next($request);
        }
    }
}
