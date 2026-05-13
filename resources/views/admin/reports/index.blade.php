<x-app-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900">Laporan Analitik</h1>
        <p class="text-sm text-gray-500 font-medium">Ringkasan performa penjualan restoran Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-8 rounded-3xl text-white shadow-xl shadow-blue-900/20">
            <p class="text-xs font-bold uppercase tracking-widest opacity-80 mb-2">Total Penjualan</p>
            <h3 class="text-3xl font-black italic">Rp {{ number_format($totalSales, 0, ',', '.') }}</h3>
            <div class="mt-6 flex items-center text-xs font-bold bg-white/10 w-fit px-3 py-1.5 rounded-full">
                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/></svg>
                Performa Stabil
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Total Pesanan</p>
            <h3 class="text-4xl font-black text-gray-900">{{ $orderCount }}</h3>
            <p class="text-xs text-gray-500 font-medium mt-2">Semua status pesanan</p>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Tingkat Keberhasilan</p>
            <h3 class="text-4xl font-black text-gray-900">
                {{ $orderCount > 0 ? round(($successfulOrders / $orderCount) * 100) : 0 }}%
            </h3>
            <p class="text-xs text-gray-500 font-medium mt-2">Pesanan berstatus Success</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-lg font-bold text-gray-900 mb-6">Penjualan 7 Hari Terakhir</h3>
        <div class="space-y-4">
            @forelse($dailySales as $sale)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">
                        <i class="fa-solid fa-calendar-day text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ date('d M Y', strtotime($sale->date)) }}</p>
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-tighter">Total Transaksi</p>
                    </div>
                </div>
                <p class="text-lg font-black text-gray-900">Rp {{ number_format($sale->total, 0, ',', '.') }}</p>
            </div>
            @empty
            <p class="text-center py-10 text-gray-400 font-medium">Belum ada data penjualan.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
