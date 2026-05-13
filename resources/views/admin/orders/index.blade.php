<x-app-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-black text-gray-900">Pesanan Masuk</h1>
        <p class="text-sm text-gray-500 font-medium">Pantau dan kelola pesanan pelanggan secara real-time.</p>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-600 px-4 py-3 rounded-xl mb-6 flex items-center">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        <span class="text-sm font-bold">{{ session('success') }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 gap-6">
        @forelse($orders as $order)
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 flex flex-col md:flex-row justify-between items-start md:items-center group hover:shadow-md transition-shadow">
            <div class="mb-4 md:mb-0">
                <div class="flex items-center space-x-3 mb-2">
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[10px] font-black uppercase tracking-widest">Order #{{ $order->id }}</span>
                    <span class="text-xs text-gray-400 font-medium">{{ $order->created_at->diffForHumans() }}</span>
                </div>
                <h3 class="text-xl font-black text-gray-900 mb-2">{{ $order->nama_pelanggan }}</h3>
                <div class="text-sm text-gray-500 space-y-1">
                    @php
                        $items = is_array($order->menu_pesanan) ? $order->menu_pesanan : json_decode($order->menu_pesanan, true);
                    @endphp
                    @if(is_array($items))
                        @foreach($items as $item)
                        <p class="flex items-center">
                            <span class="w-2 h-2 bg-gray-200 rounded-full mr-2"></span>
                            <span class="font-bold text-gray-700">{{ $item['qty'] ?? 1 }}x</span> 
                            <span class="ml-2">{{ $item['name'] ?? 'Menu' }}</span>
                        </p>
                        @endforeach
                    @else
                        <p>{{ $order->menu_pesanan }}</p>
                    @endif
                </div>
            </div>

            <div class="flex flex-col items-end space-y-4 w-full md:w-auto">
                <div class="text-right">
                    <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest">Total Bayar</p>
                    <p class="text-2xl font-black text-orange-600">Rp {{ number_format($order->jumlah, 0, ',', '.') }}</p>
                </div>
                
                <div class="flex items-center space-x-2">
                    <form action="{{ route('admin.transaksi.update', $order) }}" method="POST" class="flex items-center space-x-2">
                        @csrf @method('PUT')
                        <select name="status" onchange="this.form.submit()" class="bg-gray-50 border-none rounded-xl text-xs font-bold uppercase tracking-widest px-4 py-2 focus:ring-2 focus:ring-blue-500
                            {{ $order->status == 'success' ? 'text-green-600' : ($order->status == 'failed' ? 'text-red-600' : 'text-orange-600') }}">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="success" {{ $order->status == 'success' ? 'selected' : '' }}>Success</option>
                            <option value="failed" {{ $order->status == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </form>
                    
                    <form action="{{ route('admin.transaksi.destroy', $order) }}" method="POST" onsubmit="return confirm('Hapus pesanan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 text-gray-300 hover:text-red-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center bg-white rounded-3xl border-2 border-dashed border-gray-100">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
            </div>
            <p class="text-gray-400 font-bold">Belum ada pesanan masuk.</p>
        </div>
        @endforelse
    </div>
</x-app-layout>