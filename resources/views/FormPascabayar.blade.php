<x-app-layout>
    <div class="flex items-center justify-center mt-32"> 
        <!-- Kotak Pembayaran -->
        <div class="bg-white border border-gray-300 rounded-xl shadow-lg w-[400px]">
            
            <!-- Header -->
            <div class="bg-blue-500 text-white text-center py-4 rounded-t-xl">
                <h2 class="text-lg font-bold">Pembayaran PascaBayar</h2>
            </div>

            <div class="p-5">

            <!-- Form Input -->
            <form action="{{ route('cek.pembayaran') }}" method="POST">
                @csrf
                <label class="block text-gray-700 mb-2">Masukkan ID Pelanggan</label>
                <input type="text" name="idpel" class="w-full border border-gray-300 rounded-lg p-3 bg-gray-200">

                
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
</x-app-layout>
