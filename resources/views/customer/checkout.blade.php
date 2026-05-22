<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>The Bilabola Space | Premium Checkout</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap');
        
        body { 
            font-family: 'Outfit', sans-serif; 
            background-color: #fcfdfe; 
            min-height: 100vh;
        }

        .step-pill.active {
            background-color: #080d1a;
            color: white;
            box-shadow: 0 10px 20px -5px rgba(8, 13, 26, 0.3);
            transform: scale(1.1);
        }

        .step-pill {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .qris-card {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: white;
        }

        @keyframes slideFadeIn {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .step-container-animate {
            animation: slideFadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes borderGlow {
            0%, 100% { box-shadow: 0 20px 50px -10px rgba(15, 23, 42, 0.3); }
            50% { box-shadow: 0 20px 50px 0px rgba(59, 130, 246, 0.4); }
        }
        .qris-card-glow {
            animation: borderGlow 6s ease-in-out infinite;
        }

        @keyframes scan {
            0% { top: 0%; }
            50% { top: 100%; }
            100% { top: 0%; }
        }
        .scan-line {
            animation: scan 4s linear infinite;
        }
    </style>
</head>
<body class="pb-12 text-gray-900">

    <!-- Premium Animated Background Shapes -->
    <div class="fixed inset-0 pointer-events-none -z-10 overflow-hidden">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-100/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-1/2 -right-24 w-64 h-64 bg-indigo-100/20 rounded-full blur-3xl animate-bounce" style="animation-duration: 8s"></div>
    </div>

    <!-- Header bar -->
    <header class="px-6 pt-8 pb-4 flex items-center justify-between border-b border-gray-100 bg-white/60 backdrop-blur-md sticky top-0 z-40">
        <div class="flex items-center space-x-3">
            <button onclick="goBackOrHome()" class="w-10 h-10 bg-gray-50 hover:bg-gray-100 rounded-xl flex items-center justify-center text-gray-800 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <h1 class="text-lg font-black text-gray-900 leading-none tracking-tight">Checkout</h1>
        </div>
        <span class="text-[9px] font-black uppercase text-blue-600 tracking-widest bg-blue-50 px-3 py-1.5 rounded-full">Tasikmalaya</span>
    </header>

    <!-- Content Container -->
    <main class="max-w-md mx-auto px-6 mt-6">

        <!-- Progress Steps Bar -->
        <div class="flex justify-between items-center mb-8 px-4">
            <div class="flex items-center space-x-2">
                <div id="step-badge-1" class="step-pill active w-7 h-7 rounded-full flex items-center justify-center text-[10px] font-black tracking-tighter">1</div>
                <span class="text-[10px] font-black uppercase tracking-widest text-white" id="step-label-1">Detail</span>
            </div>
            <div class="h-0.5 bg-slate-800 flex-1 mx-3" id="step-line-1"></div>
            <div class="flex items-center space-x-2">
                <div id="step-badge-2" class="step-pill w-7 h-7 bg-slate-800/80 text-slate-500 rounded-full flex items-center justify-center text-[10px] font-black tracking-tighter">2</div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-500" id="step-label-2">Bayar</span>
            </div>
            <div class="h-0.5 bg-slate-800 flex-1 mx-3" id="step-line-2"></div>
            <div class="flex items-center space-x-2">
                <div id="step-badge-3" class="step-pill w-7 h-7 bg-slate-800/80 text-slate-500 rounded-full flex items-center justify-center text-[10px] font-black tracking-tighter">3</div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-500" id="step-label-3">QRIS</span>
            </div>
        </div>

        <!-- ==================== STEP 1: CHECKOUT DETAIL ==================== -->
        <div id="step-1-container" class="space-y-6 step-container-animate">
            
            <!-- Items Card -->
            <div class="bg-white border border-gray-100 rounded-[2rem] p-6 shadow-sm">
                <h3 class="text-xs font-black uppercase text-gray-400 tracking-widest mb-4">Daftar Makanan</h3>
                <div id="checkout-items-list" class="space-y-4">
                    <!-- Dynamically populated -->
                </div>
            </div>

            <!-- Notes Card -->
            <div class="bg-white border border-gray-100 rounded-[2rem] p-6 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <label for="order-notes" class="text-xs font-black uppercase text-gray-400 tracking-widest">Catatan Pesanan (Notes)</label>
                    <span class="text-[9px] font-semibold text-gray-300">Opsional</span>
                </div>
                <textarea id="order-notes" rows="2" 
                    class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-2xl p-4 text-xs font-bold outline-none transition-all placeholder-gray-400"
                    placeholder="Contoh: Sambal dipisah, sendok plastik 2, es batu dikit saja..."></textarea>
            </div>

            <!-- Payment Details Card -->
            <div class="bg-white border border-gray-100 rounded-[2rem] p-6 shadow-sm space-y-3.5">
                <h3 class="text-xs font-black uppercase text-gray-400 tracking-widest mb-4">Payment Detail</h3>
                <div class="flex justify-between items-center text-xs font-bold text-gray-500">
                    <span>Subtotal</span>
                    <span id="price-subtotal" class="text-gray-900">Rp 0</span>
                </div>
                <div class="flex justify-between items-center text-xs font-bold text-gray-500">
                    <span>Pajak (PPN 11%)</span>
                    <span id="price-tax" class="text-gray-900">Rp 0</span>
                </div>
                <div class="border-t border-dashed border-gray-100 my-2"></div>
                <div class="flex justify-between items-center">
                    <span class="text-xs font-black uppercase text-gray-900 tracking-wider">Total Pembayaran</span>
                    <span id="price-grandtotal" class="text-lg font-black text-blue-600 italic">Rp 0</span>
                </div>
            </div>

            <!-- Action Button -->
            <button onclick="goToStep(2)" class="w-full bg-[#080d1a] hover:bg-black text-white py-5 rounded-[2rem] text-xs font-black uppercase tracking-[0.2em] shadow-xl shadow-gray-900/10 active:scale-95 transition-all flex items-center justify-center space-x-2">
                <span>Lanjut ke Pembayaran</span>
                <span>→</span>
            </button>
        </div>

        <!-- ==================== STEP 2: PAYMENT DETAILS & CUSTOMER INFO ==================== -->
        <div id="step-2-container" class="hidden space-y-6 step-container-animate">

            <!-- Customer Information Card -->
            <div class="bg-white border border-gray-100 rounded-[2rem] p-6 shadow-sm space-y-4">
                <h3 class="text-xs font-black uppercase text-gray-400 tracking-widest mb-2">Customer Information</h3>
                <div>
                    <label class="block text-[9px] font-black uppercase text-gray-400 tracking-widest mb-2">Nama Pelanggan</label>
                    <input type="text" id="cust-name-edit" required
                        class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-2xl p-4.5 text-xs font-bold outline-none transition-all"
                        placeholder="Masukkan nama Anda">
                </div>
                <div>
                    <label class="block text-[9px] font-black uppercase text-gray-400 tracking-widest mb-2">Nomor Meja</label>
                    <input type="number" id="cust-table-edit" required
                        class="w-full bg-gray-50 border-2 border-transparent focus:border-blue-600 focus:bg-white rounded-2xl p-4.5 text-xs font-bold outline-none transition-all"
                        placeholder="Contoh: 05">
                </div>
            </div>

            <!-- Payment Method Card -->
            <div class="bg-white border border-gray-100 rounded-[2rem] p-6 shadow-sm space-y-4">
                <h3 class="text-xs font-black uppercase text-gray-400 tracking-widest mb-2">Payment Method</h3>
                <div class="border-2 border-blue-600 bg-blue-50/20 rounded-2xl p-5 flex items-start space-x-4 relative">
                    <div class="w-5 h-5 border-4 border-blue-600 bg-white rounded-full mt-0.5 flex items-center justify-center">
                        <div class="w-2.5 h-2.5 bg-blue-600 rounded-full"></div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center space-x-2">
                            <span class="text-xs font-black text-gray-900 uppercase">Online Payment</span>
                            <span class="text-[8px] font-black bg-blue-600 text-white px-2 py-0.5 rounded-full uppercase tracking-wider">Fast</span>
                        </div>
                        <p class="text-[10px] font-bold text-gray-400 mt-1 uppercase tracking-widest">QRIS (GoPay, OVO, ShopeePay, M-Banking)</p>
                    </div>
                </div>
            </div>

            <!-- Summary Receipt Card -->
            <div class="bg-white border border-gray-100 rounded-[2rem] p-6 shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-[8px] font-black uppercase tracking-widest text-gray-400">Total Tagihan</p>
                    <p class="text-sm font-black text-gray-900" id="receipt-total-items">0 Item</p>
                </div>
                <p id="receipt-grandtotal" class="text-xl font-black text-blue-600 italic">Rp 0</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-3">
                <button onclick="goToStep(1)" class="w-1/3 bg-white border-2 border-gray-100 text-gray-700 py-5 rounded-[2rem] text-xs font-black uppercase tracking-wider hover:bg-gray-50 active:scale-95 transition-all">
                    Kembali
                </button>
                <button onclick="triggerAlert(true)" class="w-2/3 bg-[#080d1a] hover:bg-black text-white py-5 rounded-[2rem] text-xs font-black uppercase tracking-[0.2em] shadow-xl shadow-gray-900/10 active:scale-95 transition-all">
                    Selesaikan Pembayaran
                </button>
            </div>
        </div>

        <!-- ==================== STEP 3: QRIS SCREEN ==================== -->
        <div id="step-3-container" class="hidden space-y-6 step-container-animate">
            
            <!-- QRIS Code Card (Premium Graphic) -->
            <div class="qris-card qris-card-glow rounded-[2.5rem] p-8 relative overflow-hidden flex flex-col items-center">
                <div class="absolute -top-12 -left-12 w-32 h-32 bg-white/5 rounded-full"></div>
                
                <!-- Merchant Banner Header -->
                <div class="text-center w-full mb-6">
                    <span class="text-xs font-black tracking-[0.25em] text-cyan-400 block uppercase">QRIS</span>
                    <span class="text-[8px] text-gray-300 font-extrabold uppercase tracking-widest">GPN & Bank Indonesia</span>
                    <div class="h-px bg-white/10 w-full my-3"></div>
                    <h2 class="text-sm font-black tracking-tight text-white uppercase">THE BILABOLA SPACE</h2>
                    <p class="text-[9px] text-cyan-400/80 font-bold uppercase tracking-wider mt-0.5">NMID: ID102030405060</p>
                </div>

                <!-- QR Grid Area (SVG realistic mock or Real QRIS Image) -->
                <div class="bg-white p-6 rounded-[2rem] shadow-inner relative flex justify-center items-center overflow-hidden" id="qris-download-area">
                    <div class="scan-line absolute left-0 right-0 pointer-events-none h-1 bg-gradient-to-r from-transparent via-blue-500/80 to-transparent shadow-[0_0_8px_#3b82f6]"></div>
                    @php
                        $qrisPath = 'images/qris.png';
                        $hasRealQris = file_exists(public_path($qrisPath));
                    @endphp

                    @if($hasRealQris)
                        <img src="{{ asset($qrisPath) }}" class="w-48 h-48 object-contain rounded-2xl mx-auto" id="qris-image-file">
                    @else
                        <svg id="qris-svg" class="w-48 h-48" viewBox="0 0 100 100" fill="none" stroke="currentColor">
                            <!-- Top-left Finder Pattern -->
                            <path d="M5,5 h20 v20 h-20 z" fill="#080d1a" stroke="none" />
                            <path d="M9,9 h12 v12 h-12 z" fill="white" stroke="none" />
                            <path d="M12,12 h6 v6 h-6 z" fill="#080d1a" stroke="none" />
                            
                            <!-- Top-right Finder Pattern -->
                            <path d="M75,5 h20 v20 h-20 z" fill="#080d1a" stroke="none" />
                            <path d="M79,9 h12 v12 h-12 z" fill="white" stroke="none" />
                            <path d="M82,12 h6 v6 h-6 z" fill="#080d1a" stroke="none" />
                            
                            <!-- Bottom-left Finder Pattern -->
                            <path d="M5,75 h20 v20 h-20 z" fill="#080d1a" stroke="none" />
                            <path d="M9,79 h12 v12 h-12 z" fill="white" stroke="none" />
                            <path d="M12,82 h6 v6 h-6 z" fill="#080d1a" stroke="none" />

                            <!-- Random QR Pixels for high realism -->
                            <rect x="35" y="5" width="5" height="10" fill="#080d1a" />
                            <rect x="45" y="15" width="10" height="5" fill="#080d1a" />
                            <rect x="60" y="5" width="5" height="5" fill="#080d1a" />
                            <rect x="35" y="25" width="15" height="5" fill="#080d1a" />
                            <rect x="55" y="20" width="5" height="15" fill="#080d1a" />
                            
                            <rect x="5" y="35" width="10" height="5" fill="#080d1a" />
                            <rect x="20" y="45" width="15" height="5" fill="#080d1a" />
                            <rect x="5" y="55" width="5" height="15" fill="#080d1a" />
                            <rect x="15" y="65" width="10" height="5" fill="#080d1a" />
                            
                            <rect x="75" y="35" width="5" height="15" fill="#080d1a" />
                            <rect x="85" y="45" width="10" height="5" fill="#080d1a" />
                            <rect x="80" y="55" width="5" height="10" fill="#080d1a" />
                            <rect x="90" y="65" width="5" height="5" fill="#080d1a" />
                            
                            <rect x="35" y="75" width="10" height="5" fill="#080d1a" />
                            <rect x="50" y="80" width="5" height="15" fill="#080d1a" />
                            <rect x="60" y="75" width="15" height="5" fill="#080d1a" />
                            <rect x="40" y="90" width="10" height="5" fill="#080d1a" />
                            <rect x="65" y="85" width="10" height="10" fill="#080d1a" />

                            <!-- Center GPN Logo Placeholder to look extremely legit -->
                            <rect x="42" y="42" width="16" height="16" rx="4" fill="white" stroke="#e11d48" stroke-width="2" />
                            <text x="50" y="52" font-size="8" font-family="'Outfit', sans-serif" font-weight="900" fill="#e11d48" text-anchor="middle">GPN</text>
                        </svg>
                    @endif
                </div>

                <!-- Download QR Code Button -->
                <button onclick="downloadQRIS()" class="mt-6 flex items-center space-x-2 bg-white/10 hover:bg-white/20 border border-white/15 px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest active:scale-95 transition-all">
                    <span>📥</span>
                    <span>Download QR Code</span>
                </button>
            </div>

            <!-- Action Button: Check Status -->
            <button onclick="checkPaymentStatus()" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-5.5 rounded-[2rem] text-xs font-black uppercase tracking-[0.25em] shadow-xl shadow-blue-600/20 active:scale-95 transition-all">
                Check Payment Status
            </button>

            <!-- Guide Card (Panduan) -->
            <div class="bg-white border border-gray-100 rounded-[2rem] p-7 shadow-sm">
                <h3 class="text-xs font-black uppercase text-gray-400 tracking-widest mb-4">Panduan Pembayaran</h3>
                <ol class="space-y-4 text-[11px] text-gray-500 font-bold leading-relaxed">
                    <li class="flex items-start">
                        <span class="w-5 h-5 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-black mr-3 text-[9px] shrink-0 mt-0.5">1</span>
                        <span>Screenshot (SS) dulu code QRIS di atas atau klik tombol <b>Download QR Code</b>.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="w-5 h-5 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-black mr-3 text-[9px] shrink-0 mt-0.5">2</span>
                        <span>Buka aplikasi QR Payment di m-banking (BCA, Mandiri, dll) atau e-wallet (GoPay, OVO, Dana) Anda.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="w-5 h-5 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-black mr-3 text-[9px] shrink-0 mt-0.5">3</span>
                        <span>Unggah (Upload) file QR code hasil download / capture tadi dari galeri HP Anda.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="w-5 h-5 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-black mr-3 text-[9px] shrink-0 mt-0.5">4</span>
                        <span>Periksa nominal transaksi dan nama merchant, lalu lakukan pembayaran.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="w-5 h-5 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-black mr-3 text-[9px] shrink-0 mt-0.5">5</span>
                        <span>Kembali ke halaman ini dan klik tombol <b>Check Payment Status</b> di atas.</span>
                    </li>
                </ol>
            </div>
        </div>

    </main>

    <!-- Custom Premium Confirm Alert Overlay -->
    <div id="confirm-alert-overlay" class="fixed inset-0 bg-black/75 backdrop-blur-md z-[500] hidden items-center justify-center p-6 transition-all duration-300">
        <div class="bg-white rounded-[2.5rem] w-full max-w-sm p-8 text-center shadow-2xl relative overflow-hidden transform scale-95 transition-transform duration-300">
            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="text-2xl">💳</span>
            </div>
            <h2 class="text-xl font-black text-gray-900 leading-tight mb-3">Process payment now?</h2>
            <p class="text-xs text-gray-400 font-medium leading-relaxed px-2 mb-8">
                Your order cannot be canceled after payment is successfully made. Please double-check your item list.
            </p>
            <div class="space-y-3">
                <button onclick="goToStep(3)" class="w-full bg-[#080d1a] hover:bg-black text-white py-4.5 rounded-2xl text-xs font-black uppercase tracking-[0.2em] active:scale-95 transition-all shadow-lg">
                    Payment Now
                </button>
                <button onclick="triggerAlert(false)" class="w-full bg-white border-2 border-gray-100 text-gray-700 py-4.5 rounded-2xl text-xs font-black uppercase tracking-[0.2em] active:scale-95 transition-all hover:bg-gray-50">
                    Check Again
                </button>
            </div>
        </div>
    </div>

    <!-- Checking Payment Status Overlay Spinner -->
    <div id="loading-overlay" class="fixed inset-0 bg-black/85 backdrop-blur-md z-[600] hidden flex-col items-center justify-center p-6">
        <div class="animate-spin text-4xl text-blue-500 mb-4">⏳</div>
        <p class="text-xs text-blue-200 font-black uppercase tracking-[0.2em]">Checking payment status...</p>
        <p class="text-[10px] text-gray-400 mt-2 font-medium">Harap tunggu sebentar, sistem sedang memverifikasi dana Anda.</p>
    </div>

    <!-- Complete Payment Success Overlay Screen -->
    <div id="success-overlay" class="fixed inset-0 bg-white z-[700] hidden flex-col items-center justify-center p-8 text-center animate-fade-in">
        <div class="w-24 h-24 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center text-4xl shadow-inner mb-8 animate-bounce">
            ✓
        </div>
        <h1 class="text-4xl font-black text-gray-900 tracking-tighter mb-3 leading-none">ORDER COMPLETE!</h1>
        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest max-w-xs leading-relaxed px-4">
            Pesanan Anda berhasil dikirim ke Admin dan dicatat dalam riwayat pesanan Anda!
        </p>
        <div class="mt-8 text-[10px] font-black text-blue-600 bg-blue-50 px-5 py-2.5 rounded-full uppercase tracking-widest animate-pulse">
            Mengalihkan ke Menu...
        </div>
    </div>

    <!-- Custom Premium Toast/Alert Modal -->
    <div id="custom-alert-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[999] hidden items-center justify-center p-6 transition-all duration-300">
        <div class="bg-white rounded-[2.5rem] w-full max-w-sm p-8 text-center shadow-2xl relative overflow-hidden transform scale-95 opacity-0 transition-all duration-300" id="custom-alert-box">
            <!-- Animated Warning Icon -->
            <div class="w-16 h-16 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-6 border border-amber-100 shadow-inner">
                <svg class="w-8 h-8 animate-bounce text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h2 class="text-lg font-black text-gray-900 leading-tight mb-3">Informasi Belum Lengkap!</h2>
            <p class="text-xs text-gray-400 font-bold leading-relaxed px-4 mb-8" id="custom-alert-message">
                Harap isi Nama Anda dan Nomor Meja terlebih dahulu!
            </p>
            <button class="w-full bg-[#080d1a] hover:bg-black text-white py-4.5 rounded-2xl text-xs font-black uppercase tracking-[0.2em] active:scale-95 transition-all shadow-lg">
                Mengerti
            </button>
        </div>
    </div>

    <!-- Hidden link for downloading QRIS -->
    <a id="download-link" class="hidden"></a>

    <script>
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

        let cart = [];
        let subtotal = 0;
        let tax = 0;
        let grandtotal = 0;

        // Initialize Checkout Page
        function initCheckout() {
            cart = JSON.parse(localStorage.getItem('cart') || '[]');
            if (cart.length === 0) {
                showCustomAlert('Keranjang Anda masih kosong!', () => {
                    window.location.href = "{{ route('customer.index') }}";
                });
                return;
            }

            // Populate Item Details
            let html = '';
            subtotal = 0;
            cart.forEach(item => {
                let optsText = '';
                if (item.options && Object.keys(item.options).length > 0) {
                    optsText = '<div class="flex flex-wrap gap-1.5 mt-2">';
                    Object.entries(item.options).forEach(([k, v]) => {
                        optsText += `<span class="bg-gray-50 border border-gray-100 text-[#080d1a]/70 text-[8px] font-black uppercase tracking-wider px-2 py-0.5 rounded-lg">${k}: ${v}</span>`;
                    });
                    optsText += '</div>';
                }
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;

                html += `
                    <div class="flex items-center justify-between bg-gray-50/60 border border-gray-100 rounded-3xl p-4 transition-all hover:bg-white hover:border-gray-200">
                        <div class="flex-1 pr-4 overflow-hidden">
                            <div class="flex items-center">
                                <span class="bg-blue-50 text-blue-600 border border-blue-100 px-2 py-0.5 rounded-lg text-[9px] font-black mr-2 shrink-0">${item.quantity}x</span>
                                <span class="font-black text-gray-900 uppercase tracking-tight text-[11px] truncate">${item.name}</span>
                            </div>
                            ${optsText}
                        </div>
                        <span class="font-black text-gray-900 italic text-xs shrink-0 text-right">Rp ${itemTotal.toLocaleString('id-ID')}</span>
                    </div>
                `;
            });
            document.getElementById('checkout-items-list').innerHTML = html;

            // Calculations
            tax = Math.round(subtotal * 0.11); // PPN 11% Tasik / Indonesia
            grandtotal = subtotal + tax;

            // Update UI elements
            document.getElementById('price-subtotal').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
            document.getElementById('price-tax').innerText = 'Rp ' + tax.toLocaleString('id-ID');
            document.getElementById('price-grandtotal').innerText = 'Rp ' + grandtotal.toLocaleString('id-ID');

            document.getElementById('receipt-total-items').innerText = cart.length + ' Item';
            document.getElementById('receipt-grandtotal').innerText = 'Rp ' + grandtotal.toLocaleString('id-ID');

            // Fill Customer Profile Name if available
            @if(auth()->check())
                document.getElementById('cust-name-edit').value = "{{ auth()->user()->name }}";
            @endif
        }

        // Navigate Step Slides
        function goToStep(step) {
            triggerAlert(false); // Close alert if open

            // Reset step indicators
            for (let i = 1; i <= 3; i++) {
                const badge = document.getElementById('step-badge-' + i);
                const label = document.getElementById('step-label-' + i);
                const container = document.getElementById('step-' + i + '-container');

                if (i === step) {
                    badge.className = 'step-pill active w-7 h-7 rounded-full flex items-center justify-center text-[10px] font-black tracking-tighter text-white bg-[#080d1a]';
                    label.className = 'text-[10px] font-black uppercase tracking-widest text-gray-900';
                    container.classList.remove('hidden');
                } else if (i < step) {
                    badge.className = 'step-pill w-7 h-7 bg-emerald-500 text-white rounded-full flex items-center justify-center text-[10px] font-black tracking-tighter';
                    label.className = 'text-[10px] font-bold uppercase tracking-widest text-emerald-500';
                    container.classList.add('hidden');
                } else {
                    badge.className = 'step-pill w-7 h-7 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center text-[10px] font-black tracking-tighter';
                    label.className = 'text-[10px] font-bold uppercase tracking-widest text-gray-400';
                    container.classList.add('hidden');
                }
            }
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Trigger Confirm Alert
        function triggerAlert(show) {
            const overlay = document.getElementById('confirm-alert-overlay');
            const alertBox = overlay.querySelector('div');

            if (show) {
                // Validate customer info first
                const name = document.getElementById('cust-name-edit').value;
                const table = document.getElementById('cust-table-edit').value;
                if (!name || !table) {
                    showCustomAlert('Harap isi Nama Anda dan Nomor Meja terlebih dahulu!');
                    return;
                }

                overlay.classList.remove('hidden');
                overlay.classList.add('flex');
                setTimeout(() => alertBox.classList.replace('scale-95', 'scale-100'), 10);
            } else {
                alertBox.classList.replace('scale-100', 'scale-95');
                setTimeout(() => {
                    overlay.classList.add('hidden');
                    overlay.classList.remove('flex');
                }, 150);
            }
        }

        // Download QRIS code
        function downloadQRIS() {
            const realImg = document.getElementById('qris-image-file');
            if (realImg) {
                const dl = document.getElementById('download-link');
                dl.href = realImg.src;
                dl.download = 'qris-bilabola-payment.png';
                dl.click();
            } else {
                const svg = document.getElementById('qris-svg');
                const svgString = new XMLSerializer().serializeToString(svg);
                const svgBlob = new Blob([svgString], { type: 'image/svg+xml;charset=utf-8' });
                const URL = window.URL || window.webkitURL || window;
                const blobURL = URL.createObjectURL(svgBlob);
                
                const dl = document.getElementById('download-link');
                dl.href = blobURL;
                dl.download = 'qris-bilabola-payment.svg';
                dl.click();
            }
        }

        // Check Payment Status simulation & Checkout Complete
        async function checkPaymentStatus() {
            const overlayLoader = document.getElementById('loading-overlay');
            overlayLoader.classList.remove('hidden');

            // Simulate server network delays for verification
            setTimeout(async () => {
                overlayLoader.classList.add('hidden');

                const name = document.getElementById('cust-name-edit').value;
                const table = document.getElementById('cust-table-edit').value;
                const notes = document.getElementById('order-notes').value;

                // Send the transaction to the Admin Database
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
                            total: grandtotal,
                            catatan: notes
                        })
                    });

                    const result = await response.json();

                    if (result.success) {
                        // Save to order history locally (sync with server)
                        let localHistory = JSON.parse(localStorage.getItem('order_history') || '[]');
                        localHistory.push({
                            id: result.order_id,
                            nama_pelanggan: name,
                            meja: table,
                            total: grandtotal,
                            menu_pesanan: cart,
                            catatan: notes,
                            status: 'pending',
                            timestamp: Date.now()
                        });
                        localStorage.setItem('order_history', JSON.stringify(localHistory));

                        // Clear cart
                        localStorage.removeItem('cart');

                        // Show gorgeous order complete splash screen
                        document.getElementById('success-overlay').classList.remove('hidden');
                        document.getElementById('success-overlay').classList.add('flex');

                        // Redirect to main customer menu after 500ms (smooth immediate transition)
                        setTimeout(() => {
                            window.location.href = "{{ route('customer.index') }}";
                        }, 500);

                    } else {
                        showCustomAlert('Gagal memverifikasi transaksi: ' + result.message);
                    }

                } catch (error) {
                    console.error('Checkout error:', error);
                    showCustomAlert('Gagal menghubungi server untuk mendaftarkan transaksi Anda.');
                }

            }, 2000);
        }

        // Back button navigation
        function goBackOrHome() {
            const step1 = document.getElementById('step-1-container');
            const step2 = document.getElementById('step-2-container');
            const step3 = document.getElementById('step-3-container');

            if (!step2.classList.contains('hidden')) {
                goToStep(1);
            } else if (!step3.classList.contains('hidden')) {
                goToStep(2);
            } else {
                window.location.href = "{{ route('customer.index') }}";
            }
        }

        // Run on load
        window.addEventListener('DOMContentLoaded', () => {
            initCheckout();
        });
    </script>
</body>
</html>
