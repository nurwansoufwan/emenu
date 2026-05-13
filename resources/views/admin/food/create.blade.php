<x-app-layout>
    <div class="max-w-2xl bg-white p-8 rounded-xl shadow-sm">
        <h2 class="text-xl font-bold mb-6">Tambah Menu Baru</h2>
        
        <form action="{{ route('admin.food.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Makanan</label>
                    <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="Makanan">Makanan</option>
                        <option value="Minuman">Minuman</option>
                        <option value="Snack">Snack</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                    <input type="number" name="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                <div class="pt-4 flex space-x-3">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg font-bold">Simpan Menu</button>
                    <a href="{{ route('admin.food.index') }}" class="bg-gray-100 text-gray-600 px-6 py-2 rounded-lg font-bold">Batal</a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>