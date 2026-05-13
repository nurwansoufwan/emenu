<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Food; // Sudah benar menggunakan model Food
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema; // Ditambahkan untuk pengecekan tabel

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman utama laporan dengan data statistik
     */
    public function index()
    {
        // Proteksi: Cek apakah tabel 'transaksis' sudah ada di DB agar tidak error 500
        $totalUangMasuk = 0;
        $totalUangKeluar = 0;

        if (Schema::hasTable('transaksis')) {
            // Ambil data uang masuk dari transaksi yang sukses
            $totalUangMasuk = Transaksi::where('status', 'success')->sum('jumlah');
            // Menghitung uang keluar (misal dari transaksi gagal/refund)
            $totalUangKeluar = Transaksi::where('status', 'failed')->sum('jumlah');
        }

        // Ambil data produk terbaru menggunakan model Food
        $topProducts = Food::orderBy('id', 'desc')->take(5)->get();

        $laporans = Laporan::orderBy('periode', 'desc')->get();

        return view('admin.laporan.index', compact(
            'laporans',
            'totalUangMasuk',
            'totalUangKeluar',
            'topProducts'
        ));
    }

    /**
     * Menampilkan semua produk terjual secara lengkap (Fix error Undefined type Product)
     */
    public function allProducts(Request $request)
    {
        $search = $request->input('search');

        // Pastikan memanggil model Food, bukan Product
        $products = Food::when($search, function ($query) use ($search) {
            return $query->where('nama', 'like', '%' . $search . '%');
        })->paginate(10); 

        // Return ke view yang benar sesuai file Anda
        return view('admin.laporan.all_products', compact('products', 'search'));
    }

    public function create()
    {
        return view('admin.laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'periode' => 'required',
            'pendapatan' => 'required|numeric',
            'total_pesanan' => 'required|integer',
            'status' => 'required',
        ]);

        Laporan::create($request->all());

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('admin.laporan.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pendapatan' => 'required|numeric',
            'total_pesanan' => 'required|integer',
            'status' => 'required',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update($request->all());

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }
}