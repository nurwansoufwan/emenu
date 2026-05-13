<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Food::with('category');

        // Search logic
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Category filter
        if ($request->has('category') && $request->category != 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        $foods = $query->orderBy('is_available', 'desc')->get();
        $categories = Category::all();

        return view('customer.index', compact('foods', 'categories'));
    }

    public function show(Food $food)
    {
        $food->load('category');
        return view('customer.show', compact('food'));
    }
}
