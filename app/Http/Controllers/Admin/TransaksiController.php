<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::latest()->get();
        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'meja' => 'required',
            'menu_pesanan' => 'required',
            'jumlah' => 'required|numeric',
            'status' => 'required'
        ]);

        Transaksi::create($request->all());
        return redirect()->back()->with('success', 'Transaksi berhasil dicatat!');
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'status' => $request->status
        ]);
        
        $msg = $request->status == 'success' ? 'Pesanan diterima!' : 'Pesanan ditolak.';
        return redirect()->back()->with('success', $msg);
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->back()->with('success', 'Data dihapus.');
    }
}