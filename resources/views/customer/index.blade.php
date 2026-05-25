<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>The Bilabola Space | Premium Menu</title>
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

        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Staggered Animation */
        .menu-item-fade {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Floating Animation for Header */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        .header-animate { animation: float 4s ease-in-out infinite; }

        .category-pill.active {
            background-color: #080d1a;
            color: white;
            box-shadow: 0 15px 30px -10px rgba(8, 13, 26, 0.3);
            transform: translateY(-2px);
        }

        .bottom-sheet {
            transform: translateY(100%);
            transition: transform 0.5s cubic-bezier(0.32, 0.72, 0, 1);
        }
        .bottom-sheet.active { transform: translateY(0); }

        /* Drawer styling */
        #drawer-panel {
            transform: translateX(-100%);
            transition: transform 0.5s cubic-bezier(0.32, 0.72, 0, 1);
        }
        #drawer-panel.active {
            transform: translateX(0);
        }
        
        /* Pulse effect for unavailable items */
        .sold-out-pulse {
            animation: pulse-border 2s infinite;
        }
        @keyframes pulse-border {
            0% { border-color: rgba(0,0,0,0.05); }
            50% { border-color: rgba(0,0,0,0.15); }
            100% { border-color: rgba(0,0,0,0.05); }
        }
    </style>
</head>
<body class="pb-40 text-gray-900">

    <!-- Premium Animated Background Shapes -->
    <div class="fixed inset-0 pointer-events-none -z-10 overflow-hidden">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-100/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-1/2 -right-24 w-64 h-64 bg-indigo-100/20 rounded-full blur-3xl animate-bounce" style="animation-duration: 8s"></div>
    </div>

    <!-- Header -->
    <header class="px-6 pt-10 pb-4 flex justify-between items-center sticky top-0 z-50 bg-white/40 backdrop-blur-xl border-b border-gray-100/50">
        <a href="{{ route('customer.index') }}" class="header-animate block hover:opacity-70 transition-opacity">
            <h1 class="text-xl font-black italic tracking-tighter uppercase leading-none text-[#080d1a]">The Bilabola Space</h1>
            <p class="text-[9px] font-bold text-blue-600 uppercase tracking-widest mt-1">Authentic Experience</p>
        </a>
        <div class="flex items-center space-x-3">
            @if(!(auth()->check() && in_array(auth()->user()->role, ['admin', 'superadmin'])))
            <div class="relative group">
                <button onclick="openCartSheet()" class="w-11 h-11 bg-white border border-gray-150 hover:bg-gray-50 text-[#080d1a] rounded-[1.2rem] flex items-center justify-center shadow-sm transform transition-all active:scale-90 relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    <div id="cart-count" class="absolute -top-1 -right-1 bg-blue-600 text-white text-[8px] font-black w-5 h-5 rounded-full flex items-center justify-center border-2 border-white shadow-md transition-all duration-300 scale-0 opacity-0">0</div>
                </button>
            </div>
            @endif
        </div>
    </header>

    <!-- Search Section -->
    <section class="px-6 mt-6 mb-8 flex items-center space-x-3">
        <form action="{{ route('customer.index') }}" method="GET" class="relative group flex-1">
            <input type="text" name="search" value="{{ request('search') }}" 
                class="w-full bg-white border-gray-100 border-2 rounded-[1.5rem] py-4 pl-14 pr-6 text-xs font-semibold placeholder-gray-400 focus:ring-4 focus:ring-blue-600/5 focus:border-blue-600 transition-all outline-none shadow-sm"
                placeholder="Find your crave...">
            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-blue-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </form>
        <button onclick="toggleDrawer()" class="w-14 h-14 bg-white border-2 border-gray-100 rounded-[1.5rem] flex items-center justify-center text-[#080d1a] shadow-sm hover:bg-gray-50 active:scale-95 transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </section>

    <!-- Categories Scroll -->
    <div class="flex space-x-3 overflow-x-auto px-6 mb-10 hide-scrollbar py-2">
        <a href="{{ route('customer.index', ['category' => 'all']) }}" 
            class="category-pill flex-shrink-0 px-7 py-3.5 rounded-2xl text-[11px] font-extrabold tracking-tight transition-all duration-500 {{ request('category', 'all') == 'all' ? 'active' : 'bg-white text-gray-400 border border-gray-100' }}">
            All Items
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('customer.index', ['category' => $cat->name]) }}" 
            class="category-pill flex-shrink-0 px-7 py-3.5 rounded-2xl text-[11px] font-extrabold tracking-tight transition-all duration-500 {{ request('category') == $cat->name ? 'active' : 'bg-white text-gray-400 border border-gray-100' }}">
            {{ $cat->name }}
        </a>
        @endforeach
    </div>

    <!-- Menu Grid -->
    <div class="px-6 grid grid-cols-2 gap-x-5 gap-y-10">
        @forelse($foods as $index => $item)
        <div class="menu-item-fade" style="animation-delay: {{ $index * 0.1 }}s">
            <div class="flex flex-col relative group">
                <a href="{{ $item->is_available ? route('customer.show', $item) : '#' }}" 
                    class="block {{ !$item->is_available ? 'opacity-60 grayscale pointer-events-none' : '' }}">
                    
                    <div class="relative w-full aspect-square rounded-[2.5rem] overflow-hidden mb-4 shadow-xl shadow-gray-200/50 border-4 border-white transition-transform duration-500 group-hover:scale-[1.03]">
                        <img src="{{ $item->image ? (str_starts_with($item->image, 'http') ? $item->image : asset('storage/'.$item->image)) : 'https://via.placeholder.com/300' }}" 
                            class="w-full h-full object-cover">
                        
                        @if(!$item->is_available)
                        <div class="absolute inset-0 bg-white/60 backdrop-blur-[2px] flex items-center justify-center">
                            <span class="bg-[#080d1a] text-white text-[7px] font-black uppercase tracking-[0.25em] px-3 py-1.5 rounded-full shadow-2xl">Out of Stock</span>
                        </div>
                        @endif

                        <div class="absolute bottom-3 left-3 bg-white/90 backdrop-blur px-2 py-1 rounded-xl flex items-center space-x-1 shadow-sm border border-white">
                            <svg class="w-2.5 h-2.5 text-yellow-500 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <span class="text-[9px] font-black text-gray-900 tracking-tighter">4.9</span>
                        </div>
                    </div>

                    <div class="px-2">
                        <div class="flex justify-between items-start mb-1">
                            <h3 class="text-[13px] font-extrabold text-gray-900 truncate leading-tight flex-1 pr-2 uppercase tracking-tight">{{ $item->name }}</h3>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-[11px] font-black text-blue-600 italic tracking-tighter">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </a>

                @if($item->is_available && !(auth()->check() && in_array(auth()->user()->role, ['admin', 'superadmin'])))
                <button onclick="quickAdd({{ json_encode($item) }})" class="absolute bottom-10 right-0 w-9 h-9 bg-[#080d1a] text-white rounded-[1.1rem] flex items-center justify-center shadow-xl shadow-blue-900/20 active:scale-90 transition-all border-2 border-white hover:bg-blue-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                </button>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-2 py-32 text-center">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                <svg class="w-8 h-8 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <p class="text-gray-300 font-bold text-sm tracking-tight">No match found.</p>
        </div>
        @endforelse
    </div>

    <!-- Quick Options Sheet -->
    <div id="option-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-md z-[100] hidden transition-opacity duration-500" onclick="closeOptions()"></div>
    <div id="option-sheet" class="fixed bottom-0 inset-x-0 bg-white rounded-t-[3.5rem] z-[101] bottom-sheet p-10 lg:max-w-md lg:mx-auto shadow-[0_-20px_50px_rgba(0,0,0,0.1)]">
        <div class="w-14 h-1.5 bg-gray-100 rounded-full mx-auto mb-10"></div>
        <div id="sheet-content"></div>
        <button id="confirm-btn" class="w-full bg-[#080d1a] text-white py-6 rounded-3xl text-xs font-black uppercase tracking-[0.3em] mt-10 active:scale-95 transition-all shadow-2xl shadow-blue-900/30">
            Confirm Order
        </button>
    </div>

    <!-- Checkout Modal -->
    <div id="checkout-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-md z-[200] hidden transition-opacity duration-500" onclick="closeCheckout()"></div>
    <div id="checkout-sheet" class="fixed bottom-0 inset-x-0 bg-white rounded-t-[3.5rem] z-[201] bottom-sheet p-10 lg:max-w-md lg:mx-auto shadow-[0_-20px_50px_rgba(0,0,0,0.1)]">
        <div class="w-14 h-1.5 bg-gray-100 rounded-full mx-auto mb-10"></div>
        <h2 class="text-3xl font-black text-gray-900 leading-none tracking-tighter mb-2">Checkout</h2>
        <p class="text-xs font-medium text-gray-400 mb-10">Lengkapi data untuk mengirim pesanan Anda.</p>
        
        <div class="space-y-6">
            <div>
                <label class="block text-[9px] font-black uppercase text-gray-400 tracking-widest mb-3">Nama Anda</label>
                <input type="text" id="cust-name" class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-2xl p-5 text-sm font-bold outline-none transition-all" placeholder="Contoh: Budi Santoso">
            </div>
            <div>
                <label class="block text-[9px] font-black uppercase text-gray-400 tracking-widest mb-3">Nomor Meja</label>
                <input type="number" id="cust-table" class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-2xl p-5 text-sm font-bold outline-none transition-all" placeholder="01">
            </div>
        </div>

        <button id="send-order-btn" onclick="sendOrder()" class="w-full bg-blue-600 text-white py-6 rounded-3xl text-xs font-black uppercase tracking-[0.3em] mt-10 active:scale-95 transition-all shadow-2xl shadow-blue-900/30">
            Kirim Pesanan
        </button>
    </div>

    <!-- Floating Checkout Card -->
    @if(!(auth()->check() && in_array(auth()->user()->role, ['admin', 'superadmin'])))
    <div id="floating-cart-card" class="fixed bottom-10 left-1/2 -translate-x-1/2 w-[calc(100%-4rem)] max-w-sm z-[60] transition-all duration-500 ease-out translate-y-40 opacity-0 pointer-events-none">
        <button onclick="openCartSheet()" class="w-full bg-[#080d1a] hover:bg-black text-white p-3 rounded-[2.5rem] shadow-[0_20px_50px_-10px_rgba(8,13,26,0.5)] flex items-center transition-all active:scale-95 border-2 border-white/5">
            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center mr-4 shadow-inner">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            </div>
            <div class="flex-1 text-left">
                <p class="text-[8px] font-black uppercase tracking-[0.2em] text-white/40">Total Checkout</p>
                <p class="text-[11px] font-extrabold tracking-tight" id="cart-summary-text">0 items selected</p>
            </div>
            <div class="bg-white/10 px-6 py-3 rounded-2xl text-xs font-black italic mr-1 border border-white/10">
                <span id="cart-total-price">Rp 0</span>
            </div>
        </button>
    </div>
    @endif

    <!-- Cart Details Sheet -->
    <div id="cart-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-md z-[200] hidden transition-opacity duration-500" onclick="closeCartSheet()"></div>
    <div id="cart-sheet" class="fixed bottom-0 inset-x-0 bg-white rounded-t-[3.5rem] z-[201] bottom-sheet p-10 lg:max-w-md lg:mx-auto max-h-[80vh] flex flex-col shadow-[0_-20px_50px_rgba(0,0,0,0.1)]">
        <div class="w-14 h-1.5 bg-gray-100 rounded-full mx-auto mb-8 shrink-0"></div>
        <div class="flex justify-between items-start mb-2 shrink-0">
            <h2 class="text-3xl font-black text-gray-900 leading-none tracking-tighter">Keranjang Belanja</h2>
            <button onclick="closeCartSheet()" class="text-gray-400 hover:text-gray-900 transition-colors text-xs font-bold uppercase tracking-wider mt-1">Tutup</button>
        </div>
        <p class="text-xs font-medium text-gray-400 mb-6 shrink-0">Kelola pesanan Anda sebelum melanjutkan.</p>

        <!-- Cart Items List (Scrollable) -->
        <div id="cart-items-list" class="flex-1 overflow-y-auto space-y-4 pr-1 mb-6 hide-scrollbar">
            <!-- Dynamically populated -->
        </div>

        <!-- Footer -->
        <div class="border-t border-gray-100 pt-6 shrink-0">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest block leading-none mb-1">Total Tagihan</span>
                    <span id="cart-sheet-total" class="text-xl font-black text-blue-600 italic">Rp 0</span>
                </div>
                <button onclick="proceedToCheckout()" class="bg-[#080d1a] hover:bg-black text-white px-8 py-5 rounded-[2rem] text-xs font-black uppercase tracking-[0.2em] shadow-xl shadow-blue-900/10 active:scale-95 transition-all">
                    Checkout →
                </button>
            </div>
        </div>
    </div>

    <!-- Custom Premium Toast/Alert Modal -->
    <div id="custom-alert-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[999] hidden items-center justify-center p-6 transition-all duration-300" onclick="closeCustomAlert()">
        <div class="bg-white rounded-[2.5rem] w-full max-w-sm p-8 text-center shadow-2xl relative overflow-hidden transform scale-95 opacity-0 transition-all duration-300" id="custom-alert-box" onclick="event.stopPropagation()">
            <!-- Animated Warning Icon -->
            <div class="w-16 h-16 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-6 border border-amber-100 shadow-inner">
                <svg class="w-8 h-8 animate-bounce text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h2 class="text-lg font-black text-gray-900 leading-tight mb-3">Informasi</h2>
            <p class="text-xs text-gray-400 font-bold leading-relaxed px-4 mb-8" id="custom-alert-message">
                Pesan Peringatan
            </p>
            <button class="w-full bg-[#080d1a] hover:bg-black text-white py-4.5 rounded-2xl text-xs font-black uppercase tracking-[0.2em] active:scale-95 transition-all shadow-lg">
                Mengerti
            </button>
        </div>
    </div>

    <!-- Left Sidebar Drawer -->
    <div id="drawer-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-md z-[250] hidden transition-opacity duration-500" onclick="toggleDrawer()"></div>
    <div id="drawer-panel" class="fixed inset-y-0 left-0 w-80 bg-white z-[251] shadow-2xl p-8 flex flex-col justify-between transform -translate-x-full transition-transform duration-500 ease-out rounded-r-[2.5rem]">
        <div>
            <!-- Header close -->
            <div class="flex justify-between items-center mb-10">
                <h3 class="text-xs font-black uppercase text-gray-400 tracking-[0.2em]">The Bilabola Space Menu</h3>
                <button onclick="toggleDrawer()" class="p-2 text-gray-400 hover:text-gray-900 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Profile Info -->
            <div class="bg-gray-50 rounded-3xl p-6 mb-8 border border-gray-100 flex items-center space-x-4">
                <div class="w-12 h-12 {{ auth()->check() && in_array(auth()->user()->role, ['admin', 'superadmin']) ? 'bg-red-600' : 'bg-blue-600' }} rounded-2xl flex items-center justify-center text-white text-lg font-black shadow-lg">
                    @if(auth()->check())
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @else
                        G
                    @endif
                </div>
                <div class="flex-1 overflow-hidden">
                    @if(auth()->check())
                        @if(in_array(auth()->user()->role, ['admin', 'superadmin']))
                            <p class="text-[9px] font-black uppercase text-red-600 tracking-widest leading-none mb-1">Admin Account</p>
                        @else
                            <p class="text-[9px] font-black uppercase text-blue-600 tracking-widest leading-none mb-1">Customer Account</p>
                        @endif
                        <h2 class="text-sm font-black text-gray-900 truncate leading-snug">{{ auth()->user()->name }}</h2>
                    @else
                        <p class="text-[9px] font-black uppercase text-gray-400 tracking-widest leading-none mb-1">Status Anda</p>
                        <h2 class="text-sm font-black text-[#080d1a] leading-snug">Login as Guest</h2>
                    @endif
                </div>
            </div>

            <!-- Action Links -->
            <div class="space-y-3">
                <button onclick="openHistory()" class="w-full flex items-center space-x-4 p-4 rounded-2xl hover:bg-gray-50 transition-colors text-left group">
                    <span class="text-lg">📜</span>
                    <span class="text-xs font-bold text-gray-700 group-hover:text-gray-950 transition-colors">Order History (Riwayat)</span>
                </button>

                @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'superadmin']))
                    <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center space-x-4 p-4 rounded-2xl hover:bg-red-50 transition-colors text-left group">
                        <span class="text-lg">⚙️</span>
                        <span class="text-xs font-extrabold text-red-600 group-hover:text-red-700 transition-colors">Back to Admin Dashboard</span>
                    </a>
                @endif

                @if(!auth()->check())
                    <a href="{{ route('customer.login') }}" class="w-full flex items-center space-x-4 p-4 rounded-2xl hover:bg-blue-50/50 hover:text-blue-600 transition-colors text-left group text-blue-600">
                        <span class="text-lg">🔑</span>
                        <span class="text-xs font-black uppercase tracking-wider text-blue-600">Sign In / Register</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- Logout Form -->
        <div>
            @if(auth()->check() || session()->has('customer_guest'))
                <form action="{{ route('customer.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-red-50 text-red-500 hover:bg-red-100 py-5 rounded-2xl text-sm font-black uppercase tracking-[0.2em] transition-colors active:scale-95 flex items-center justify-center space-x-2">
                        <span>🚪</span>
                        <span>Logout / Keluar</span>
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Order History Sheet -->
    <div id="history-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-md z-[300] hidden transition-opacity duration-500" onclick="closeHistory()"></div>
    <div id="history-sheet" class="fixed bottom-0 inset-x-0 bg-white rounded-t-[3.5rem] z-[301] bottom-sheet p-10 lg:max-w-md lg:mx-auto max-h-[80vh] overflow-y-auto shadow-[0_-20px_50px_rgba(0,0,0,0.1)]">
        <div class="w-14 h-1.5 bg-gray-100 rounded-full mx-auto mb-8"></div>
        <div class="flex justify-between items-start mb-2">
            <h2 class="text-3xl font-black text-gray-900 leading-none tracking-tighter">Riwayat Pesanan</h2>
            <button onclick="closeHistory()" class="text-gray-400 hover:text-gray-900 transition-colors text-xs font-bold uppercase tracking-wider mt-1">Tutup</button>
        </div>
        <p class="text-xs font-medium text-gray-400 mb-8">Daftar pesanan Anda di restoran The Bilabola Space.</p>

        <div id="history-content" class="space-y-6">
            <!-- Dynamically populated -->
        </div>
    </div>

    <script>
        let currentItem = null;
        let currentOptions = {};
        let optionPrices = {};

        function quickAdd(item) {
            currentItem = item;
            const hasOptions = item.options && item.options.length > 0;
            
            if(!hasOptions) {
                addToCart(item, {}, 0);
                return;
            }

            let html = `<div class="mb-6">
                            <span class="text-[9px] font-black text-blue-600 uppercase tracking-widest bg-blue-50 px-3 py-1.5 rounded-full mb-3 inline-block">${item.category?.name || 'Menu'}</span>
                            <h2 class="text-2xl font-black text-gray-900 leading-none tracking-tighter">${item.name}</h2>
                            <p class="text-[10px] font-bold text-gray-400 mt-2 uppercase tracking-wide">Harga Dasar: Rp ${item.price.toLocaleString('id-ID')}</p>
                        </div>`;

            // Reset current options and prices
            currentOptions = {};
            optionPrices = {};
            
            // 1. LOCAL FOOD OPTIONS (Level Pedas & Extra Topping)
            if(item.options.includes('local_food')) {
                // Spicy level
                html += `<div class="mb-6">
                            <h3 class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-3">Level Pedas</h3>
                            <div class="flex gap-2 pb-1 overflow-x-auto hide-scrollbar">`;
                const levels = [
                    { val: 'Lvl 0 (Tidak Pedas)', label: '0', price: 0 },
                    { val: 'Lvl 1 (Sedikit Pedas)', label: '1', price: 0 },
                    { val: 'Lvl 2 (Sedang)', label: '2', price: 0 },
                    { val: 'Lvl 3 (Pedas)', label: '3', price: 2000 },
                    { val: 'Lvl 4 (Sangat Pedas)', label: '4', price: 2000 },
                    { val: 'Lvl 5 (Gila)', label: '5', price: 4000 }
                ];
                levels.forEach(l => {
                    let priceTag = l.price > 0 ? ` (+Rp ${l.price/1000}k)` : '';
                    html += `<button onclick="setOption('pedas', '${l.val}', ${l.price})" class="pedas-opt flex-shrink-0 px-4 py-3 bg-gray-50 border-2 border-transparent rounded-2xl text-xs font-black transition-all active:scale-90" data-val="${l.val}">${l.label}${priceTag}</button>`;
                });
                html += `</div></div>`;

                // Extra toppings
                html += `<div class="mb-6">
                            <h3 class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-3">Tambahan / Extra Topping</h3>
                            <div class="grid grid-cols-2 gap-2">`;
                const toppings = [
                    { val: 'Tanpa Tambahan', label: 'Original', price: 0 },
                    { val: 'Ekstra Telur Ceplok', label: '+ Telur (+5k)', price: 5000 },
                    { val: 'Ekstra Keju Cheddar', label: '+ Keju (+5k)', price: 5000 },
                    { val: 'Porsi Jumbo', label: 'Porsi Jumbo (+8k)', price: 8000 }
                ];
                toppings.forEach(t => {
                    html += `<button onclick="setOption('topping', '${t.val}', ${t.price})" class="topping-opt py-4 bg-gray-50 border-2 border-transparent rounded-2xl text-[10px] font-black uppercase transition-all" data-val="${t.val}">${t.label}</button>`;
                });
                html += `</div></div>`;
            }
            
            // 2. DRINK OPTIONS (Hot/Ice, Size, Add-on)
            if(item.options.includes('drink')) {
                // Hot / Iced
                html += `<div class="mb-6">
                            <h3 class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-3">Sajian</h3>
                            <div class="grid grid-cols-2 gap-2">`;
                const servings = [
                    { val: 'Dingin (Iced)', label: 'Iced', price: 0 },
                    { val: 'Panas (Hot)', label: 'Hot', price: 0 }
                ];
                servings.forEach(s => {
                    html += `<button onclick="setOption('sajian', '${s.val}', ${s.price})" class="sajian-opt py-4.5 bg-gray-50 border-2 border-transparent rounded-2xl text-[10px] font-black uppercase transition-all" data-val="${s.val}">${s.label}</button>`;
                });
                html += `</div></div>`;

                // Size
                html += `<div class="mb-6">
                            <h3 class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-3">Ukuran Cup</h3>
                            <div class="grid grid-cols-3 gap-2">`;
                const sizes = [
                    { val: 'Medium Cup', label: 'Medium', price: 0 },
                    { val: 'Large Cup', label: 'Large (+5k)', price: 5000 },
                    { val: 'XL Cup', label: 'X-Large (+8k)', price: 8000 }
                ];
                sizes.forEach(sz => {
                    html += `<button onclick="setOption('size', '${sz.val}', ${sz.price})" class="size-opt py-4 bg-gray-50 border-2 border-transparent rounded-2xl text-[10px] font-black uppercase transition-all" data-val="${sz.val}">${sz.label}</button>`;
                });
                html += `</div></div>`;

                // Extra shot / Syrup
                html += `<div class="mb-6">
                            <h3 class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-3">Tambahan / Add-on</h3>
                            <div class="grid grid-cols-2 gap-2">`;
                const addons = [
                    { val: 'Original', label: 'Original', price: 0 },
                    { val: 'Ekstra Shot Espresso', label: '+ Espresso (+7k)', price: 7000 },
                    { val: 'Saus Karamel', label: '+ Karamel (+4k)', price: 4000 },
                    { val: 'Whipped Cream', label: '+ Whipped Cream (+3k)', price: 3000 }
                ];
                addons.forEach(a => {
                    html += `<button onclick="setOption('addon', '${a.val}', ${a.price})" class="addon-opt py-4.5 bg-gray-50 border-2 border-transparent rounded-2xl text-[10px] font-black uppercase transition-all" data-val="${a.val}">${a.label}</button>`;
                });
                html += `</div></div>`;
            }

            // 3. ICE CREAM OPTIONS (Vessel, Size, Topping)
            if(item.options.includes('icecream')) {
                // Vessel
                html += `<div class="mb-6">
                            <h3 class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-3">Sajian Wadah</h3>
                            <div class="grid grid-cols-2 gap-2">`;
                const vessels = [
                    { val: 'Dalam Cup', label: 'Cup', price: 0 },
                    { val: 'Waffle Cone', label: 'Waffle Cone (+4k)', price: 4000 }
                ];
                vessels.forEach(v => {
                    html += `<button onclick="setOption('wadah', '${v.val}', ${v.price})" class="wadah-opt py-4.5 bg-gray-50 border-2 border-transparent rounded-2xl text-[10px] font-black uppercase transition-all" data-val="${v.val}">${v.label}</button>`;
                });
                html += `</div></div>`;

                // Size
                html += `<div class="mb-6">
                            <h3 class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-3">Ukuran Porsi</h3>
                            <div class="grid grid-cols-2 gap-2">`;
                const iceSizes = [
                    { val: 'Single Scoop', label: 'Single Scoop', price: 0 },
                    { val: 'Double Scoop', label: 'Double Scoop (+8k)', price: 8000 }
                ];
                iceSizes.forEach(sz => {
                    html += `<button onclick="setOption('size', '${sz.val}', ${sz.price})" class="size-opt py-4.5 bg-gray-50 border-2 border-transparent rounded-2xl text-[10px] font-black uppercase transition-all" data-val="${sz.val}">${sz.label}</button>`;
                });
                html += `</div></div>`;

                // Ice Cream Topping
                html += `<div class="mb-6">
                            <h3 class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-3">Topping Es Krim</h3>
                            <div class="grid grid-cols-3 gap-2">`;
                const iceToppings = [
                    { val: 'Original', label: 'Original', price: 0 },
                    { val: 'Saus Cokelat', label: 'Saus Cokelat (+3k)', price: 3000 },
                    { val: 'Oreo Crumbs', label: 'Oreo (+3k)', price: 3000 }
                ];
                iceToppings.forEach(t => {
                    html += `<button onclick="setOption('topping', '${t.val}', ${t.price})" class="topping-opt py-4 bg-gray-50 border-2 border-transparent rounded-2xl text-[10px] font-black uppercase transition-all" data-val="${t.val}">${t.label}</button>`;
                });
                html += `</div></div>`;
            }

            document.getElementById('sheet-content').innerHTML = html;
            document.getElementById('option-overlay').classList.remove('hidden');
            setTimeout(() => document.getElementById('option-sheet').classList.add('active'), 10);
            
            // Set default selections
            if(item.options.includes('local_food')) {
                setOption('pedas', 'Lvl 0 (Tidak Pedas)', 0);
                setOption('topping', 'Tanpa Tambahan', 0);
            }
            if(item.options.includes('drink')) {
                setOption('sajian', 'Dingin (Iced)', 0);
                setOption('size', 'Medium Cup', 0);
                setOption('addon', 'Original', 0);
            }
            if(item.options.includes('icecream')) {
                setOption('wadah', 'Dalam Cup', 0);
                setOption('size', 'Single Scoop', 0);
                setOption('topping', 'Original', 0);
            }

            validateSelection();
        }

        function setOption(type, val, price) {
            currentOptions[type] = val;
            optionPrices[type] = price;
            
            document.querySelectorAll('.' + type + '-opt').forEach(btn => {
                if(btn.getAttribute('data-val') == val) {
                    btn.classList.add('bg-[#080d1a]', 'text-white', 'border-[#080d1a]', 'shadow-lg');
                } else {
                    btn.classList.remove('bg-[#080d1a]', 'text-white', 'border-[#080d1a]', 'shadow-lg');
                }
            });
            
            // Update live price display
            const addedPrice = Object.values(optionPrices).reduce((sum, p) => sum + p, 0);
            const liveTotal = currentItem.price + addedPrice;
            document.getElementById('confirm-btn').innerText = `Confirm Order - Rp ${liveTotal.toLocaleString('id-ID')}`;

            validateSelection();
        }

        function validateSelection() {
            let valid = true;
            if(currentItem.options.includes('local_food')) {
                if(currentOptions.pedas === undefined || currentOptions.topping === undefined) valid = false;
            }
            if(currentItem.options.includes('drink')) {
                if(currentOptions.sajian === undefined || currentOptions.size === undefined || currentOptions.addon === undefined) valid = false;
            }
            if(currentItem.options.includes('icecream')) {
                if(currentOptions.wadah === undefined || currentOptions.size === undefined || currentOptions.topping === undefined) valid = false;
            }
            
            const btn = document.getElementById('confirm-btn');
            btn.disabled = !valid;
            btn.style.opacity = valid ? '1' : '0.2';
        }

        document.getElementById('confirm-btn').onclick = function() {
            const addedPrice = Object.values(optionPrices).reduce((sum, p) => sum + p, 0);
            addToCart(currentItem, currentOptions, addedPrice);
            closeOptions();
        };

        function closeOptions() {
            document.getElementById('option-sheet').classList.remove('active');
            setTimeout(() => document.getElementById('option-overlay').classList.add('hidden'), 500);
        }

        function addToCart(item, options, addedPrice = 0) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const finalPrice = item.price + addedPrice;
            
            cart.push({
                id: item.id,
                name: item.name,
                price: finalPrice,
                quantity: 1,
                options: options,
                timestamp: Date.now()
            });
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartUI();
        }

        function openCheckout() {
            proceedToCheckout();
        }

        function closeCheckout() {
            document.getElementById('checkout-sheet').classList.remove('active');
            setTimeout(() => document.getElementById('checkout-overlay').classList.add('hidden'), 500);
        }

        async function sendOrder() {
            const name = document.getElementById('cust-name').value;
            const table = document.getElementById('cust-table').value;
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

            if (!name || !table) {
                showCustomAlert('Harap isi nama dan nomor meja!');
                return;
            }

            const btn = document.getElementById('send-order-btn');
            btn.disabled = true;
            btn.innerText = 'Mengirim...';

            try {
                const response = await fetch('{{ route("customer.checkout") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        nama_pelanggan: name,
                        meja: table,
                        cart: cart,
                        total: total
                    })
                });

                const result = await response.json();

                if (result.success) {
                    // Save checkout to local history
                    let localHistory = JSON.parse(localStorage.getItem('order_history') || '[]');
                    localHistory.push({
                        id: result.order_id,
                        nama_pelanggan: name,
                        meja: table,
                        total: total,
                        items: cart,
                        status: 'pending',
                        timestamp: Date.now()
                    });
                    localStorage.setItem('order_history', JSON.stringify(localHistory));

                    localStorage.removeItem('cart');
                    showCustomAlert(result.message, () => {
                        window.location.reload();
                    });
                } else {
                    showCustomAlert(result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                showCustomAlert('Gagal mengirim pesanan. Periksa koneksi Anda.');
            } finally {
                btn.disabled = false;
                btn.innerText = 'Kirim Pesanan';
            }
        }

        function toggleDrawer() {
            const panel = document.getElementById('drawer-panel');
            const overlay = document.getElementById('drawer-overlay');
            if (panel.classList.contains('active')) {
                panel.classList.remove('active');
                setTimeout(() => overlay.classList.add('hidden'), 500);
            } else {
                overlay.classList.remove('hidden');
                setTimeout(() => panel.classList.add('active'), 10);
            }
        }

        async function openHistory() {
            toggleDrawer(); // Close sidebar first

            const overlay = document.getElementById('history-overlay');
            const sheet = document.getElementById('history-sheet');
            const content = document.getElementById('history-content');

            overlay.classList.remove('hidden');
            setTimeout(() => sheet.classList.add('active'), 10);

            content.innerHTML = `<div class="py-12 text-center"><div class="animate-spin inline-block text-2xl">⏳</div><p class="text-[10px] text-gray-400 mt-2 font-bold uppercase tracking-widest">Memuat riwayat...</p></div>`;

            let orders = [];
            
            // Get local storage orders
            let localHistory = JSON.parse(localStorage.getItem('order_history') || '[]');
            localHistory.reverse(); // Newest first

            @if(auth()->check())
                try {
                    const response = await fetch('{{ route("customer.history") }}');
                    const dbOrders = await response.json();
                    orders = dbOrders;
                } catch (e) {
                    console.error('Error fetching db history:', e);
                    orders = localHistory;
                }
            @else
                orders = localHistory;
            @endif

            if (orders.length === 0) {
                content.innerHTML = `
                    <div class="py-16 text-center">
                        <span class="text-4xl block mb-4">📜</span>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Belum ada riwayat pesanan</p>
                        <p class="text-[9px] text-gray-400 mt-1.5 px-6 leading-relaxed">Pesanan Anda akan muncul di sini setelah Anda melakukan checkout.</p>
                    </div>`;
                return;
            }

            let html = '';
            orders.forEach(order => {
                const date = order.created_at ? new Date(order.created_at) : new Date(order.timestamp);
                const dateStr = date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) + ' - ' + date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' });
                
                let statusBadge = '';
                if (order.status === 'pending') {
                    statusBadge = '<span class="px-3 py-1 text-[8px] font-black uppercase tracking-widest rounded-full bg-orange-50 text-orange-500 border border-orange-100">Pending</span>';
                } else if (order.status === 'success') {
                    statusBadge = '<span class="px-3 py-1 text-[8px] font-black uppercase tracking-widest rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100">Diterima</span>';
                } else {
                    statusBadge = '<span class="px-3 py-1 text-[8px] font-black uppercase tracking-widest rounded-full bg-red-50 text-red-500 border border-red-100">Dibatalkan</span>';
                }

                let itemsHtml = '';
                if (Array.isArray(order.menu_pesanan)) {
                    order.menu_pesanan.forEach(item => {
                        let optsText = '';
                        if (item.options && Object.keys(item.options).length > 0) {
                            optsText = '<div class="flex flex-wrap gap-1 mt-1 pl-4">';
                            Object.entries(item.options).forEach(([k, v]) => {
                                optsText += `<span class="bg-white border border-gray-150 text-[7px] text-gray-500 font-bold uppercase px-1.5 py-0.5 rounded">${k}: ${v}</span>`;
                            });
                            optsText += '</div>';
                        }
                        itemsHtml += `<div class="text-[11px] font-bold text-gray-700 mt-1.5">⚡ ${item.quantity}x ${item.name}${optsText}</div>`;
                    });
                } else if (order.items && Array.isArray(order.items)) {
                    order.items.forEach(item => {
                        let optsText = '';
                        if (item.options && Object.keys(item.options).length > 0) {
                            optsText = '<div class="flex flex-wrap gap-1 mt-1 pl-4">';
                            Object.entries(item.options).forEach(([k, v]) => {
                                optsText += `<span class="bg-white border border-gray-150 text-[7px] text-gray-500 font-bold uppercase px-1.5 py-0.5 rounded">${k}: ${v}</span>`;
                            });
                            optsText += '</div>';
                        }
                        itemsHtml += `<div class="text-[11px] font-bold text-gray-700 mt-1.5">⚡ ${item.quantity}x ${item.name}${optsText}</div>`;
                    });
                } else {
                    itemsHtml += `<div class="text-[11px] font-bold text-gray-700 mt-1">${order.menu_pesanan || 'Detail menu tidak tersedia'}</div>`;
                }

                html += `
                    <div class="bg-gray-50 border border-gray-100 rounded-3xl p-5 relative overflow-hidden transition-all hover:bg-white hover:border-gray-200">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest block leading-none mb-1">No. Meja</span>
                                <span class="text-xs font-black text-gray-900">Meja ${order.meja}</span>
                            </div>
                            <div>
                                ${statusBadge}
                            </div>
                        </div>
                        <div class="border-t border-dashed border-gray-200/60 my-2"></div>
                        <div class="mb-4">
                            <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest block leading-none mb-1">Menu Pesanan</span>
                            ${itemsHtml}
                        </div>
                        <div class="flex justify-between items-end mt-2">
                            <div>
                                <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest block">${dateStr} WIB</span>
                            </div>
                            <div>
                                <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest block text-right leading-none mb-1">Total Bayar</span>
                                <span class="text-xs font-black text-blue-600 italic">Rp ${(order.jumlah || order.total).toLocaleString('id-ID')}</span>
                            </div>
                        </div>
                    </div>
                `;
            });
            content.innerHTML = html;
        }

        function closeHistory() {
            document.getElementById('history-sheet').classList.remove('active');
            setTimeout(() => document.getElementById('history-overlay').classList.add('hidden'), 500);
        }

        // Custom animated premium alert modal functions
        function showCustomAlert(message, callback = null) {
            const overlay = document.getElementById('custom-alert-overlay');
            const box = document.getElementById('custom-alert-box');
            const msgEl = document.getElementById('custom-alert-message');
            
            msgEl.innerText = message;
            
            overlay.classList.remove('hidden');
            overlay.classList.add('flex');
            
            // Set OK button action
            const btn = overlay.querySelector('button');
            btn.onclick = function() {
                closeCustomAlert();
                if (callback) {
                    setTimeout(callback, 200);
                }
            };
            
            // Trigger animation
            setTimeout(() => {
                box.classList.remove('scale-95', 'opacity-0');
                box.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeCustomAlert() {
            const overlay = document.getElementById('custom-alert-overlay');
            const box = document.getElementById('custom-alert-box');
            
            box.classList.remove('scale-100', 'opacity-100');
            box.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                overlay.classList.add('hidden');
                overlay.classList.remove('flex');
            }, 150);
        }

        // Cart details drawer functions
        function openCartSheet() {
            renderCartItems();
            document.getElementById('cart-overlay').classList.remove('hidden');
            setTimeout(() => document.getElementById('cart-sheet').classList.add('active'), 10);
        }

        function closeCartSheet() {
            document.getElementById('cart-sheet').classList.remove('active');
            setTimeout(() => document.getElementById('cart-overlay').classList.add('hidden'), 500);
        }

        function renderCartItems() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const listEl = document.getElementById('cart-items-list');
            const totalEl = document.getElementById('cart-sheet-total');
            
            if (cart.length === 0) {
                listEl.innerHTML = `
                    <div class="py-16 text-center">
                        <span class="text-4xl block mb-4">🛒</span>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Keranjang Kosong</p>
                        <p class="text-[9px] text-gray-400 mt-1.5 px-6 leading-relaxed">Silakan pilih makanan lezat kami terlebih dahulu.</p>
                    </div>
                `;
                totalEl.innerText = 'Rp 0';
                return;
            }
            
            let html = '';
            let total = 0;
            
            cart.forEach((item, index) => {
                let optsHtml = '';
                if (item.options && Object.keys(item.options).length > 0) {
                    optsHtml = '<div class="flex flex-wrap gap-1 mt-1.5">';
                    Object.entries(item.options).forEach(([k, v]) => {
                        optsHtml += `<span class="bg-white border border-gray-150 text-[7px] text-gray-500 font-bold uppercase px-1.5 py-0.5 rounded">${k}: ${v}</span>`;
                    });
                    optsHtml += '</div>';
                }
                
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                
                html += `
                    <div class="flex items-center justify-between bg-gray-50 border border-gray-100 rounded-3xl p-4 transition-all hover:bg-white hover:border-gray-200">
                        <div class="flex-1 pr-4 overflow-hidden text-left">
                            <h4 class="text-xs font-black text-gray-900 leading-tight uppercase truncate">${item.name}</h4>
                            <p class="text-[10px] font-black text-blue-600 italic mt-0.5">Rp ${(item.price).toLocaleString('id-ID')}</p>
                            ${optsHtml}
                        </div>
                        <div class="flex items-center space-x-2 shrink-0">
                            <div class="flex items-center bg-white border border-gray-150 rounded-2xl p-1 shadow-sm">
                                <button onclick="adjustCartQty(${index}, -1)" class="w-7 h-7 flex items-center justify-center text-gray-500 hover:text-gray-900 rounded-xl active:bg-gray-50 transition-colors font-bold text-xs">-</button>
                                <span class="text-xs font-black text-gray-900 px-2">${item.quantity}</span>
                                <button onclick="adjustCartQty(${index}, 1)" class="w-7 h-7 flex items-center justify-center text-gray-500 hover:text-gray-900 rounded-xl active:bg-gray-50 transition-colors font-bold text-xs">+</button>
                            </div>
                            <button onclick="removeCartItem(${index})" class="w-8 h-8 bg-red-50 hover:bg-red-100 text-red-500 rounded-2xl flex items-center justify-center active:scale-90 transition-all border border-red-100/50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                `;
            });
            
            listEl.innerHTML = html;
            totalEl.innerText = 'Rp ' + total.toLocaleString('id-ID');
        }

        function adjustCartQty(index, change) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (index >= 0 && index < cart.length) {
                cart[index].quantity += change;
                if (cart[index].quantity <= 0) {
                    cart.splice(index, 1);
                }
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartUI();
                renderCartItems();
            }
        }

        function removeCartItem(index) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (index >= 0 && index < cart.length) {
                cart.splice(index, 1);
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartUI();
                renderCartItems();
            }
        }

        function proceedToCheckout() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (cart.length === 0) {
                showCustomAlert('Keranjang Anda masih kosong!');
                return;
            }
            window.location.href = "{{ route('customer.checkout.view') }}";
        }

        function updateCartUI() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const count = cart.reduce((sum, item) => sum + item.quantity, 0);
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            
            const badge = document.getElementById('cart-count');
            badge.innerText = count;
            if (count > 0) {
                badge.classList.remove('scale-0', 'opacity-0');
                badge.classList.add('scale-100', 'opacity-100');
            } else {
                badge.classList.remove('scale-100', 'opacity-100');
                badge.classList.add('scale-0', 'opacity-0');
            }

            document.getElementById('cart-summary-text').innerText = count + ' items selected';
            document.getElementById('cart-total-price').innerText = 'Rp ' + total.toLocaleString('id-ID');

            const floatingCard = document.getElementById('floating-cart-card');
            if (count > 0) {
                floatingCard.classList.remove('translate-y-40', 'opacity-0', 'pointer-events-none');
                floatingCard.classList.add('translate-y-0', 'opacity-100');
            } else {
                floatingCard.classList.add('translate-y-40', 'opacity-0', 'pointer-events-none');
                floatingCard.classList.remove('translate-y-0', 'opacity-100');
            }
        }
        updateCartUI();
    </script>
</body>
</html>
