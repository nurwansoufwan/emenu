<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome Back | The Bilabola Space Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;900&display=swap');

        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f1f1f9;
            overflow: hidden;
        }

        .login-card {
            background: white;
            border-radius: 40px;
            box-shadow: 0 50px 100px -20px rgba(8, 13, 26, 0.12);
            overflow: hidden;
            display: flex;
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            animation: cardEnter 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes cardEnter {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .illustration-blob {
            background: #080d1a;
            mask-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill='%23FF0066' d='M44.7,-76.4C58.8,-69.2,71.8,-59.1,79.6,-46.5C87.4,-33.8,90,-18.7,89.9,-3.7C89.7,11.3,86.8,26.1,78.8,38.6C70.8,51.1,57.7,61.4,43.6,70.5C29.5,79.6,14.7,87.5,-1.1,89.4C-16.9,91.3,-33.8,87.2,-48.8,78.5C-63.8,69.8,-76.9,56.4,-85.1,41.2C-93.3,26,-96.6,8.9,-94.1,-7.1C-91.6,-23.1,-83.3,-38.1,-71.4,-48.9C-59.5,-59.7,-44,-66.3,-30.1,-73.6C-16.2,-80.9,-4.1,-88.9,9.4,-90.3C22.9,-91.7,30.6,-83.6,44.7,-76.4Z' transform='translate(100 100)' /%3E%3C/svg%3E");
            mask-repeat: no-repeat;
            mask-size: contain;
            mask-position: center;
            width: 110%;
            height: 110%;
            position: relative;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            50% {
                transform: translate(-10px, 15px) rotate(2deg);
            }
        }

        .input-minimal {
            border: 1.5px solid #eee;
            border-radius: 20px;
            padding: 14px 24px;
            transition: all 0.3s ease;
            outline: none;
        }

        .input-minimal:focus {
            border-color: #080d1a;
            box-shadow: 0 10px 20px -5px rgba(8, 13, 26, 0.05);
        }

        .fade-up {
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .delay-1 {
            animation-delay: 0.2s;
        }

        .delay-2 {
            animation-delay: 0.3s;
        }

        .delay-3 {
            animation-delay: 0.4s;
        }
    </style>
</head>

<body class="antialiased min-h-screen flex items-center justify-center p-6 lg:p-12">

    <div class="login-card">
        <!-- Left Side: Form -->
        <div class="w-full lg:w-1/2 p-12 lg:p-16 flex flex-col justify-center">
            <div class="mb-12 fade-up">
                <p class="text-xs font-black uppercase tracking-[0.3em] text-gray-400 mb-2">The Bilabola Space Admin</p>
                <div class="h-1 w-12 bg-[#080d1a] rounded-full mb-8"></div>
                <h1 class="text-4xl font-light text-gray-900 leading-tight">
                    <span class="inline-block animate-pulse text-blue-600 mr-1">✦</span>
                    Welcome back
                </h1>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="fade-up delay-1">
                    <div class="relative group">
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full input-minimal text-gray-900 placeholder-gray-300 font-medium"
                            placeholder="Email address">
                        <div
                            class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#080d1a] transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    @if ($errors->has('email'))
                        <p class="text-red-500 text-[10px] font-bold mt-2 ml-4">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="fade-up delay-2">
                    <div class="relative group">
                        <input type="password" name="password" required
                            class="w-full input-minimal text-gray-900 placeholder-gray-300 font-medium"
                            placeholder="Password">
                        <div
                            class="absolute right-6 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-[#080d1a] transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17.086V19a1 1 0 01-1 1h-2a1 1 0 01-1-1v-2a1 1 0 01.293-.707L9.414 13.172A6 6 0 1121 9z" />
                            </svg>
                        </div>
                    </div>
                    @if ($errors->has('password'))
                        <p class="text-red-500 text-[10px] font-bold mt-2 ml-4">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="flex items-center justify-between fade-up delay-3">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 rounded border-gray-200 text-[#080d1a] focus:ring-[#080d1a] focus:ring-offset-0 transition-all">
                        <label for="remember" class="ml-3 text-xs font-medium text-gray-400">Remember me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-xs font-bold text-gray-300 hover:text-gray-600 transition-colors">Forgot
                            password?</a>
                    @endif
                </div>

                <div class="pt-4 fade-up delay-3">
                    <button type="submit"
                        class="w-full lg:w-fit bg-[#080d1a] hover:bg-black text-white font-bold px-10 py-4 rounded-2xl shadow-2xl shadow-blue-900/10 active:scale-[0.97] transition-all duration-300">
                        Sign in
                    </button>
                </div>
            </form>

            <!-- Social Login placeholder -->
            <div class="mt-12 flex items-center space-x-4 fade-up delay-3">
                <span class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Or login with</span>
                <div class="flex space-x-3">
                    <div
                        class="w-8 h-8 rounded-full border border-gray-100 flex items-center justify-center text-gray-400 hover:border-gray-900 hover:text-gray-900 cursor-pointer transition-all">
                        <i class="fa-brands fa-google text-xs"></i>
                    </div>
                    <div
                        class="w-8 h-8 rounded-full border border-gray-100 flex items-center justify-center text-gray-400 hover:border-gray-900 hover:text-gray-900 cursor-pointer transition-all">
                        <i class="fa-brands fa-apple text-xs"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Illustration -->
        <div class="hidden lg:flex w-1/2 bg-[#f8f9fc] items-center justify-center relative overflow-hidden">
            <div class="illustration-blob">
                <img src="/login_illustration_1778703227416.png" class="w-full h-full object-cover scale-110"
                    alt="Illustration">
            </div>

            <!-- Floating particles -->
            <div class="absolute top-20 right-20 w-4 h-4 bg-blue-100 rounded-full animate-bounce"></div>
            <div class="absolute bottom-40 left-20 w-2 h-2 bg-blue-200 rounded-full animate-pulse"></div>
        </div>
    </div>

    <!-- Font Awesome for social icons -->
    <script src="https://kit.fontawesome.com/4c3016f469.js" crossorigin="anonymous"></script>
</body>

</html>
