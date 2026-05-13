<x-app-layout>
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Analitik & Laporan</h2>
                <p class="text-sm text-gray-500 font-medium">Ringkasan performa penjualan dan arus kas DullStore.</p>
            </div>
            <div class="flex items-center gap-2">
                <button class="px-4 py-2 bg-[#080d1a] text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-900/20 hover:bg-blue-700 transition">
                    Ekspor PDF
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Uang Masuk</p>
                    <span class="p-2 bg-green-50 text-green-600 rounded-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </span>
                </div>
                <h3 class="text-2xl font-black text-gray-900">$ 17,351</h3>
                <p class="text-[11px] text-green-500 font-bold mt-2">↑ 13.54% <span class="text-gray-400 font-medium">dibanding bulan lalu</span></p>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total Uang Keluar</p>
                    <span class="p-2 bg-red-50 text-red-600 rounded-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"></path></svg>
                    </span>
                </div>
                <h3 class="text-2xl font-black text-gray-900">$ 4,210</h3>
                <p class="text-[11px] text-gray-400 font-medium mt-2">Biaya operasional & stok</p>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Saldo Bersih</p>
                    <span class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </span>
                </div>
                <h3 class="text-2xl font-black text-gray-900">$ 13,141</h3>
                <p class="text-[11px] text-blue-500 font-bold mt-2">Kesehatan Keuangan: Stabil</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h4 class="text-sm font-bold text-gray-800 uppercase tracking-widest">Total Product Terjual</h4>
                        <p class="text-[10px] text-gray-400 font-bold mt-1">SEMUA PRODUK YANG BERHASIL DIBAYAR</p>
                    </div>
                    <a href="{{ route('admin.laporan.products') }}" class="px-4 py-1.5 bg-gray-50 text-blue-600 rounded-lg text-[11px] font-bold hover:bg-blue-50 transition border border-gray-100">
                        Lihat Semua
                    </a>
                </div>

                <div class="space-y-4">
                    @forelse($topProducts as $product)
                    <div class="flex items-center justify-between p-4 hover:bg-gray-50/80 rounded-2xl transition border border-transparent hover:border-gray-100">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center overflow-hidden border border-gray-100">
                                <img src="{{ $product->image_url ?? '/images/placeholder-food.png' }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-800">{{ $product->nama }}</p>
                                <p class="text-[10px] text-gray-400 font-medium">{{ $product->category ?? 'General' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-black text-gray-900">{{ $product->total_terjual }} Terjual</p>
                            <p class="text-[10px] text-emerald-500 font-bold">+$ {{ number_format($product->total_revenue, 2) }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-sm text-gray-400 py-10">Belum ada data penjualan produk.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">
                <h4 class="text-sm font-bold text-gray-800 uppercase tracking-widest mb-6">Overview Produk</h4>
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Average Sales</p>
                        <p class="text-2xl font-black text-gray-900">$ 2,246.75</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Total Revenue</p>
                        <p class="text-2xl font-black text-gray-900">$ 2.2M</p>
                    </div>
                    <div class="pt-4 border-t border-gray-50">
                        <p class="text-[11px] text-gray-500 font-medium leading-relaxed italic">
                            "Data mencakup performa penjualan harian DullStore berdasarkan status transaksi yang berhasil."
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>