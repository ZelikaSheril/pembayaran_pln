<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarTagihan;
use App\Models\DataPelanggan;
use App\Models\LaporanPembayaran;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class PembayaranController extends Controller
{
    public function cekPembayaran(Request $request)
    {
        $idpel = $request->input('idpel');
    
        $tagihan = DaftarTagihan::where('idpel', $idpel)->first();
        if (!$tagihan) {
            return back()->with('error', 'ID Pelanggan tidak ditemukan.');
        }
    
        $pelanggan = DataPelanggan::where('idpel', $idpel)->first();
        if (!$pelanggan) {
            return back()->with('error', 'Data pelanggan tidak ditemukan.');
        }
    
        // Cek apakah session noRef sudah ada, jika tidak buat yang baru
        if (!session()->has('noRef')) {
            session(['noRef' => 'REF-' . strtoupper(Str::random(10))]);
        }
    
        $noRef = session('noRef'); // Ambil noRef dari session
        $biayaAdmin = 5000;
        $totalBayar = $tagihan->total_tagihan + $biayaAdmin;
    
        return view('PembayaranPasca', compact('pelanggan', 'tagihan', 'noRef', 'biayaAdmin', 'totalBayar'));
    }
    

    public function bayar(Request $request)
    {
        try {
            $user_pembayar = Auth::user();
            if (!$user_pembayar) {
                return response()->json(['success' => false, 'message' => 'User tidak ditemukan.'], 401);
            }
    
            $request->validate([
                'pelanggan_id' => 'required|exists:data_pelanggans,id',
                'total_bayar' => 'required|numeric|min:1000',
            ]);
    
            // Jika pascabayar, wajib ada tagihan_id
            if ($request->has('tagihan_id')) {
                $request->validate([
                    'tagihan_id' => 'exists:daftar_tagihans,id'
                ]);
            }
    
            $pelanggan = DataPelanggan::where('id', $request->pelanggan_id)->first();
            if (!$pelanggan) {
                return response()->json(['success' => false, 'message' => 'Pelanggan tidak ditemukan.'], 404);
            }
    
            // Menentukan jenis pembayaran berdasarkan jenis meteran pelanggan
            $jenisPembayaran = strtoupper($pelanggan->jenis_meteran); // PRABAYAR atau PASCABAYAR
    
            // Menentukan jumlah pembayaran
            if ($jenisPembayaran === 'PASCABAYAR') { // Jika Pascabayar
                $jumlahBayar = DaftarTagihan::find($request->tagihan_id)->total_tagihan;
                $token = null; // Pascabayar tidak memerlukan token
            } else { // Jika Prabayar
                $jumlahBayar = $request->total_bayar - 5000;
                // Menghasilkan token berupa angka 20 digit
                $token = mt_rand(100000000000000000, 999999999999999999); // 18 digit, masih dalam batas BIGINT
            }
    
            $biayaAdmin = 5000;
            $totalAkhir = $jumlahBayar + $biayaAdmin;
    
            $user_pembayar = User::find($user_pembayar->id);
            if (!$user_pembayar || $user_pembayar->saldo < $totalAkhir) {
                return response()->json([
                    'success' => false,
                    'message' => 'Saldo tidak mencukupi.',
                    'saldo_pembayar' => $user_pembayar->saldo ?? 0,
                    'total_akhir' => $totalAkhir
                ], 400);
            }
    
            // Cek nomor referensi dari session
            if (!session()->has('noRef')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nomor referensi tidak ditemukan di session.'
                ], 400);
            }
    
            $noRef = session('noRef');
            Log::info('Nomor Referensi yang digunakan:', ['no_ref' => $noRef]);
    
            DB::beginTransaction();
    
            // Kurangi saldo pengguna
            $user_pembayar->saldo -= $totalAkhir;
            $user_pembayar->save();
    
            // Simpan laporan pembayaran
            LaporanPembayaran::create([
                'no_ref' => $noRef,
                'idpel' => $pelanggan->idpel,
                'id_pelanggan' => $pelanggan->id,
                'dibayar_oleh' => $user_pembayar->id,
                'nama_pelanggan' => $pelanggan->nama,
                'jumlah_bayar' => $jumlahBayar,
                'biaya_admin' => $biayaAdmin,
                'total_akhir' => $totalAkhir,
                'status_pembayaran' => 'LUNAS',
                'nama_pembayar' => $user_pembayar->name,
                'token' => $token, // Simpan token hanya untuk prabayar
                'jenis_pembayaran' => $jenisPembayaran, // Ambil dari jenis_meteran pelanggan
            ]);
    
            // Jika pascabayar, ubah status tagihan jadi lunas
            if ($jenisPembayaran === 'PASCABAYAR' && $request->has('tagihan_id')) {
                DaftarTagihan::where('id', $request->tagihan_id)->update([
                    'status_pembayaran' => 'Lunas'
                ]);
            }
    
            DB::commit();
    
            // Hapus session noRef agar tidak ada duplikasi
            session()->forget('noRef');
    
            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil!',
                'no_ref' => $noRef,
                'token' => $token, // Kirim token hanya jika prabayar
                'saldo_terbaru' => $user_pembayar->saldo
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error Pembayaran: ' . $e->getMessage());
    
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    


public function hapusRiwayat($no_ref)
{
    $pembayaran = LaporanPembayaran::where('no_ref', $no_ref)->first();

    if ($pembayaran) {
        $pembayaran->update(['is_hidden' => true]); // Hanya menyembunyikan dari user
    }

    return redirect()->route('riwayat.pembayaran')->with('success', 'Riwayat pembayaran berhasil dihapus.');
}

public function riwayatPembayaran()
{
    $pembayaran = LaporanPembayaran::orderBy('created_at', 'desc')->get();

    return view('RiwayatPembayaran', compact('pembayaran'));
}

public function hide($no_ref)
{
    $pembayaran = LaporanPembayaran::where('no_ref', $no_ref)->first();

    if ($pembayaran) {
        $pembayaran->hidden = true; // Set hidden menjadi true
        $pembayaran->save();
    }

    return redirect()->route('riwayat.pembayaran')->with('success', 'Riwayat pembayaran berhasil disembunyikan.');
}

public function index()
{
    $pembayaran = LaporanPembayaran::where('is_hidden', false)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('RiwayatPembayaran', compact('pembayaran'));
}

public function statistikPembayaran()
{
    // Pastikan user sudah login
    if (!Auth::check()) {
        return response()->json([
            'error' => 'User tidak terautentikasi'
        ], 401);
    }

    $user = Auth::user();

    // Ambil hanya pembayaran yang dilakukan untuk dirinya sendiri
    $pembayaran = LaporanPembayaran::where('nama_pelanggan', $user->name)
        ->where('dibayar_oleh', $user->id) // Hanya jika user yang membayar sendiri
        ->orderBy('created_at', 'asc')
        ->get();

    // Jika tidak ada data, return array kosong agar tidak error di Chart.js
    if ($pembayaran->isEmpty()) {
        return response()->json([
            'labels' => [],
            'data' => []
        ]);
    }

    // Format data untuk Chart.js
    $labels = $pembayaran->pluck('created_at')->map(fn($date) => $date->format('d M Y'))->toArray();
    $data = $pembayaran->pluck('total_akhir')->toArray();

    return response()->json([
        'labels' => $labels,
        'data' => $data
    ]);
}

public function cekPembayaranPrabayar(Request $request)
{
    $request->validate([
        'idpel' => 'required|exists:data_pelanggans,idpel',
        'nominal' => 'required|numeric|min:20000',
    ]);

    $pelanggan = DataPelanggan::where('idpel', $request->idpel)->first();
    if (!$pelanggan) {
        return redirect()->back()->with('error', 'Pelanggan tidak ditemukan.');
    }

    // 🔹 Ambil jenis pembayaran dari data pelanggan
    $jenisPembayaran = $pelanggan->jenis_meteran;

    // 🔹 Tentukan apakah pelanggan ini prabayar atau pascabayar
    if ($jenisPembayaran === 'pascabayar') {
        return redirect()->route('cekPembayaranPascabayar', ['idpel' => $request->idpel])
            ->with('error', 'Pelanggan ini menggunakan meteran Pascabayar!');
    }

    // 🔹 Simpan nominal agar tidak undefined
    $nominal = $request->nominal;

    // 🔹 Simulasi Stand Meter dan Tanggal
    $standMeter = rand(1000, 9999);
    $tanggalSekarang = now()->format('d/m/Y');

    // 🔹 Biaya admin dan total bayar
    $biayaAdmin = 5000;
    $totalBayar = $nominal + $biayaAdmin;

    // 🔹 No referensi unik
    if (!session()->has('noRef')) {
        session(['noRef' => 'REF-' . strtoupper(Str::random(10))]);
    }
    $noRef = session('noRef');

    // 🔹 Buat token jika pembayaran prabayar
    $token = mt_rand(100000000000000000, 999999999999999999); // 18 digit, masih dalam batas BIGINT

    return view('pembayaranprabayar', compact(
        'pelanggan', 'nominal', 'noRef', 'standMeter', 'tanggalSekarang', 'biayaAdmin', 'totalBayar', 'jenisPembayaran', 'token'
    ));
}

}
