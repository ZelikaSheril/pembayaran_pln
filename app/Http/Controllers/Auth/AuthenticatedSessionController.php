<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Menangani proses autentikasi login.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $user = Auth::user();

    $request->session()->regenerate();

    // Cek apakah pengguna adalah admin atau user biasa
    if ($user->is_admin) {
        return redirect()->intended(route('admin.dashboard', absolute: false));
    }

    return redirect()->intended(route('dashboard', absolute: false));
}


    /**
     * Logout dan hapus sesi pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
