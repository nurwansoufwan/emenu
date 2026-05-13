<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>DullStore - Digital Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans" 
    x-data="cartSystem()" 
    x-cloak>

    <!-- Header Section -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="px-4 py-3 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-bold text-orange-600 uppercase tracking-wider">DullStore</h1>
                <p class="text-xs text-gray-500">Meja Nomor: <span class="font-bold text-gray-800">{{ $table->number }}</span></p>
            </div>
            <button class="bg-gray-100 p-2 rounded-full active:scale-90 transition-transform">
                <i class="fa-solid fa-magnifying-glass text-gray-600"></i>
            </button>
        </div>

        <!-- Category Tabs -->
        <div class="flex overflow-x-auto no-scrollbar px-4 py-2 space-x-4 border-t border-gray-100 bg-white">
            @foreach($categories as $category)
            <a href="#cat-{{ $category->id }}" class="flex-none px-4 py-1.5 rounded-full bg-orange-50 text-orange-600 text-sm font-medium border border-orange-100 active:bg-orange-600 active:text-white">
                {{ $category->name }}
            </a>
            @endforeach
        </div>
    </header>

    <!-- Banner -->
    <section class="px-4 py-4">
        <div class="w-full h-32 bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl p-5 text-white flex items-center justify-between overflow-hidden relative shadow-lg">
            <div class="z-10">
                <p class="text-xs font-medium opacity-90 uppercase tracking-widest">Spesial Hari Ini</p>
                <h2 class="text-2xl font-black italic">DULL SEAFOOD</h2>
                <p class="text-[10px] mt-1 bg-white/20 inline-block px-2 py-0.5 rounded">Diskon 20% khusus Meja {{ $table->number }}</p>
            </div>
            <i class="fa-solid fa-utensils text-8xl opacity-10 absolute -right-4 -bottom-4 rotate-12"></i>
        </div>
    </section>

    <!-- Menu List -->
    <main class="px-4 pb-36">
        @foreach($categories as $category)
        <div id="cat-{{ $category->id }}" class="mb-8 scroll-mt-28">
            <h3 class="text-lg font-bold mb-4 flex items-center text-gray-900">
                <span class="w-1.5 h-6 bg-orange-500 rounded-full mr-3"></span>
                {{ $category->name }}
            </h3>
            
            <div class="grid grid-cols-1 gap-4">
                @foreach($category->products as $product)
                <div class="bg-white rounded-2xl p-3 flex shadow-sm border border-gray-100 hover:border-orange-200 transition-colors">
                    <div class="flex-1 pr-2">
                        <h4 class="font-bold text-gray-900 text-sm">{{ $product->name }}</h4>
                        <p class="text-[11px] text-gray-500 mt-1 line-clamp-2 leading-snug">
                            {{ $product->description }}
                        </p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="font-black text-orange-600 text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            
                            <!-- Counter Button -->
                            <div class="flex items-center space-x-3 bg-gray-100 rounded-xl p-1 border border-gray-200">
                                <button @click="removeFromCart({{ $product->id }}, {{ $product->price }})" 
                                        class="w-8 h-8 flex items-center justify-center bg-white rounded-lg shadow-sm text-orange-600 active:bg-orange-50 transition-colors">
                                    <i class="fa-solid fa-minus text-[10px]"></i>
                                </button>
                                
                                <span class="text-xs font-black w-5 text-center" 
                                      x-text="getItemQty({{ $product->id }})"></span>
                                
                                <button @click="addToCart({{ $product->id }}, {{ $product->price }}, '{{ $product->name }}')" 
                                        class="w-8 h-8 flex items-center justify-center bg-orange-500 rounded-lg shadow-sm text-white active:bg-orange-600 transition-colors">
                                    <i class="fa-solid fa-plus text-[10px]"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="shrink-0">
                        <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/150' }}" 
                             alt="{{ $product->name }}" 
                             class="w-24 h-24 object-cover rounded-xl shadow-inner border border-gray-50">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </main>

    <!-- Floating Cart Bar -->
    <div x-show="cart.length > 0" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-y-full"
         x-transition:enter-end="translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-y-0"
         x-transition:leave-end="translate-y-full"
         class="fixed bottom-0 left-0 right-0 p-4 z-[60]">
        
        <div class="bg-gray-900 rounded-2xl shadow-2xl p-4 flex items-center justify-between text-white max-w-2xl mx-auto border border-white/10">
            <div class="flex items-center space-x-4">
                <div class="relative bg-orange-500 p-2.5 rounded-xl shadow-lg shadow-orange-500/30">
                    <i class="fa-solid fa-bag-shopping text-lg"></i>
                    <span class="absolute -top-2 -right-2 bg-white text-orange-600 text-[10px] font-black px-1.5 py-0.5 rounded-full shadow-md" 
                          x-text="getTotalQty()"></span>
                </div>
                <div>
                    <p class="text-[10px] text-gray-400 uppercase tracking-tighter font-bold">Total Pembayaran</p>
                    <p class="font-black text-orange-400" x-text="formatRupiah(totalPrice)"></p>
                </div>
            </div>
            
            <button @click="sendOrder()" 
                    :disabled="loading"
                    class="bg-orange-500 hover:bg-orange-600 disabled:bg-gray-700 text-white px-6 py-3 rounded-xl font-black text-xs flex items-center space-x-2 active:scale-95 transition-all shadow-lg shadow-orange-500/20">
                <span x-show="!loading">PESAN SEKARANG</span>
                <span x-show="loading">MENGIRIM...</span>
                <i x-show="!loading" class="fa-solid fa-arrow-right text-[10px]"></i>
            </button>
        </div>
    </div>

    <!-- Script Logic -->
    <script>
        function cartSystem() {
            return {
                cart: [],
                totalPrice: 0,
                loading: false,
                tableId: "{{ $table->id }}",

                addToCart(id, price, name) {
                    let item = this.cart.find(i => i.id === id);
                    if (item) {
                        item.qty++;
                    } else {
                        this.cart.push({ id: id, qty: 1, price: price, name: name });
                    }
                    this.totalPrice += price;
                },

                removeFromCart(id, price) {
                    let item = this.cart.find(i => i.id === id);
                    if (item && item.qty > 0) {
                        item.qty--;
                        this.totalPrice -= price;
                        if (item.qty === 0) {
                            this.cart = this.cart.filter(i => i.id !== id);
                        }
                    }
                },

                getItemQty(id) {
                    let item = this.cart.find(i => i.id === id);
                    return item ? item.qty : 0;
                },

                getTotalQty() {
                    return this.cart.reduce((sum, item) => sum + item.qty, 0);
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
                },

                async sendOrder() {
                    this.loading = true;
                    
                    const payload = {
                        table_id: this.tableId,
                        items: this.cart.map(item => ({
                            id: item.id,
                            qty: item.qty
                        })),
                        _token: "{{ csrf_token() }}"
                    };

                    try {
                        const response = await fetch("{{ route('order.store') }}", {
                            method: "POST",
                            headers: { "Content-Type": "application/json" },
                            body: JSON.stringify(payload)
                        });

                        const result = await response.json();

                        if (result.success) {
                            alert("✅ Pesanan berhasil dikirim ke dapur!");
                            this.cart = [];
                            this.totalPrice = 0;
                            // Opsional: Redirect ke halaman status pesanan
                            // window.location.href = "/order/status/" + result.order_id;
                        } else {
                            alert("❌ Gagal: " + result.message);
                        }
                    } catch (error) {
                        alert("❌ Terjadi kesalahan jaringan.");
                    } finally {
                        this.loading = false;
                    }
                }
            }
        }
    </script>
</body>
</html>