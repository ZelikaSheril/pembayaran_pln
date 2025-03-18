<x-app-layout>
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
        <h2 class="text-lg font-bold text-center mb-4">RINCIAN REKENING</h2>

        <div id="struk-container" class="border p-4 space-y-2">
            <p class="text-center font-semibold">STRUK PEMBAYARAN TAGIHAN LISTRIK</p>

            @if(isset($pelanggan) && isset($tagihan))
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
            @else
                <p class="text-red-500 text-center">Data tidak ditemukan.</p>
            @endif

            <p class="text-sm text-center mt-4">PLN Menyatakan struk ini sebagai bukti pembayaran yang sah</p>
        </div>

        <!-- Tombol Cetak dan Download -->
        <div class="mt-4">
            <button onclick="window.print()" class="w-full bg-green-500 text-white py-2 rounded-lg">Cetak Struk</button>
            <button onclick="downloadStruk()" class="w-full bg-blue-500 text-white py-2 rounded-lg mt-2">Download Struk</button>
        </div>
    </div>

    <!-- Script Download Struk -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        function downloadStruk() {
            let strukElement = document.getElementById('struk-container');
            html2canvas(strukElement).then((canvas) => {
                let link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = 'struk_pembayaran.png';
                link.click();
            });
        }
    </script>
</x-app-layout>
