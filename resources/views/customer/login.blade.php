<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>The Bilabola Space | Masuk E-Menu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap');
        
        body { 
            font-family: 'Outfit', sans-serif; 
            background-color: #fcfdfe; 
            background-image: 
                radial-gradient(at 0% 0%, rgba(37, 99, 235, 0.03) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(37, 99, 235, 0.03) 0px, transparent 50%);
            min-height: 100vh;
        }

        .tab-btn.active {
            background-color: #080d1a;
            color: white;
            box-shadow: 0 10px 25px -5px rgba(8, 13, 26, 0.25);
        }
    </style>
</head>
<body class="flex flex-col justify-center items-center px-6 py-12 min-height-screen">

    <!-- Premium Background Shapes -->
    <div class="fixed inset-0 pointer-events-none -z-10 overflow-hidden">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-100/30 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 -right-24 w-80 h-80 bg-indigo-100/30 rounded-full blur-3xl"></div>
    </div>

    <!-- Branding -->
    <div class="text-center mb-10">
        <h1 class="text-3xl font-black italic tracking-tighter uppercase leading-none text-[#080d1a]">The Bilabola Space</h1>
        <p class="text-[10px] font-black text-blue-600 uppercase tracking-widest mt-2">Premium E-Menu System</p>
    </div>

    <!-- Main Container -->
    <div class="w-full max-w-sm bg-white border border-gray-100 rounded-[2.5rem] p-8 shadow-2xl shadow-gray-200/60 relative overflow-hidden">
        
        <!-- Tab Switched Buttons -->
        <div class="flex bg-gray-50 p-1.5 rounded-2xl mb-8">
            <button onclick="switchTab('login')" id="login-tab-btn" class="tab-btn active w-1/2 py-3 text-xs font-black uppercase tracking-widest rounded-xl transition-all duration-300">
                Sign In
            </button>
            <button onclick="switchTab('register')" id="register-tab-btn" class="tab-btn w-1/2 py-3 text-xs font-black uppercase tracking-widest rounded-xl transition-all duration-300 text-gray-400">
                Daftar
            </button>
        </div>

        <!-- Notification Banner -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-600 text-xs font-bold leading-relaxed">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl text-red-600 text-xs font-bold leading-relaxed">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form Sign In (Passwordless via Email) -->
        <div id="login-form-container">
            <form action="{{ route('customer.login.submit') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-[9px] font-black uppercase text-gray-400 tracking-widest mb-2">Alamat Email Anda</label>
                    <input type="email" name="email" value="{{ old('email', session('registered_email')) }}" required
                        class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-2xl p-4.5 text-xs font-bold outline-none transition-all"
                        placeholder="nama@email.com">
                </div>
                <button type="submit" class="w-full bg-[#080d1a] hover:bg-black text-white py-5 rounded-2xl text-xs font-black uppercase tracking-[0.2em] active:scale-95 transition-all shadow-xl shadow-gray-900/10">
                    Masuk Sekarang
                </button>
            </form>
        </div>

        <!-- Form Register (Passwordless Auto Login) -->
        <div id="register-form-container" class="hidden">
            <form action="{{ route('customer.register.submit') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-[9px] font-black uppercase text-gray-400 tracking-widest mb-2">Nama Lengkap</label>
                    <input type="text" name="name" required
                        class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-2xl p-4.5 text-xs font-bold outline-none transition-all"
                        placeholder="Contoh: Budi Santoso">
                </div>
                <div>
                    <label class="block text-[9px] font-black uppercase text-gray-400 tracking-widest mb-2">Alamat Email</label>
                    <input type="email" name="email" required
                        class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-2xl p-4.5 text-xs font-bold outline-none transition-all"
                        placeholder="nama@email.com">
                </div>
                <button type="submit" class="w-full bg-[#080d1a] hover:bg-black text-white py-5 rounded-2xl text-xs font-black uppercase tracking-[0.2em] active:scale-95 transition-all shadow-xl shadow-gray-900/10">
                    Daftar & Masuk
                </button>
            </form>
        </div>

        <!-- Divider -->
        <div class="relative my-8 text-center">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-100"></div></div>
            <span class="relative bg-white px-4 text-[9px] font-black text-gray-400 uppercase tracking-widest">Atau</span>
        </div>

        <!-- Guest Bypass Button -->
        <form action="{{ route('customer.guest.submit') }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-white border-2 border-gray-100 text-gray-700 py-5 rounded-2xl text-xs font-black uppercase tracking-[0.2em] active:scale-95 transition-all hover:bg-gray-50 flex items-center justify-center space-x-2">
                <span>🚪</span>
                <span>Masuk sebagai Guest</span>
            </button>
        </form>

    </div>

    <!-- Back to Admin login link -->
    <a href="{{ route('login') }}" class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mt-8 hover:text-gray-900 transition-colors">
        Login Staff/Admin →
    </a>

    <script>
        function switchTab(tab) {
            const loginForm = document.getElementById('login-form-container');
            const registerForm = document.getElementById('register-form-container');
            const loginBtn = document.getElementById('login-tab-btn');
            const registerBtn = document.getElementById('register-tab-btn');

            if (tab === 'login') {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                loginBtn.classList.add('active', 'text-white');
                loginBtn.classList.remove('text-gray-400');
                registerBtn.classList.remove('active', 'text-white');
                registerBtn.classList.add('text-gray-400');
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                loginBtn.classList.remove('active', 'text-white');
                loginBtn.classList.add('text-gray-400');
                registerBtn.classList.add('active', 'text-white');
                registerBtn.classList.remove('text-gray-400');
            }
        }

        // Auto-switch to register tab if requested via query parameter
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('tab') === 'register') {
            switchTab('register');
        }
    </script>
</body>
</html>
