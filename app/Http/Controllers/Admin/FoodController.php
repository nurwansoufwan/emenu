<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::with('category')->get();
        $categories = Category::all();
        return view('admin.food.index', compact('foods', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'options' => 'nullable|array'
        ]);

        $data = $request->all();
        $data['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menu', 'public');
        }

        $data['options'] = $request->options ?? [];

        Food::create($data);
        return back()->with('success', 'Menu berhasil ditambahkan!');
    }

    public function update(Request $request, Food $food)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'options' => 'nullable|array'
        ]);

        $data = $request->all();
        $data['is_available'] = $request->has('is_available');

        if ($request->hasFile('image')) {
            if ($food->image) {
                Storage::disk('public')->delete($food->image);
            }
            $data['image'] = $request->file('image')->store('menu', 'public');
        }

        $data['options'] = $request->options ?? [];

        $food->update($data);
        return back()->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Food $food)
    {
        if ($food->image) {
            Storage::disk('public')->delete($food->image);
        }
        $food->delete();
        return back()->with('success', 'Menu berhasil dihapus!');
    }
}
