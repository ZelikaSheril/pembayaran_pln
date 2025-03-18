<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Welcome User -->
        <div class="mt-4 text-xl font-semibold text-gray-800">
            Welcome, {{ auth()->user()->name }} 👋
        </div>

        <!-- Saldo & Statistik -->
        <div class="mt-4 flex flex-col lg:flex-row lg:space-x-4">
            <!-- Saldo -->
            <div class="bg-blue-500 text-white p-4 rounded-lg flex justify-between items-center lg:w-1/2 h-32">
                <div>
                    <p class="text-xl font-semibold">Saldo</p>
                    <p class="text-2xl font-bold">Rp {{ number_format(auth()->user()->saldo, 2, ',', '.') }}</p>
                </div>
                <!-- Tombol Top-Up -->
                <a href="{{ route('topup.form') }}" class="bg-white text-blue-500 rounded-full p-2 text-lg">+</a>
            </div>

            <!-- Statistik -->
            <div class="bg-gray-100 p-4 rounded-lg lg:w-1/2 h-32">
                <p class="text-md font-semibold text-gray-800">Statistik Pembayaran</p>
                <div class="relative w-full h-24">
                    <canvas id="chartPembayaran"></canvas>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-6 flex space-x-4 justify-start">
            <a href="{{ url('/opsi-pembayaran') }}" class="bg-orange-400 text-white px-6 py-3 rounded-lg text-lg font-medium w-full lg:w-1/3 text-center block">
                Konfirmasi Pembayaran
            </a>
            <a href="{{ url('/riwayat-pembayaran') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg text-lg font-medium w-full lg:w-1/3 text-center block">
                Riwayat Pembayaran
            </a>
            <a href="{{ url('/form-konsultasi') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg text-lg font-medium w-full lg:w-1/3 text-center block">
                Pengaduan
            </a>
        </div>
        

        

    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        fetch('{{ route("statistik.pembayaran") }}', {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('chartPembayaran').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Total Pembayaran',
                        data: data.data,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } }
                }
            });
        })
        .catch(error => console.error('Error fetching statistik:', error));
    });
</script>


</x-app-layout>
