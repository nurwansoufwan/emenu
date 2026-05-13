<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DullStore - Menu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 antialiased">

    <!-- Navbar untuk User/Scan QR -->
    <nav class="bg-white shadow-sm p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">DullStore</h1>
            @if (Route::has('login'))
                <div>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-600 px-4 py-2 bg-gray-100 rounded-lg">Masuk Panel Admin</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:underline">Admin Login</a>
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Daftar Menu Kami</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @if(isset($menus) && count($menus) > 0)
                @foreach($menus as $item)
                    <div class="bg-white p-4 rounded-xl shadow">
                        <h3 class="font-bold">{{ $item->name }}</h3>
                        <p>{{ $item->description }}</p>
                    </div>
                @endforeach
            @else
                <div class="col-span-full text-center py-20 bg-white rounded-2xl border-2 border-dashed">
                    <p class="text-gray-400">Selamat datang di DullStore! Menu sedang disiapkan.</p>
                </div>
            @endif
        </div>
    </main>

</body>
</html>