<x-app-layout>
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-gray-800">Daftar Produk Terjual</h2>
                <p class="text-sm text-gray-500 font-medium">Data lengkap seluruh unit produk yang telah lunas terbayar.</p>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" id="searchInput" class="pl-10 pr-4 py-2 bg-white border border-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all w-64 shadow-sm" placeholder="Cari nama produk...">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse" id="productTable">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Info Produk</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">Kategori</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">Unit Terjual</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-right">Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($products as $product)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center overflow-hidden border border-gray-100">
                                        <img src="{{ $product->image_url ?? asset('images/placeholder.png') }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800 product-name">{{ $product->nama }}</p>
                                        <p class="text-[10px] text-gray-400">{{ $product->category }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 text-[10px] font-bold uppercase rounded-full bg-blue-50 text-blue-600 border border-blue-100">{{ $product->category }}</span>
                            </td>
                            <td class="px-6 py-4 text-center font-black text-gray-900">{{ $product->total_terjual }}</td>
                            <td class="px-6 py-4 text-right font-black text-emerald-600">+ ${{ number_format($product->total_revenue, 2) }}</td>
                        </tr>
                        @empty
                        <tr id="noData">
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400">Belum ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#productTable tbody tr:not(#noData)');

            rows.forEach(row => {
                let name = row.querySelector('.product-name').textContent.toLowerCase();
                row.style.display = name.includes(filter) ? "" : "none";
            });
        });
    </script>
</x-app-layout>