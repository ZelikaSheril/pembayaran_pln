<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="bg-blue-600 text-white px-6 py-3 rounded-lg text-xl font-medium w-full lg:w-auto mb-4">
            Riwayat Pembayaran
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border border-black">
                <thead>
                    <tr class="bg-blue-300 text-center">
                        <th class="p-2 border border-black">No</th>
                        <th class="p-2 border border-black">IDPEL</th>
                        <th class="p-2 border border-black">Nama Pelanggan</th>
                        <th class="p-2 border border-black">Bulan & Tanggal Pembayaran</th>
                        <th class="p-2 border border-black">Nominal</th>
                        <th class="p-2 border border-black">Status</th>
                        <th class="p-2 border border-black text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $pembayaran = \App\Models\LaporanPembayaran::where('dibayar_oleh', auth()->id())
                            ->where('is_hidden', false)
                            ->orderBy('created_at', 'desc')
                            ->get();
                    @endphp


                    @forelse($pembayaran as $index => $bayar)
                        <tr class="border border-gray-600 text-center">
                            <td class="p-2 border border-gray-600">{{ $index + 1 }}</td>
                            <td class="p-2 border border-gray-600">{{ $bayar->idpel }}</td>
                            <td class="p-2 border border-gray-600">{{ $bayar->nama_pelanggan }}</td>
                            <td class="p-2 border border-gray-600">
                                {{ \Carbon\Carbon::parse($bayar->created_at)->translatedFormat('d F Y') }}
                            </td>
                            
                            <td class="p-2 border border-gray-600">Rp {{ number_format($bayar->total_akhir, 0, ',', '.') }}</td>
                            <td class="p-2 border border-gray-600">
                                <span class="px-2 py-1 rounded-lg 
                                    {{ $bayar->status_pembayaran == 'LUNAS' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                                    {{ ucfirst(strtolower($bayar->status_pembayaran)) }}
                                </span>
                            </td>
                            <td class="p-2 border border-gray-600 text-center">
                                <!-- Tombol Lihat -->
                                <button onclick="showModal({{ json_encode($bayar) }})" class="text-blue-500 hover:text-blue-700 mx-2">
                                    <i class="fas fa-eye"></i>
                                </button>
                                
                                <!-- Tombol Hapus -->
                                <form action="{{ route('pembayaran.hapus', $bayar->no_ref) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 mx-2" onclick="return confirm('Apakah Anda yakin ingin menghapus riwayat ini?');">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center p-4">Belum ada riwayat pembayaran</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            <a href="{{ route('dashboard') }}">
                <button class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded-lg">
                    Kembali
                </button>
            </a>
        </div>
    </div>

    <!-- Modal Popup -->
    <!-- Modal Popup -->
    <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-[350px]">
            <!-- Flex container untuk logo dan rincian -->
            <div class="flex items-center mb-4">
                <img src="{{ asset('images/logo_pln.png') }}" alt="Logo PLN" class="h-16 mr-4">
                <p class="text-center font-semibold flex-grow">STRUK PEMBAYARAN TAGIHAN LISTRIK</p>
            </div>
    
            <div id="struk-container" class="border p-4 space-y-2">
                <div class="grid grid-cols-3">
                    <span><strong>IDPEL</strong></span>
                    <span class="text-center">:</span>
                    <span id="idpel"></span>
                </div>
                <div class="grid grid-cols-3">
                    <span><strong>Nama</strong></span>
                    <span class="text-center">:</span>
                    <span id="nama"></span>
                </div>
                <div class="grid grid-cols-3">
                    <span><strong>Bulan & Tahun</strong></span>
                    <span class="text-center">:</span>
                    <span id="bulan-tahun"></span>
                </div>
                <div class="grid grid-cols-3">
                    <span><strong>Total Bayar</strong></span>
                    <span class="text-center">:</span>
                    <span id="total-bayar"></span>
                </div>
                <div class="grid grid-cols-3">
                    <span><strong>No Ref</strong></span>
                    <span class="text-center">:</span>
                    <span id="no-ref"></span>
                </div>
                <div class="grid grid-cols-3">
                    <span><strong>Status</strong></span>
                    <span class="text-center">:</span>
                    <span id="status"></span>
                </div>
                <div class="grid grid-cols-3" id="token-container" style="display: none;">
                    <span><strong>Token</strong></span>
                    <span class="text-center">:</span>
                    <span id="token" class="break-words"></span>
                </div>
                
    
                <p class="text-sm text-center mt-4">PLN Menyatakan struk ini sebagai bukti pembayaran yang sah</p>
            </div>
    
            <!-- Tombol Cetak dan Tutup -->
            <div class="mt-4">
                <button onclick="window.print()" class="w-full bg-green-500 text-white py-2 rounded-lg">Cetak Struk</button>
                <button onclick="closeModal()" class="w-full bg-red-500 text-white py-2 rounded-lg mt-2">Tutup</button>
            </div>
        </div>
    </div>
    
    <script>
        function showModal(data) {
            document.getElementById('idpel').textContent = data.idpel;
            document.getElementById('nama').textContent = data.nama_pelanggan;
            document.getElementById('bulan-tahun').textContent = new Date(data.created_at).toLocaleString('id-ID', { 
                day: 'numeric', month: 'long', year: 'numeric' 
            });
    
            document.getElementById('total-bayar').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.total_akhir);
            document.getElementById('no-ref').textContent = data.no_ref;
            document.getElementById('status').textContent = data.status_pembayaran;
    
            // Jika jenis pembayaran adalah PRABAYAR, tampilkan token
            if (data.token) {
                document.getElementById('token').textContent = data.token;
                document.getElementById('token-container').style.display = 'grid';
            } else {
                document.getElementById('token-container').style.display = 'none';
            }
    
            document.getElementById('modal').classList.remove('hidden');
        }
    
        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>
    


</x-app-layout>
