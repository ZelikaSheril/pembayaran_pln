<x-filament::page>
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-black p-6 rounded-lg shadow-lg mb-6">
        <h1 class="text-3xl font-extrabold">Welcome, Admin!👋 </h1>
        <p class="text-lg mt-2">Pantau laporan pembayaran pelanggan dengan lebih mudah.</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">📊 Laporan Pembayaran Hari Ini</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse bg-white text-left shadow-md rounded-lg">
                <thead class="bg-indigo-600 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-lg">IDPEL</th>
                        <th class="px-6 py-3 text-lg">Nama</th>
                        <th class="px-6 py-3 text-lg">Total Bayar</th>
                        <th class="px-6 py-3 text-lg">Jenis Meteran</th>
                        <th class="px-6 py-3 text-lg">Lunas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->getPembayaranHariIni() as $pembayaran)
                        <tr class="border-b hover:bg-gray-100 transition-all">
                            <td class="px-6 py-4">{{ $pembayaran->idpel }}</td>
                            <td class="px-6 py-4">{{ $pembayaran->nama_pelanggan }}</td>
                            <td class="px-6 py-4 text-green-600 font-semibold">Rp {{ number_format($pembayaran->total_akhir, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ ucfirst($pembayaran->jenis_pembayaran) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full bg-green-500 text-black text-sm font-semibold">
                                    ✅ Lunas
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center px-6 py-4 text-gray-500">Tidak ada laporan pembayaran hari ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-filament::page>
