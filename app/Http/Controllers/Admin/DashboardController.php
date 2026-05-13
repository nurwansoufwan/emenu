<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Transaksi;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Transaksi::count();
        $totalRevenue = Transaksi::where('status', 'success')->sum('jumlah');
        $totalMenu = Food::count();
        $totalAdmin = User::count();

        // Ambil pesanan terbaru untuk ringkasan
        $recentOrders = Transaksi::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders', 
            'totalRevenue', 
            'totalMenu', 
            'totalAdmin',
            'recentOrders'
        ));
    }
}
