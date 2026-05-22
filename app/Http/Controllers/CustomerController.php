<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Category;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function welcomeRedirect()
    {
        // Clear any existing customer/guest sessions to start fresh
        Auth::logout();
        session()->forget(['customer_guest', 'customer_logged_in']);

        return redirect()->route('customer.login');
    }

    public function index(Request $request)
    {
        // Redirect to login if neither logged in nor guest session is active
        if (!Auth::check() && !session()->has('customer_guest')) {
            return redirect()->route('customer.login');
        }

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
        if (!Auth::check() && !session()->has('customer_guest')) {
            return redirect()->route('customer.login');
        }

        $food->load('category');
        return view('customer.show', compact('food'));
    }

    // Customer Checkout Page
    public function checkoutForm()
    {
        if (!Auth::check() && !session()->has('customer_guest')) {
            return redirect()->route('customer.login');
        }
        return view('customer.checkout');
    }

    // Customer Login Page
    public function loginForm()
    {
        if (Auth::check() || session()->has('customer_guest')) {
            return redirect()->route('customer.index');
        }
        return view('customer.login');
    }

    // Process Customer Passwordless Login via Email
    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|string',
        ]);

        // Find customer with matching email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Automatically log in the user (remember-me is active by default for convenience)
            Auth::login($user, true);
            session()->forget('customer_guest');
            session()->put('customer_logged_in', true);
            return redirect()->route('customer.index')->with('success', 'Selamat datang kembali!');
        }

        return back()->withErrors([
            'email' => 'Email belum terdaftar. Silakan gunakan tab Daftar untuk mendaftarkan email Anda terlebih dahulu.'
        ])->withInput();
    }

    // Process Guest Login
    public function guestSubmit()
    {
        Auth::logout();
        session()->forget('customer_logged_in');
        session()->put('customer_guest', true);
        return redirect()->route('customer.index')->with('success', 'Masuk sebagai Guest!');
    }

    // Customer Registration Form redirect
    public function registerForm()
    {
        return redirect()->route('customer.login', ['tab' => 'register']);
    }

    // Process Customer Registration (Manual login required after registration)
    public function registerSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        // Create new user with customer role and a dummy secure password
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(Str::random(16)),
            'role' => 'customer',
        ]);

        // Return back to login with success message so they can now sign in using their registered email
        return redirect()->route('customer.login')->with([
            'registered_email' => $request->email,
            'success' => 'Registrasi berhasil! Email Anda telah terdaftar dan aktif. Silakan klik "Masuk Sekarang" untuk melanjutkan.'
        ]);
    }

    // Customer Logout
    public function logout()
    {
        Auth::logout();
        session()->forget(['customer_guest', 'customer_logged_in']);
        return redirect()->route('customer.login')->with('success', 'Berhasil keluar.');
    }

    // Fetch past transactions/history for active customer
    public function history()
    {
        $transactions = collect();
        if (Auth::check()) {
            $transactions = Transaksi::where('nama_pelanggan', Auth::user()->name)
                                     ->latest()
                                     ->get();
        }
        return response()->json($transactions);
    }
}
