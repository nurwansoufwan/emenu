<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DullStore - Digital Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">

    <!-- Header -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-black text-indigo-600 italic">DullStore.</h1>
            <a href="/login" class="text-sm font-bold text-gray-500 hover:text-indigo-600">Admin Login</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-indigo-600 py-12 px-4 mb-8">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-black text-white mb-2">Selamat Datang!</h2>
            <p class="text-indigo-100">Silahkan pilih menu favorit Anda hari ini.</p>
        </div>
    </div>

    <!-- Menu List -->
    <div class="max-w-6xl mx-auto px-4 pb-20">
        @foreach($categories as $category)
            <div class="mb-10">
                <h3 class="text-xl font-black text-gray-800 mb-6 border-l-4 border-indigo-600 pl-3 lowercase">
                    # {{ $category->name }}
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($category->products as $product)
                        <div class="bg-white rounded-3xl p-4 shadow-sm border border-gray-100 flex gap-4 hover:shadow-md transition">
                            <!-- Image Placeholder -->
                            <div class="w-24 h-24 bg-gray-100 rounded-2xl flex-shrink-0 flex items-center justify-center">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover rounded-2xl">
                                @else
                                    <i class="fa-solid fa-utensils text-gray-300 text-2xl"></i>
                                @endif
                            </div>
                            
                            <div class="flex flex-col justify-between py-1 w-full">
                                <div>
                                    <h4 class="font-bold text-gray-800">{{ $product->name }}</h4>
                                    <p class="text-xs text-gray-400 line-clamp-2">{{ $product->description }}</p>
                                </div>
                                <div class="flex justify-between items-center mt-2">
                                    <span class="font-black text-indigo-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <button class="bg-indigo-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-lg shadow-indigo-100 hover:scale-110 transition">
                                        <i class="fa-solid fa-plus text-xs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>