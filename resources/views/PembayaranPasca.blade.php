<x-app-layout>
    <div class="flex items-center justify-center mt-7 mb-7">
        <div class="bg-white border border-gray-300 rounded-xl shadow-lg w-[400px]" x-data="pembayaranListrik()">
            <div class="bg-blue-500 text-white text-center py-4 rounded-t-xl">
                <h2 class="text-lg font-bold">Detail Pembayaran</h2>
            </div>

            <div class="p-6 space-y-2">
                @if($pelanggan)
                    <div class="grid grid-cols-3">
                        <span><strong>IDPEL</strong></span>
                        <span class="text-center">:</span>
                        <span class="text-left">{{ $pelanggan->idpel }}</span>
                    </div>
                    <div class="grid grid-cols-3">
                        <span><strong>Nama</strong></span>
                        <span class="text-center">:</span>
                        <span class="text-left">{{ $pelanggan->nama }}</span>
                    </div>
                    <div class="grid grid-cols-3">
                        <span><strong>Tarif/Daya</strong></span>
                        <span class="text-center">:</span>
                        <span class="text-left">{{ $pelanggan->daya }}</span>
                    </div>
                    <div class="grid grid-cols-3">
                        <span><strong>BL/TH</strong></span>
                        <span class="text-center">:</span>
                        <span class="text-left">{{ $tagihan->bulan_tagihan }}</span>
                    </div>
                    <div class="grid grid-cols-3">
                        <span><strong>Stand Meter</strong></span>
                        <span class="text-center">:</span>
                        <span class="text-left">{{ $tagihan->pemakaian_kwh }}</span>
                    </div>
                    <div class="grid grid-cols-3">
                        <span><strong>Tagihan PLN</strong></span>
                        <span class="text-center">:</span>
                        <span class="text-left">Rp {{ number_format($tagihan->total_tagihan, 0, ',', '.') }}</span>
                    </div>
                    <div class="grid grid-cols-3">
                        <span><strong>No Ref</strong></span>
                        <span class="text-center">:</span>
                        <span class="text-left">{{ $noRef }}</span>
                    </div>
                    
                    <div class="grid grid-cols-3">
                        <span><strong>Admin</strong></span>
                        <span class="text-center">:</span>
                        <span class="text-left">Rp {{ number_format($biayaAdmin, 0, ',', '.') }}</span>
                    </div>
                    <div class="grid grid-cols-3 font-semibold">
                        <span><strong>Total Bayar</strong></span>
                        <span class="text-center">:</span>
                        <span class="text-left">Rp {{ number_format($totalBayar, 0, ',', '.') }}</span>
                    </div>

                    <input type="hidden" id="pelanggan_id" value="{{ $pelanggan->id }}">
                    <input type="hidden" id="tagihan_id" value="{{ $tagihan->id }}">

                    <button @click="openModal = true"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-lg w-full">
                        Bayar
                    </button>

                    <!-- Modal Pilihan Metode Pembayaran -->
                    <template x-if="openModal">
                        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                            <div class="bg-white rounded-lg w-[350px] p-6 shadow-lg">
                                <h2 class="text-lg font-bold text-center mb-4">METODE PEMBAYARAN</h2>
                                <p class="text-center">Pilih metode pembayaran</p>

                                <div class="mt-4 bg-gray-200 p-3 rounded-lg flex items-center justify-between">
                                    <span class="font-semibold">Top Up</span>
                                    <span class="text-gray-700">Saldo Rp {{ number_format(auth()->user()->saldo, 2, ',', '.') }}</span>
                                </div>

                                <div class="mt-4 flex justify-between font-bold">
                                    <span>Total Bayar</span>
                                    <span>Rp {{ number_format($totalBayar, 0, ',', '.') }}</span>
                                </div>

                                <button 
                                    @click="bayarListrik()" 
                                    :disabled="isLoading"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg w-full mt-3">
                                    <span x-show="!isLoading">Bayar</span>
                                    <span x-show="isLoading">Memproses...</span>
                                </button>

                                <button @click="openModal = false"
                                    class="text-red-500 font-bold text-sm mt-2 w-full text-center">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </template>

                    <!-- Modal Sukses Pembayaran -->
                    <template x-if="openModalSuccess">
                        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                            <div class="bg-white rounded-lg w-[350px] p-6 shadow-lg">
                                <h2 class="text-lg font-bold text-center mb-4">Pembayaran Berhasil</h2>
                                <p class="text-center">Pembayaran listrik telah berhasil.</p>

                                <button @click="openModalSuccess = false; window.location.href='/riwayat-pembayaran';"
                                    class="text-blue-500 font-bold text-sm mt-2 w-full text-center">
                                    Selesai
                                </button>
                            </div>
                        </div>
                    </template>
                    
                @else
                    <p class="text-red-500 text-center">Data tidak ditemukan.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    function pembayaranListrik() {
        return {
            openModal: false,
            openModalSuccess: false,
            isLoading: false, // ✅ Tambahkan flag untuk mencegah klik ganda

            bayarListrik() {
                if (this.isLoading) return; // ✅ Cegah request ganda jika sedang loading
                
                this.isLoading = true; // ✅ Set isLoading true agar tombol tidak bisa diklik ulang
                console.clear(); // ✅ Hapus log sebelumnya agar tidak spam di console

                let pelangganId = document.getElementById("pelanggan_id").value;
                let tagihanId = document.getElementById("tagihan_id").value;
                let totalBayar = parseFloat("{{ $totalBayar ?? 0 }}") || 0; // ✅ Pastikan ini angka

                console.log("Mengirim Data:", { 
                    pelanggan_id: pelangganId,
                    tagihan_id: tagihanId,
                    total_bayar: totalBayar
                });

                fetch("{{ route('bayar.listrik') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                    pelanggan_id: Number(pelangganId),
                    tagihan_id: Number(tagihanId),
                    total_bayar: Number("{{ $tagihan->total_tagihan ?? 0 }}") // Pastikan ini tanpa biaya admin
                    })

                })
                .then(response => response.json())
                .then(data => {
                    console.log("Server Response:", data);
                    if (data.success) {
                        this.openModal = false;
                        this.openModalSuccess = true;
                    } else {
                        alert(data.message || "Pembayaran gagal.");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan, coba lagi.");
                })
                .finally(() => {
                    this.isLoading = false; // ✅ Pastikan bisa diklik lagi setelah selesai
                });
            }
        };
    }
</script>
