<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Laporan</h2>
                <p class="text-sm text-gray-500">Perbarui data analitik untuk periode tertentu.</p>
            </div>
            <a href="{{ route('admin.laporan.index') }}" class="text-sm font-semibold text-gray-400 hover:text-gray-600 transition">
                &larr; Batal
            </a>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
            <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase">Periode Laporan</label>
                        <input type="month" name="periode" value="{{ $laporan->periode }}" class="w-full px-4 py-3 rounded-xl border border-gray-100 bg-gray-50 text-gray-500 cursor-not-allowed text-sm" readonly>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase">Total Pendapatan ($)</label>
                        <input type="number" name="pendapatan" value="{{ $laporan->pendapatan }}" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:border-blue-500 focus:ring-0 transition text-sm">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase">Total Pesanan</label>
                        <input type="number" name="total_pesanan" value="{{ $laporan->total_pesanan }}" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:border-blue-500 focus:ring-0 transition text-sm">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase">Status</label>
                        <select name="status" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:border-blue-500 focus:ring-0 transition text-sm">
                            <option value="naik" {{ $laporan->status == 'naik' ? 'selected' : '' }}>Meningkat</option>
                            <option value="stabil" {{ $laporan->status == 'stabil' ? 'selected' : '' }}>Stabil</option>
                            <option value="turun" {{ $laporan->status == 'turun' ? 'selected' : '' }}>Menurun</option>
                        </select>
                    </div>

                    <div class="md:col-span-2 space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase">Catatan Analisis</label>
                        <textarea name="catatan" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:border-blue-500 focus:ring-0 transition text-sm">{{ $laporan->catatan }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex space-x-4">
                    <button type="submit" class="flex-1 bg-blue-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-900/10 hover:bg-blue-700 transition-all">
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>