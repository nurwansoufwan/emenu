<x-app-layout>
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-gray-800">Antrean Pesanan</h2>
                <p class="text-sm text-gray-500 font-medium">Kelola dan proses pesanan masuk dari konsumen secara real-time.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="bg-white border border-gray-100 rounded-xl px-4 py-2 shadow-sm">
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Total Pesanan Hari Ini</p>
                    <p class="text-lg font-black text-gray-900">{{ $transaksis->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Menu Pesanan</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">Total Bayar</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-center">Status</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($transaksis as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-bold text-sm">
                                        {{ strtoupper(substr($item->nama_pelanggan, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-800">{{ $item->nama_pelanggan }}</p>
                                        <p class="text-[10px] text-gray-400 font-medium">{{ $item->created_at->format('H:i') }} WIB</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600 font-medium line-clamp-1">{{ $item->menu_pesanan }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <p class="text-sm font-black text-gray-900">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->status == 'pending')
                                    <span class="px-3 py-1 text-[10px] font-bold uppercase rounded-full bg-orange-50 text-orange-500 border border-orange-100">
                                        Pending
                                    </span>
                                @elseif($item->status == 'success')
                                    <span class="px-3 py-1 text-[10px] font-bold uppercase rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100">
                                        Selesai
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-[10px] font-bold uppercase rounded-full bg-red-50 text-red-600 border border-red-100">
                                        Gagal
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    @if($item->status == 'pending')
                                        <form action="{{ route('admin.transaksi.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="success">
                                            <button type="submit" class="px-4 py-1.5 bg-[#080d1a] text-white rounded-lg text-[10px] font-bold hover:bg-blue-700 transition shadow-sm">
                                                PROSES
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form action="{{ route('admin.transaksi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus pesanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="p-4 bg-gray-50 rounded-full mb-4">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    </div>
                                    <p class="text-sm text-gray-400 font-bold">Belum ada pesanan masuk.</p>
                                    <p class="text-xs text-gray-400 mt-1">Pesanan dari konsumen akan muncul di sini secara otomatis.</p>
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