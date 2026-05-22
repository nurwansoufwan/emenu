<x-app-layout>
    <div class="space-y-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl font-black text-gray-900 leading-none">Pemesanan</h1>
                <p class="text-sm text-gray-500 font-medium mt-2">Kelola antrean pesanan pelanggan secara real-time.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="bg-white border-2 border-gray-100 rounded-3xl px-6 py-3 shadow-sm">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Total Antrean</p>
                    <p class="text-xl font-black text-gray-900">{{ $transaksis->where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="bg-blue-600 text-white px-6 py-4 rounded-3xl font-bold text-sm shadow-xl shadow-blue-900/20 animate-bounce">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-400 text-[10px] uppercase tracking-[0.2em] font-black">
                            <th class="px-8 py-6">Meja & Pelanggan</th>
                            <th class="px-8 py-6">Detail Pesanan</th>
                            <th class="px-8 py-6 text-center">Total</th>
                            <th class="px-8 py-6 text-center">Status</th>
                            <th class="px-8 py-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($transaksis as $item)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-[#080d1a] text-white rounded-2xl flex items-center justify-center font-black text-lg shadow-lg">
                                        {{ $item->meja }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-gray-900 uppercase tracking-tight">{{ $item->nama_pelanggan }}</p>
                                        <p class="text-[10px] text-gray-400 font-bold tracking-widest uppercase mt-1">{{ $item->created_at->format('H:i') }} WIB</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="space-y-1">
                                    @if(is_array($item->menu_pesanan))
                                        @foreach($item->menu_pesanan as $menu)
                                        <div class="text-xs">
                                            <span class="font-bold text-gray-800">{{ $menu['quantity'] }}x {{ $menu['name'] }}</span>
                                            @if(isset($menu['options']) && !empty($menu['options']))
                                                <span class="text-[10px] text-gray-400 italic">
                                                    ({{ collect($menu['options'])->map(fn($v, $k) => "$k: $v")->implode(', ') }})
                                                </span>
                                            @endif
                                        </div>
                                        @endforeach
                                    @else
                                        <p class="text-xs text-gray-600 font-medium">{{ $item->menu_pesanan }}</p>
                                    @endif

                                    @if(isset($item->catatan) && !empty($item->catatan))
                                        <div class="text-[11px] bg-amber-50 text-amber-800 px-3 py-1.5 rounded-xl border border-amber-100 mt-2.5 font-bold inline-block leading-relaxed">
                                            📝 Catatan: "{{ $item->catatan }}"
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <p class="text-sm font-black text-blue-600 italic">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-8 py-6 text-center">
                                @if($item->status == 'pending')
                                    <span class="px-4 py-1.5 text-[9px] font-black uppercase rounded-full bg-orange-50 text-orange-500 border border-orange-100 tracking-widest">
                                        Pending
                                    </span>
                                @elseif($item->status == 'success')
                                    <span class="px-4 py-1.5 text-[9px] font-black uppercase rounded-full bg-green-50 text-green-600 border border-green-100 tracking-widest">
                                        Success
                                    </span>
                                @else
                                    <span class="px-4 py-1.5 text-[9px] font-black uppercase rounded-full bg-red-50 text-red-600 border border-red-100 tracking-widest">
                                        Failed
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-2">
                                    @if($item->status == 'pending')
                                        <form action="{{ route('admin.transaksi.update', $item->id) }}" method="POST" class="inline">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="success">
                                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all active:scale-95 shadow-lg shadow-emerald-900/20">
                                                Terima Pesanan
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.transaksi.update', $item->id) }}" method="POST" class="inline">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="failed">
                                            <button type="submit" class="bg-white border-2 border-red-100 text-red-500 hover:bg-red-50 px-5 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all active:scale-95">
                                                Cancel Pesanan
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.transaksi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-300 hover:text-red-500 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-32 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                                        <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    </div>
                                    <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px]">Antrean kosong.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>