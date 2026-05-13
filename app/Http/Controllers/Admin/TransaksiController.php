<?php

namespace App\Http\Controllers\Admin; // Namespace harus menunjuk ke folder Admin

use App\Http\Controllers\Controller; // Wajib diimport karena folder berbeda
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        // Mengambil data terbaru agar pesanan baru muncul di atas
        $transaksis = Transaksi::latest()->get();
        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'menu_pesanan' => 'required', // Tambahkan ini agar sinkron dengan tabel
            'jumlah' => 'required|numeric',
            'status' => 'required'
        ]);

        Transaksi::create($request->all());
        return redirect()->back()->with('success', 'Transaksi berhasil dicatat!');
    }

    // Tambahkan fungsi Update untuk memproses pesanan (Tombol PROSES)
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'status' => $request->status // Mengubah 'pending' menjadi 'success'
        ]);
        
        return redirect()->back()->with('success', 'Pesanan berhasil diproses!');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->back()->with('success', 'Data dihapus.');
    }
}