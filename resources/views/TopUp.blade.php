<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow rounded-lg">
        <h2 class="text-xl font-bold mb-4">Top Up Saldo</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('topup.process') }}" method="POST">
            @csrf
            <label for="amount" class="block text-sm font-medium text-gray-700">Jumlah Top Up</label>
            <input type="number" id="amount" name="amount" class="w-full p-2 border rounded mt-1" placeholder="Masukkan jumlah" required>

            <label for="payment_method" class="block text-sm font-medium text-gray-700 mt-4">Metode Pembayaran</label>
            <select id="payment_method" name="payment_method" class="w-full p-2 border rounded mt-1" required>
                <option value="" disabled selected>Pilih metode pembayaran</option>
                <option value="DANA">DANA</option>
                <option value="BRI">BRI</option>
                <option value="GOPAY">GOPAY</option>
                <option value="OVO">OVO</option>
                <option value="Mandiri">Mandiri</option>
                <option value="BNI">BNI</option>
                <option value="BCA">BCA</option>
            </select>

            <button type="submit" class="mt-4 w-full bg-blue-600 text-white py-2 rounded">
                Top Up
            </button>
        </form>
    </div>
</x-app-layout>
