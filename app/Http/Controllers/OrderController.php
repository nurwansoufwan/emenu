<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        // Validasi input dari form menu konsumen
        $request->validate([
            'nama_pelanggan' => 'required',
            'menu_pesanan' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        // Simpan ke tabel transaksis agar muncul di admin
        Transaksi::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'menu_pesanan' => $request->menu_pesanan,
            'jumlah' => $request->jumlah,
            'status' => 'pending', // Default agar admin bisa proses
        ]);

        return back()->with('success', 'Pesanan berhasil dikirim! Mohon tunggu.');
    }
}
