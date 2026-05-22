<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>The Bilabola Space Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 flex">

    <aside class="group w-20 hover:w-64 min-h-screen bg-[#080d1a] text-gray-400 flex-shrink-0 hidden md:flex flex-col border-r border-white/5 transition-all duration-300 ease-in-out z-20">

        <div class="p-5 flex items-center overflow-hidden border-b border-white/5 h-20">
            <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-blue-900/30">
                B
            </div>
            <span class="ml-4 text-white font-bold tracking-wider text-base uppercase opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                Bilabola
            </span>
        </div>

        <nav class="flex-1 p-4 space-y-2 overflow-hidden">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center py-3 px-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                <div class="flex-shrink-0 w-6 h-6 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                <span class="ml-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">Dashboard</span>
            </a>

            <a href="{{ route('admin.transaksi.index') }}"
                class="flex items-center py-3 px-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.transaksi.*') ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                <div class="flex-shrink-0 w-6 h-6 flex items-center justify-center relative">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    @if(isset($pendingOrdersCount) && $pendingOrdersCount > 0)
                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-[#080d1a]"></span>
                    @endif
                </div>
                <div class="ml-4 flex items-center justify-between flex-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span class="whitespace-nowrap font-medium">Pesanan Masuk</span>
                    @if(isset($pendingOrdersCount) && $pendingOrdersCount > 0)
                        <span class="bg-red-500 text-[9px] font-black px-1.5 py-0.5 rounded-md text-white">{{ $pendingOrdersCount }}</span>
                    @endif
                </div>
            </a>

            <a href="{{ route('admin.category.index') }}"
                class="flex items-center py-3 px-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.category.*') ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                <div class="flex-shrink-0 w-6 h-6 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                </div>
                <span class="ml-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap font-medium">Kategori Menu</span>
            </a>

            <a href="{{ route('admin.food.index') }}"
                class="flex items-center py-3 px-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.food.*') ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                <div class="flex-shrink-0 w-6 h-6 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <span class="ml-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap font-medium">Daftar Menu</span>
            </a>

            <a href="{{ route('admin.laporan.index') }}"
                class="flex items-center py-3 px-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.laporan.*') ? 'bg-white/10 text-white' : 'hover:bg-white/5 hover:text-white' }}">
                <div class="flex-shrink-0 w-6 h-6 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <span class="ml-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap text-sm font-medium">Laporan Analitik</span>
            </a>

            @if(Auth::user()->role === 'superadmin')
            <div class="h-px bg-white/5 my-4"></div>
            <a href="{{ route('admin.user.index') }}"
                class="flex items-center py-3 px-3 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.user.*') ? 'bg-white/10 text-white font-medium' : 'hover:bg-white/5 hover:text-white' }}">
                <div class="flex-shrink-0 w-6 h-6 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <span class="ml-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap font-medium text-sm">Kelola Admin</span>
            </a>
            @endif
        </nav>

        <div class="p-4 border-t border-white/5">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center py-3 px-3 rounded-xl transition-all duration-200 hover:bg-red-500/10 hover:text-red-500">
                    <div class="flex-shrink-0 w-6 h-6 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </div>
                    <span class="ml-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap text-sm font-medium">Logout</span>
                </button>
            </form>
        </div>
    </aside>
    <div class="flex-1 flex flex-col min-w-0">
        <header class="bg-white/80 backdrop-blur-md h-20 flex items-center px-8 justify-between border-b border-gray-100 sticky top-0 z-10">
            <div class="font-bold text-gray-800 text-lg uppercase tracking-tight">The Bilabola Space Management</div>
            <div class="flex items-center space-x-4">
                <span class="text-sm font-medium text-gray-500 hidden sm:block">{{ Auth::user()->name }}</span>
                <div class="w-10 h-10 bg-[#080d1a] rounded-full flex items-center justify-center text-white text-xs font-bold border-2 border-white shadow-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <main class="p-8">
            {{ $slot }}
        </main>
    </div>
</body>

</html>