<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>DullStore | Premium Menu</title>
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
        <a href="{{ route('login') }}" class="header-animate block hover:opacity-70 transition-opacity">
            <h1 class="text-xl font-black italic tracking-tighter uppercase leading-none text-[#080d1a]">DullStore</h1>
            <p class="text-[9px] font-bold text-blue-600 uppercase tracking-widest mt-1">Authentic Experience</p>
        </a>
        <div class="flex items-center space-x-3">
            <div class="relative group">
                <button class="w-11 h-11 bg-[#080d1a] rounded-[1.2rem] flex items-center justify-center text-white shadow-2xl shadow-blue-900/40 transform transition-transform group-active:scale-90">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    <div id="cart-count" class="absolute -top-1.5 -right-1.5 bg-blue-500 text-[8px] font-black w-4.5 h-4.5 rounded-full flex items-center justify-center border-2 border-white shadow-sm">0</div>
                </button>
            </div>
        </div>
    </header>

    <!-- Search Section -->
    <section class="px-6 mt-6 mb-8">
        <form action="{{ route('customer.index') }}" method="GET" class="relative group">
            <input type="text" name="search" value="{{ request('search') }}" 
                class="w-full bg-white border-gray-100 border-2 rounded-[1.5rem] py-4 pl-14 pr-6 text-xs font-semibold placeholder-gray-400 focus:ring-4 focus:ring-blue-600/5 focus:border-blue-600 transition-all outline-none shadow-sm"
                placeholder="Find your crave...">
            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-blue-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
        </form>
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
                        <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://via.placeholder.com/300' }}" 
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

                @if($item->is_available)
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

    <!-- Floating Checkout Card -->
    <div class="fixed bottom-10 left-1/2 -translate-x-1/2 w-[calc(100%-4rem)] max-w-sm z-[60]">
        <button class="w-full bg-[#080d1a] hover:bg-black text-white p-3 rounded-[2.5rem] shadow-[0_20px_50px_-10px_rgba(8,13,26,0.5)] flex items-center transition-all active:scale-95 border-2 border-white/5">
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

    <script>
        let currentItem = null;
        let currentOptions = {};

        function quickAdd(item) {
            currentItem = item;
            const hasOptions = item.options && item.options.length > 0;
            
            if(!hasOptions) {
                addToCart(item, {});
                return;
            }

            let html = `<div class="mb-8">
                            <span class="text-[9px] font-black text-blue-600 uppercase tracking-widest bg-blue-50 px-3 py-1 rounded-full mb-3 inline-block">${item.category?.name || 'Menu'}</span>
                            <h2 class="text-3xl font-black text-gray-900 leading-none tracking-tighter">${item.name}</h2>
                        </div>`;
            
            if(item.options.includes('spicy')) {
                html += `<div class="mb-8"><h3 class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-4">Select Level</h3>
                         <div class="flex gap-2.5 overflow-x-auto hide-scrollbar pb-2">`;
                for(let i=0; i<=5; i++) {
                    html += `<button onclick="setOption('spicy', ${i})" class="spicy-opt flex-shrink-0 w-12 h-12 bg-gray-50 border-2 border-transparent rounded-2xl text-sm font-black transition-all active:scale-90" data-val="${i}">${i}</button>`;
                }
                html += `</div></div>`;
            }
            
            if(item.options.includes('drink')) {
                html += `<div class="mb-8"><h3 class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-4">Ice & Size</h3>
                         <div class="grid grid-cols-3 gap-2 mb-3">
                            <button onclick="setOption('ice', 'Normal')" class="ice-opt py-4 bg-gray-50 border-2 border-transparent rounded-2xl text-[10px] font-black uppercase transition-all" data-val="Normal">Normal</button>
                            <button onclick="setOption('ice', 'Extra')" class="ice-opt py-4 bg-gray-50 border-2 border-transparent rounded-2xl text-[10px] font-black uppercase transition-all" data-val="Extra">Extra</button>
                            <button onclick="setOption('ice', 'None')" class="ice-opt py-4 bg-gray-50 border-2 border-transparent rounded-2xl text-[10px] font-black uppercase transition-all" data-val="None">No Ice</button>
                         </div>
                         <div class="grid grid-cols-2 gap-2">
                            <button onclick="setOption('size', 'Small')" class="size-opt py-4 bg-gray-50 border-2 border-transparent rounded-2xl text-[10px] font-black uppercase transition-all" data-val="Small">Small</button>
                            <button onclick="setOption('size', 'Large')" class="size-opt py-4 bg-gray-50 border-2 border-transparent rounded-2xl text-[10px] font-black uppercase transition-all" data-val="Large">Large</button>
                         </div></div>`;
            }

            if(item.options.includes('icecream')) {
                html += `<div class="mb-8"><h3 class="text-[10px] font-black uppercase text-gray-400 tracking-widest mb-4">Vessel</h3>
                         <div class="grid grid-cols-2 gap-3">
                            <button onclick="setOption('vessel', 'Cone')" class="vessel-opt py-5 bg-gray-50 border-2 border-transparent rounded-2xl text-[10px] font-black uppercase transition-all" data-val="Cone">Cone</button>
                            <button onclick="setOption('vessel', 'Cup')" class="vessel-opt py-5 bg-gray-50 border-2 border-transparent rounded-2xl text-[10px] font-black uppercase transition-all" data-val="Cup">Cup</button>
                         </div></div>`;
            }

            document.getElementById('sheet-content').innerHTML = html;
            document.getElementById('option-overlay').classList.remove('hidden');
            setTimeout(() => document.getElementById('option-sheet').classList.add('active'), 10);
            
            currentOptions = {};
            validateSelection();
        }

        function setOption(type, val) {
            currentOptions[type] = val;
            document.querySelectorAll('.' + type + '-opt').forEach(btn => {
                if(btn.getAttribute('data-val') == val) {
                    btn.classList.add('bg-[#080d1a]', 'text-white', 'border-[#080d1a]', 'shadow-lg');
                } else {
                    btn.classList.remove('bg-[#080d1a]', 'text-white', 'border-[#080d1a]', 'shadow-lg');
                }
            });
            validateSelection();
        }

        function validateSelection() {
            let valid = true;
            if(currentItem.options.includes('spicy') && currentOptions.spicy === undefined) valid = false;
            if(currentItem.options.includes('drink') && (currentOptions.ice === undefined || currentOptions.size === undefined)) valid = false;
            if(currentItem.options.includes('icecream') && currentOptions.vessel === undefined) valid = false;
            
            const btn = document.getElementById('confirm-btn');
            btn.disabled = !valid;
            btn.style.opacity = valid ? '1' : '0.2';
        }

        document.getElementById('confirm-btn').onclick = function() {
            addToCart(currentItem, currentOptions);
            closeOptions();
        };

        function closeOptions() {
            document.getElementById('option-sheet').classList.remove('active');
            setTimeout(() => document.getElementById('option-overlay').classList.add('hidden'), 500);
        }

        function addToCart(item, options) {
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            cart.push({
                id: item.id,
                name: item.name,
                price: item.price,
                quantity: 1,
                options: options,
                timestamp: Date.now()
            });
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartUI();
        }

        function updateCartUI() {
            const cart = JSON.parse(localStorage.getItem('cart') || '[]');
            const count = cart.reduce((sum, item) => sum + item.quantity, 0);
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            document.getElementById('cart-count').innerText = count;
            document.getElementById('cart-summary-text').innerText = count + ' items selected';
            document.getElementById('cart-total-price').innerText = 'Rp ' + total.toLocaleString('id-ID');
        }
        updateCartUI();
    </script>
</body>
</html>
