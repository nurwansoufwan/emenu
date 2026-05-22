<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>{{ $food->name }} | The Bilabola Space</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap');
        body { font-family: 'Outfit', sans-serif; background-color: #ffffff; color: #080d1a; }
        .option-btn.active { background-color: #080d1a; color: white; border-color: #080d1a; box-shadow: 0 10px 20px -5px rgba(8, 13, 26, 0.2); }
    </style>
</head>
<body class="pb-32">

    <!-- Sticky Header -->
    <header class="fixed top-0 inset-x-0 z-50 px-6 py-6 flex justify-between items-center pointer-events-none">
        <a href="{{ route('customer.index') }}" class="w-12 h-12 bg-white/40 backdrop-blur-xl border border-white/20 rounded-2xl flex items-center justify-center shadow-xl pointer-events-auto active:scale-90 transition-all">
            <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
        </a>
    </header>

    <!-- Hero Image Area -->
    <div class="relative w-full aspect-[4/3] lg:aspect-video overflow-hidden">
        <img src="{{ $food->image ? (str_starts_with($food->image, 'http') ? $food->image : asset('storage/'.$food->image)) : 'https://via.placeholder.com/800' }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent"></div>
    </div>

    <!-- Product Content -->
    <div class="px-8 pt-6 -mt-16 relative z-10 bg-white rounded-t-[3.5rem]">
        <div class="flex flex-col mb-8">
            <div class="flex justify-between items-start mb-2">
                <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[9px] font-black uppercase tracking-[0.2em] rounded-full">{{ $food->category->name ?? 'Menu' }}</span>
                <p class="text-2xl font-black text-gray-900 italic">Rp {{ number_format($food->price, 0, ',', '.') }}</p>
            </div>
            <h1 class="text-4xl font-black text-gray-900 leading-none tracking-tighter">{{ $food->name }}</h1>
        </div>
        
        <div class="h-px w-full bg-gray-50 mb-8"></div>

        <div class="space-y-10">
            <!-- Options: Spiciness -->
            @if($food->options && in_array('spicy', $food->options))
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Spiciness Level</h3>
                    <span class="text-[10px] font-bold text-red-500">Required</span>
                </div>
                <div class="flex gap-2 overflow-x-auto hide-scrollbar pb-2">
                    @foreach(range(0, 5) as $level)
                    <button onclick="selectOption('spicy', {{ $level }})" 
                        class="option-btn spicy-btn min-w-[3.5rem] h-14 rounded-2xl border-2 border-gray-50 bg-gray-50 flex items-center justify-center text-sm font-black transition-all"
                        data-value="{{ $level }}">
                        {{ $level }}
                    </button>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Options: Drink -->
            @if($food->options && in_array('drink', $food->options))
            <div class="space-y-8">
                <div>
                    <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Extra Ice?</h3>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach(['Normal', 'Extra Ice', 'No Ice'] as $opt)
                        <button onclick="selectOption('ice', '{{ $opt }}')" 
                            class="option-btn ice-btn py-4 rounded-2xl border-2 border-gray-50 bg-gray-50 text-[10px] font-black uppercase transition-all"
                            data-value="{{ $opt }}">{{ $opt }}</button>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Cup Size</h3>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach(['Small', 'Large'] as $opt)
                        <button onclick="selectOption('size', '{{ $opt }}')" 
                            class="option-btn size-btn py-4 rounded-2xl border-2 border-gray-50 bg-gray-50 text-[10px] font-black uppercase transition-all"
                            data-value="{{ $opt }}">{{ $opt }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Options: Ice Cream -->
            @if($food->options && in_array('icecream', $food->options))
            <div>
                <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4">Wadah Ice Cream</h3>
                <div class="grid grid-cols-2 gap-2">
                    <button onclick="selectOption('vessel', 'Cone')" class="option-btn vessel-btn py-4 rounded-2xl border-2 border-gray-50 bg-gray-50 text-[10px] font-black uppercase transition-all" data-value="Cone">Cone</button>
                    <button onclick="selectOption('vessel', 'Cup')" class="option-btn vessel-btn py-4 rounded-2xl border-2 border-gray-50 bg-gray-50 text-[10px] font-black uppercase transition-all" data-value="Cup">Cup</button>
                </div>
            </div>
            @endif

            <!-- Description Section -->
            <div>
                <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Description</h3>
                <p class="text-gray-500 text-sm font-medium leading-relaxed">
                    {{ $food->description ?: 'Nikmati hidangan istimewa kami yang diolah dengan resep rahasia dan bahan terbaik untuk memberikan pengalaman kuliner tak terlupakan.' }}
                </p>
            </div>
        </div>

        <!-- Quantity & Add Button -->
        <div class="mt-12 flex items-center space-x-4">
            <div class="flex items-center bg-gray-100 p-2 rounded-[2rem]">
                <button onclick="updateQty(-1)" class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-gray-900 shadow-sm active:scale-90 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"/></svg>
                </button>
                <span id="qty-text" class="w-12 text-center text-lg font-black italic">1</span>
                <button onclick="updateQty(1)" class="w-12 h-12 bg-[#080d1a] rounded-full flex items-center justify-center text-white shadow-lg active:scale-90 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                </button>
            </div>
            <button onclick="addToCart()" id="add-btn" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-5 rounded-[2.5rem] shadow-2xl shadow-blue-900/30 text-xs font-black uppercase tracking-widest transition-all active:scale-95">
                Add to Cart
            </button>
        </div>
    </div>

    <script>
        let quantity = 1;
        let basePrice = {{ $food->price }};
        let selectedOptions = {
            spicy: null,
            ice: null,
            size: null,
            vessel: null
        };

        function selectOption(type, value) {
            selectedOptions[type] = value;
            const btns = document.querySelectorAll('.' + type + '-btn');
            btns.forEach(btn => {
                if(btn.getAttribute('data-value') == value) btn.classList.add('active');
                else btn.classList.remove('active');
            });
            validateForm();
        }

        function updateQty(val) {
            quantity = Math.max(1, quantity + val);
            document.getElementById('qty-text').innerText = quantity;
        }

        function validateForm() {
            let isValid = true;
            @if($food->options && in_array('spicy', $food->options))
                if(selectedOptions.spicy === null) isValid = false;
            @endif
            @if($food->options && in_array('drink', $food->options))
                if(selectedOptions.ice === null || selectedOptions.size === null) isValid = false;
            @endif
            @if($food->options && in_array('icecream', $food->options))
                if(selectedOptions.vessel === null) isValid = false;
            @endif

            const btn = document.getElementById('add-btn');
            if(isValid) {
                btn.classList.remove('opacity-50', 'cursor-not-allowed');
                btn.innerText = 'Add to Cart';
            } else {
                btn.classList.add('opacity-50', 'cursor-not-allowed');
                btn.innerText = 'Select Options';
            }
            return isValid;
        }

        function addToCart() {
            if(!validateForm()) return;
            const cartItem = {
                id: {{ $food->id }},
                name: "{{ $food->name }}",
                price: basePrice,
                image: "{{ $food->image ? (str_starts_with($food->image, 'http') ? $food->image : asset('storage/'.$food->image)) : 'https://via.placeholder.com/150' }}",
                quantity: quantity,
                options: selectedOptions,
                timestamp: Date.now()
            };
            let cart = JSON.parse(localStorage.getItem('cart') || '[]');
            cart.push(cartItem);
            localStorage.setItem('cart', JSON.stringify(cart));
            
            const btn = document.getElementById('add-btn');
            btn.classList.replace('bg-blue-600', 'bg-green-600');
            btn.innerText = 'Added! ✓';
            setTimeout(() => { window.location.href = "{{ route('customer.index') }}"; }, 800);
        }
        validateForm();
    </script>
</body>
</html>
