<x-app-layout>
    <style>
        .fade-in-up {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        @keyframes fadeInUp {
            to { opacity: 1; transform: translateY(0); }
        }
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -15px rgba(0,0,0,0.1);
        }
    </style>

    <div class="mb-10 fade-in-up" style="animation-delay: 0.1s">
        <h1 class="text-3xl font-black text-gray-900 leading-none">Dashboard</h1>
        <p class="text-sm text-gray-500 font-medium mt-2">Ringkasan performa restoran Anda hari ini.</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Pendapatan -->
        <div class="stat-card bg-white p-6 rounded-3xl shadow-sm border border-gray-100 fade-in-up" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m.599-1c.51-.498.401-1.191-.111-1.688l-1.488-1.488A2.5 2.5 0 0112 11c1.11 0 2.08.402 2.599 1M12 11V7m0 4v8m0 0v1m-6-1h12"/></svg>
                </div>
                <span class="text-[10px] font-black text-green-500 bg-green-50 px-2 py-1 rounded-lg uppercase">+12%</span>
            </div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Pendapatan</p>
            <h3 class="text-2xl font-black text-gray-900 mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
        </div>

        <!-- Pesanan -->
        <div class="stat-card bg-white p-6 rounded-3xl shadow-sm border border-gray-100 fade-in-up" style="animation-delay: 0.3s">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <span class="text-[10px] font-black text-blue-500 bg-blue-50 px-2 py-1 rounded-lg uppercase">Daily</span>
            </div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Pesanan</p>
            <h3 class="text-2xl font-black text-gray-900 mt-1">{{ $totalOrders }}</h3>
        </div>

        <!-- Menu -->
        <div class="stat-card bg-white p-6 rounded-3xl shadow-sm border border-gray-100 fade-in-up" style="animation-delay: 0.4s">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
            </div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Menu</p>
            <h3 class="text-2xl font-black text-gray-900 mt-1">{{ $totalMenu }}</h3>
        </div>

        <!-- User -->
        <div class="stat-card bg-white p-6 rounded-3xl shadow-sm border border-gray-100 fade-in-up" style="animation-delay: 0.5s">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
            </div>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Admin Aktif</p>
            <h3 class="text-2xl font-black text-gray-900 mt-1">{{ $totalAdmin }}</h3>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden fade-in-up" style="animation-delay: 0.6s">
        <div class="p-8 border-b border-gray-50 flex justify-between items-center">
            <h3 class="text-xl font-black text-gray-900 uppercase tracking-tighter">Pesanan Terbaru</h3>
            <a href="{{ route('admin.transaksi.index') }}" class="text-xs font-black text-blue-600 hover:text-blue-700 uppercase tracking-widest bg-blue-50 px-4 py-2 rounded-full transition-all">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 text-gray-400 text-[10px] uppercase tracking-[0.2em] font-black">
                        <th class="px-8 py-5">Nama Pelanggan</th>
                        <th class="px-8 py-5">Menu</th>
                        <th class="px-8 py-5">Total</th>
                        <th class="px-8 py-5">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-8 py-5 font-bold text-gray-900 group-hover:text-blue-600 transition-colors">{{ $order->nama_pelanggan }}</td>
                        <td class="px-8 py-5 text-gray-500 font-medium">
                            {{ is_array($order->menu_pesanan) ? implode(', ', array_column($order->menu_pesanan, 'name')) : $order->menu_pesanan }}
                        </td>
                        <td class="px-8 py-5 font-black text-gray-900 italic">Rp {{ number_format($order->jumlah, 0, ',', '.') }}</td>
                        <td class="px-8 py-5">
                            <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest
                                {{ $order->status == 'success' ? 'bg-green-50 text-green-600' : ($order->status == 'failed' ? 'bg-red-50 text-red-600' : 'bg-orange-50 text-orange-600') }}">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center text-gray-300 font-bold italic">Belum ada pesanan masuk hari ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
