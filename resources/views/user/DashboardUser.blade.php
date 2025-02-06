<x-app-layout>
    {{-- <div class="min-h-screen bg-white p-8">
        <!-- Navbar -->
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{ asset('images/pln-logo.png') }}" alt="PLN Logo" class="h-12">
                <span class="text-blue-600 text-xl font-bold ml-2">PLN</span>
            </div>
            <div class="flex items-center">
                <span class="text-black font-medium">Putri</span>
                <div class="ml-2 w-8 h-8 bg-black rounded-full flex items-center justify-center">
                    <span class="text-white font-bold">👤</span>
                </div>
            </div>
        </div> --}}
        <div class="px-4">

        <!-- Saldo -->
        <div class="mt-8">
            <div class="bg-blue-500 text-white p-6 rounded-lg flex justify-between items-center">
                <div>
                    <p class="text-lg font-semibold">Saldo</p>
                    <p class="text-3xl font-bold">1.000.000</p>
                </div>
                <button class="bg-white text-blue-500 rounded-full p-2 text-xl">+</button>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-6 flex space-x-4">
            <button class="bg-orange-400 text-white px-6 py-3 rounded-lg text-lg font-medium">Konfirmasi Pembayaran</button>
            <button class="bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-medium">Riwayat Pembayaran</button>
        </div>

        <!-- Tarif Pembayaran -->
        <div class="mt-6 border border-gray-300 p-4 rounded-lg">
            <p class="text-lg font-semibold">Tarif Pembayaran</p>
            <p class="text-gray-500 text-sm">Bulan Ini</p>
            <p class="text-black font-medium">Senin dan Rabu, jam 16.00 - 18.00</p>
        </div>
    </div>
    </div>
</x-app-layout>
