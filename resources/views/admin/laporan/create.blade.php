<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Tambah Catatan Laporan</h2>
                <p class="text-sm text-gray-500">Masukkan data performa bulanan untuk analitik DullStore.</p>
            </div>
            <a href="{{ route('admin.laporan.index') }}" class="text-sm font-semibold text-gray-400 hover:text-gray-600 transition">
                &larr; Kembali
            </a>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
            <form action="{{ route('admin.laporan.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase">Periode Laporan</label>
                        <input type="month" name="periode" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:border-blue-500 focus:ring-0 transition text-sm">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase">Total Pendapatan ($)</label>
                        <input type="number" name="pendapatan" placeholder="Contoh: 15000" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:border-blue-500 focus:ring-0 transition text-sm">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase">Total Pesanan</label>
                        <input type="number" name="total_pesanan" placeholder="0" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:border-blue-500 focus:ring-0 transition text-sm">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase">Status Performa</label>
                        <select name="status" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:border-blue-500 focus:ring-0 transition text-sm appearance-none">
                            <option value="naik">Meningkat (Upward)</option>
                            <option value="stabil">Stabil</option>
                            <option value="turun">Menurun</option>
                        </select>
                    </div>

                    <div class="md:col-span-2 space-y-2">
                        <label class="text-xs font-bold text-gray-400 uppercase">Catatan Analisis</label>
                        <textarea name="catatan" rows="4" placeholder="Tulis ringkasan performa bulan ini..." class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:border-blue-500 focus:ring-0 transition text-sm"></textarea>
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full bg-[#080d1a] text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-900/20 hover:bg-blue-700 transition-all duration-300">
                        Simpan Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>