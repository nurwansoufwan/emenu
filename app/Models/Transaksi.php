<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['nama_pelanggan', 'menu_pesanan', 'jumlah', 'status', 'tanggal_transaksi'];

    protected $casts = [
        'menu_pesanan' => 'array', // Jika kita simpan JSON, Laravel akan otomatis cast
    ];
}
