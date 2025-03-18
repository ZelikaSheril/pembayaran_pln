<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4 text-center">Form Pengaduan</h2>
        
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        
        <form action="{{ route('konsultasi.kirim') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-medium">Nama</label>
                <input type="text" name="nama" id="nama" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            
            <div class="mb-4">
                <label for="pesan" class="block text-gray-700 font-medium">Pesan/Kendala</label>
                <textarea name="pesan" id="pesan" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>
            
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Kirim</button>
        </form>
    </div>
    <div class="pb-8 px-4">
        <a href="{{ route('dashboard') }}">
            <button class="bg-red-500 hover:bg-red-600 text-white font-semibold px-6 py-2 rounded-lg">
                Kembali
            </button>
        </a>
    </div>
</x-app-layout>
