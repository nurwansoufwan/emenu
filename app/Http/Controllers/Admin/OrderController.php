<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Transaksi::latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Transaksi $order)
    {
        $request->validate(['status' => 'required|in:pending,success,failed']);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Status pesanan diperbarui!');
    }

    public function destroy(Transaksi $order)
    {
        $order->delete();
        return back()->with('success', 'Pesanan dihapus!');
    }
}
