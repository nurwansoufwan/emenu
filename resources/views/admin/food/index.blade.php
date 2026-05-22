<x-app-layout>
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900">Daftar Menu</h1>
            <p class="text-sm text-gray-500 font-medium">Kelola menu makanan dan minuman yang ditawarkan.</p>
        </div>
        <button onclick="openModal('addModal')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg shadow-blue-900/20 transition-all active:scale-95 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Menu
        </button>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-600 px-4 py-3 rounded-xl mb-6 flex items-center">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        <span class="text-sm font-bold">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-gray-400 text-[10px] uppercase tracking-widest font-bold">
                    <th class="px-6 py-4">Menu</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4">Stok</th>
                    <th class="px-6 py-4">Opsi Aktif</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @forelse($foods as $item)
                <tr class="hover:bg-gray-50 transition-colors {{ !$item->is_available ? 'bg-gray-50/50' : '' }}">
                    <td class="px-6 py-4 flex items-center">
                        <img src="{{ $item->image ? (str_starts_with($item->image, 'http') ? $item->image : asset('storage/'.$item->image)) : 'https://via.placeholder.com/150' }}" class="w-10 h-10 rounded-lg object-cover mr-4 shadow-sm {{ !$item->is_available ? 'grayscale' : '' }}">
                        <div>
                            <p class="font-bold {{ $item->is_available ? 'text-gray-900' : 'text-gray-400' }}">{{ $item->name }}</p>
                            <p class="text-[10px] text-gray-400 truncate w-32">{{ $item->description }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-[10px] font-bold text-gray-600 uppercase">{{ $item->category->name ?? 'N/A' }}</span>
                    </td>
                    <td class="px-6 py-4 font-black text-gray-900">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        @if($item->is_available)
                            <span class="inline-flex items-center text-green-600 text-[10px] font-black uppercase">
                                <span class="w-1.5 h-1.5 bg-green-600 rounded-full mr-1.5"></span>
                                Tersedia
                            </span>
                        @else
                            <span class="inline-flex items-center text-red-400 text-[10px] font-black uppercase">
                                <span class="w-1.5 h-1.5 bg-red-400 rounded-full mr-1.5"></span>
                                Habis
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @if($item->options && in_array('spicy', $item->options))
                                <span class="bg-red-50 text-red-600 text-[8px] font-black uppercase px-2 py-0.5 rounded">Level 0-5</span>
                            @endif
                            @if($item->options && in_array('drink', $item->options))
                                <span class="bg-blue-50 text-blue-600 text-[8px] font-black uppercase px-2 py-0.5 rounded">Ice & Size</span>
                            @endif
                            @if($item->options && in_array('icecream', $item->options))
                                <span class="bg-purple-50 text-purple-600 text-[8px] font-black uppercase px-2 py-0.5 rounded">Cone / Cup</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <button onclick="editFood({{ json_encode($item) }})" class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <form action="{{ route('admin.food.destroy', $item) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus menu ini?')" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-gray-400 font-medium">Belum ada menu.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl w-full max-w-lg p-8 shadow-2xl scale-95 transition-transform duration-300 overflow-y-auto max-h-[90vh]">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black text-gray-900">Tambah Menu Baru</h2>
                <button onclick="closeModal('addModal')" class="text-gray-400 hover:text-gray-900 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form action="{{ route('admin.food.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-2xl">
                        <div>
                            <p class="text-xs font-bold text-gray-900">Status Menu</p>
                            <p class="text-[10px] text-gray-400 font-medium">Menu ini tersedia untuk dipesan?</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_available" value="1" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Nama Menu</label>
                        <input type="text" name="name" required class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900" placeholder="Contoh: Nasi Goreng Spesial">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Kategori</label>
                            <select name="category_id" required class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900">
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Harga</label>
                            <input type="number" name="price" required class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900" placeholder="25000">
                        </div>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-2xl space-y-3">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Kustomisasi Menu</p>
                        <div class="flex items-center">
                            <input type="checkbox" name="options[]" value="spicy" id="addSpicy" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition-all">
                            <label for="addSpicy" class="ml-3 text-xs font-bold text-gray-700">Level Pedas (0-5)</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="options[]" value="drink" id="addDrink" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition-all">
                            <label for="addDrink" class="ml-3 text-xs font-bold text-gray-700">Opsi Minuman (Ice & Cup Size)</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="options[]" value="icecream" id="addIceCream" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition-all">
                            <label for="addIceCream" class="ml-3 text-xs font-bold text-gray-700">Opsi Ice Cream (Cone / Cup)</label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Deskripsi</label>
                        <textarea name="description" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900" rows="3" placeholder="Jelaskan detail menu..."></textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Foto Menu</label>
                        <input type="file" name="image" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                    </div>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="closeModal('addModal')" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3 rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-900/20 transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl w-full max-w-lg p-8 shadow-2xl scale-95 transition-transform duration-300 overflow-y-auto max-h-[90vh]">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-black text-gray-900">Edit Menu</h2>
                <button onclick="closeModal('editModal')" class="text-gray-400 hover:text-gray-900 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between items-center bg-gray-50 p-4 rounded-2xl">
                        <div>
                            <p class="text-xs font-bold text-gray-900">Status Menu</p>
                            <p class="text-[10px] text-gray-400 font-medium">Menu ini tersedia untuk dipesan?</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_available" id="editAvailable" value="1" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Nama Menu</label>
                        <input type="text" name="name" id="editName" required class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Kategori</label>
                            <select name="category_id" id="editCategoryId" required class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900">
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Harga</label>
                            <input type="number" name="price" id="editPrice" required class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900">
                        </div>
                    </div>

                    <div class="p-4 bg-gray-50 rounded-2xl space-y-3">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Kustomisasi Menu</p>
                        <div class="flex items-center">
                            <input type="checkbox" name="options[]" value="spicy" id="editSpicy" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition-all">
                            <label for="editSpicy" class="ml-3 text-xs font-bold text-gray-700">Level Pedas (0-5)</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="options[]" value="drink" id="editDrink" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition-all">
                            <label for="editDrink" class="ml-3 text-xs font-bold text-gray-700">Opsi Minuman (Ice & Cup Size)</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="options[]" value="icecream" id="editIceCream" class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 transition-all">
                            <label for="editIceCream" class="ml-3 text-xs font-bold text-gray-700">Opsi Ice Cream (Cone / Cup)</label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Deskripsi</label>
                        <textarea name="description" id="editDescription" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900" rows="3"></textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Update Foto</label>
                        <input type="file" name="image" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                    </div>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="closeModal('editModal')" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3 rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-900/20 transition-all">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            setTimeout(() => modal.firstElementChild.classList.remove('scale-95'), 10);
        }
        function closeModal(id) {
            const modal = document.getElementById(id);
            modal.firstElementChild.classList.add('scale-95');
            setTimeout(() => modal.classList.add('hidden'), 300);
        }
        function editFood(food) {
            document.getElementById('editForm').action = `/admin/food/${food.id}`;
            document.getElementById('editName').value = food.name;
            document.getElementById('editCategoryId').value = food.category_id;
            document.getElementById('editPrice').value = food.price;
            document.getElementById('editDescription').value = food.description || '';
            document.getElementById('editAvailable').checked = food.is_available;
            
            const options = food.options || [];
            document.getElementById('editSpicy').checked = options.includes('spicy');
            document.getElementById('editDrink').checked = options.includes('drink');
            document.getElementById('editIceCream').checked = options.includes('icecream');
            
            openModal('editModal');
        }
    </script>
</x-app-layout>