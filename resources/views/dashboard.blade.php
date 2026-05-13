<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Orders</h1>
            <div class="flex space-x-3">
                <button class="flex items-center px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm font-medium hover:bg-gray-50">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    Import
                </button>
                <button class="flex items-center px-4 py-2 bg-black text-white rounded-lg text-sm font-medium hover:bg-gray-800">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    Export
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm col-span-1 md:col-span-1">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">Receipt of Goods</p>
                <div class="relative flex flex-col items-center justify-center py-4">
                    <div class="text-3xl font-bold text-gray-900">$2.2m</div>
                    <p class="text-sm text-gray-500 font-medium">242 orders</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm col-span-1 md:col-span-1">
                <div class="flex justify-between items-center mb-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Orders Status</p>
                    <span class="text-xs text-gray-400 flex items-center">Active <svg class="w-3 h-3 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"></path></svg></span>
                </div>
                <div class="space-y-4">
                    <div class="h-2 w-full bg-gray-100 rounded-full overflow-hidden flex">
                        <div class="bg-green-500 h-full" style="width: 89%"></div>
                        <div class="bg-red-400 h-full" style="width: 8%"></div>
                        <div class="bg-gray-300 h-full" style="width: 3%"></div>
                    </div>
                    <div class="flex justify-between text-xs font-medium">
                        <span class="flex items-center"><div class="w-2 h-2 rounded-full bg-green-500 mr-2"></div> Paid 89%</span>
                        <span class="flex items-center"><div class="w-2 h-2 rounded-full bg-red-400 mr-2"></div> Cancelled 8%</span>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm col-span-1 md:col-span-1">
                <div class="flex justify-between items-center mb-6">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Overview</p>
                    <span class="text-xs text-gray-400">This month</span>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xl font-bold text-gray-900">$2,246.75</p>
                        <p class="text-[10px] text-gray-400 uppercase">Average order</p>
                    </div>
                    <div>
                        <p class="text-xl font-bold text-gray-900">$2.2m</p>
                        <p class="text-[10px] text-gray-400 uppercase">Total revenue</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm col-span-1 md:col-span-1">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Top Sellers</p>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gray-100 rounded-lg"></div>
                    <div>
                        <p class="text-xs font-bold text-gray-900 leading-tight">Gasoline generator EYG...</p>
                        <p class="text-[10px] text-gray-400">14 units sold</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>