<x-app-layout>
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900">Kategori Menu</h1>
            <p class="text-sm text-gray-500 font-medium">Kelola kategori makanan dan minuman restoran Anda.</p>
        </div>
        <button onclick="openModal('addModal')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg shadow-blue-900/20 transition-all active:scale-95 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Kategori
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
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Nama Kategori</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @forelse($categories as $category)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-gray-400 font-medium">#{{ $category->id }}</td>
                    <td class="px-6 py-4 font-bold text-gray-900">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <button onclick="editCategory({{ $category->id }}, '{{ $category->name }}')" class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <form action="{{ route('admin.category.destroy', $category) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus kategori ini?')" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-gray-400 font-medium">Belum ada kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl scale-95 transition-transform duration-300">
            <h2 class="text-2xl font-black text-gray-900 mb-6">Tambah Kategori</h2>
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Kategori</label>
                    <input type="text" name="name" required class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900" placeholder="Contoh: Makanan Berat">
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
        <div class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl scale-95 transition-transform duration-300">
            <h2 class="text-2xl font-black text-gray-900 mb-6">Edit Kategori</h2>
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Kategori</label>
                    <input type="text" name="name" id="editName" required class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900">
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
        function editCategory(id, name) {
            document.getElementById('editForm').action = `/admin/category/${id}`;
            document.getElementById('editName').value = name;
            openModal('editModal');
        }
    </script>
</x-app-layout>
