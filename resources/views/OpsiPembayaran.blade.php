<x-app-layout>
    
    <div class=" flex flex-col mt-40">
        

        <!-- Wrapper untuk konten utama agar tidak terlalu jauh dari header -->
        <div class="flex-1 flex flex-col items-center justify-center mb-20">
            <!-- Kotak Konfirmasi Pembayaran -->
            <div class="bg-blue-100 p-8 rounded-xl text-center shadow-md">
                <h2 class="text-lg font-bold text-black mb-4">Konfirmasi Pembayaran</h2>

                <!-- Tombol Pilihan -->
                <form>
                    <a href="{{ url('/prabayar') }}" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-full py-2 flex items-center justify-center mb-3">
                        PraBayar
                    </a>
                </form>

                <form>
                    <a href="{{ url('/pascabayar') }}" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-full py-2 flex items-center justify-center">
                        PascaBayar
                    </a>
                
                </form>
            </div>
        </div>

        <!-- Tombol Kembali di bagian bawah -->
        <div class="pb-8 px-4">
            <a href="{{ route('dashboard') }}">
                <button class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded-lg">
                    Kembali
                </button>
            </a>
        </div>

    </div>
</x-app-layout>
