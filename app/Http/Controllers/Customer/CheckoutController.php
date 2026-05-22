<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_pelanggan' => 'required|string|max:255',
                'meja' => 'required|string|max:10',
                'cart' => 'required|array',
                'total' => 'required|numeric',
                'catatan' => 'nullable|string'
            ]);

            $transaksi = Transaksi::create([
                'nama_pelanggan' => $request->nama_pelanggan,
                'meja' => $request->meja,
                'menu_pesanan' => $request->cart,
                'jumlah' => $request->total,
                'catatan' => $request->catatan,
                'status' => 'pending',
                'tanggal_transaksi' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dikirim! Silakan tunggu konfirmasi admin.',
                'order_id' => $transaksi->id
            ]);

        } catch (\Exception $e) {
            Log::error('Checkout Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses pesanan.'
            ], 500);
        }
    }
}
