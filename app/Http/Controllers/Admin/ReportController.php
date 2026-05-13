<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $totalSales = Transaksi::where('status', 'success')->sum('jumlah');
        $orderCount = Transaksi::count();
        $successfulOrders = Transaksi::where('status', 'success')->count();
        
        // Data untuk grafik sederhana atau tabel ringkasan
        $dailySales = Transaksi::where('status', 'success')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(jumlah) as total'))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(7)
            ->get();

        return view('admin.reports.index', compact(
            'totalSales',
            'orderCount',
            'successfulOrders',
            'dailySales'
        ));
    }
}
