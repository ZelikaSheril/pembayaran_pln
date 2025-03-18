<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopUpController extends Controller
{
    // Menampilkan form top-up
    public function showForm()
    {
        return view('topup.form');
    }

    // Memproses top-up saldo
    public function processTopUp(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:10000',
    ]);

    $user = Auth::user();

    $user->increment('saldo', $request->amount);

    return redirect()->route('topup.form')->with('success', 'Top-up berhasil!');
}



    public function show()
{
    return view('TopUp');
}

}
