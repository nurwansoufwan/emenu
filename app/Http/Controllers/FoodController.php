<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;


class FoodController extends Controller
{
    // Tampilan untuk User (Scan QR)
    public function index() {
        $menus = Food::all();
        return view('welcome', compact('menus'));
    }

    // Tampilan Tabel Admin
    public function adminIndex() {
        $menus = Food::all();
        return view('admin.food.index', compact('menus'));
    }

    // Form Tambah Menu
    public function create() {
        return view('admin.food.create');
    }

    // Simpan Menu Baru
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required'
        ]);

        Food::create($request->all());
        return redirect()->route('admin.food.index')->with('success', 'Menu berhasil ditambah!');
    }

    // Hapus Menu
    public function destroy(Food $food) {
        $food->delete();
        return redirect()->route('admin.food.index')->with('success', 'Menu dihapus!');
    }

    // Form Edit Menu
    public function edit(Food $food) {
        return view('admin.food.edit', compact('food'));
    }

    // Proses Update Menu
    public function update(Request $request, Food $food) {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required'
        ]);

        $food->update($request->all());
        return redirect()->route('admin.food.index')->with('success', 'Menu berhasil diupdate!');
    }
}
