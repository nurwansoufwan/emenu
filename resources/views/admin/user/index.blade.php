<x-app-layout>
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900 leading-none">Kelola Admin</h1>
            <p class="text-sm text-gray-500 font-medium mt-2">Atur siapa saja yang memiliki akses ke panel administrasi.</p>
        </div>
        <button onclick="openModal('addUserModal')" class="bg-[#080d1a] hover:bg-black text-white px-6 py-3 rounded-xl font-bold text-sm shadow-xl shadow-blue-900/20 transition-all active:scale-95 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            Tambah Admin
        </button>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border border-green-100 text-green-600 px-4 py-3 rounded-xl mb-6 flex items-center">
        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        <span class="text-sm font-bold">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-gray-400 text-[10px] uppercase tracking-[0.2em] font-black">
                    <th class="px-8 py-5">Nama</th>
                    <th class="px-8 py-5">Email</th>
                    <th class="px-8 py-5">Role</th>
                    <th class="px-8 py-5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 text-sm">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-8 py-5">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 font-black mr-4 uppercase">
                                {{ substr($user->name, 0, 2) }}
                            </div>
                            <span class="font-bold text-gray-900">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-gray-500 font-medium">{{ $user->email }}</td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest {{ $user->role == 'superadmin' ? 'bg-purple-50 text-purple-600' : 'bg-blue-50 text-blue-600' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-right space-x-2">
                        <button onclick="editUser({{ json_encode($user) }})" class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.user.destroy', $user) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus admin ini?')" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div id="addUserModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl">
            <h2 class="text-2xl font-black text-gray-900 mb-6">Tambah Admin Baru</h2>
            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf
                <div class="space-y-4 mb-8">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Nama Lengkap</label>
                        <input type="text" name="name" required class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Email</label>
                        <input type="email" name="email" required class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Password</label>
                        <input type="password" name="password" required class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Role</label>
                        <select name="role" required class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900">
                            <option value="admin">Admin</option>
                            <option value="superadmin">Superadmin</option>
                        </select>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="closeModal('addUserModal')" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3 rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="flex-1 bg-[#080d1a] hover:bg-black text-white font-bold py-3 rounded-xl transition-all">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editUserModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-[100] flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl">
            <h2 class="text-2xl font-black text-gray-900 mb-6">Edit Admin</h2>
            <form id="editUserForm" method="POST">
                @csrf @method('PUT')
                <div class="space-y-4 mb-8">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Nama Lengkap</label>
                        <input type="text" name="name" id="editUserName" required class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Email</label>
                        <input type="email" name="email" id="editUserEmail" required class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Password (Kosongkan jika tidak ganti)</label>
                        <input type="password" name="password" class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Role</label>
                        <select name="role" id="editUserRole" required class="w-full bg-gray-50 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 font-medium text-gray-900">
                            <option value="admin">Admin</option>
                            <option value="superadmin">Superadmin</option>
                        </select>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="closeModal('editUserModal')" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-3 rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="flex-1 bg-[#080d1a] hover:bg-black text-white font-bold py-3 rounded-xl transition-all">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
        function editUser(user) {
            document.getElementById('editUserForm').action = `/admin/user/${user.id}`;
            document.getElementById('editUserName').value = user.name;
            document.getElementById('editUserEmail').value = user.email;
            document.getElementById('editUserRole').value = user.role;
            openModal('editUserModal');
        }
    </script>
</x-app-layout>
