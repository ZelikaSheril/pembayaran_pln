<x-app-layout>
    <div class="flex items-center justify-center mt-10"> 
        <!-- Kotak Pembayaran -->
        <div class="bg-white border border-gray-300 rounded-xl shadow-lg w-[400px]">
            
            <!-- Header -->
            <div class="bg-blue-500 text-white text-center py-4 rounded-t-xl">
                <h2 class="text-lg font-bold">Pembayaran Prabayar</h2>
            </div>

            <div class="p-6">
                <form action="{{ route('cek.pembayaran.prabayar') }}" method="POST">
                    @csrf
                    <label class="block text-gray-700 mb-2">Masukkan ID Pelanggan</label>
                    <input type="text" name="idpel" class="w-full border border-gray-300 rounded-lg p-3 bg-gray-200" required>

                    <label class="block text-gray-700 mb-2">Nominal</label>
                    <input type="text" id="nominalInput" name="nominal" class="w-full border border-gray-300 rounded-lg p-3 bg-gray-200" required>

                    <div class="flex items-center gap-9 w-full max-w-md mx-auto mt-3">
                        <button type="button" class="nominal-btn bg-blue-500 hover:bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg" data-nominal="50000">50.000</button>
                        <button type="button" class="nominal-btn bg-blue-500 hover:bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg" data-nominal="100000">100.000</button>
                        <button type="button" class="nominal-btn bg-blue-500 hover:bg-blue-600 text-white font-semibold px-5 py-2 rounded-lg" data-nominal="200000">200.000</button>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="mt-4 text-right">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-lg">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tombol Kembali di pojok kiri bawah -->
        <div class="absolute bottom-4 left-4">
            <a href="{{ route('dashboard') }}">
                <button class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded-lg">
                    Kembali
                </button>
            </a>
        </div>
    </div>

    <script>
        document.querySelectorAll('.nominal-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('nominalInput').value = this.dataset.nominal;
            });
        });
    </script>
</x-app-layout>
