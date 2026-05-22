<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['nama_pelanggan', 'meja', 'menu_pesanan', 'jumlah', 'status', 'tanggal_transaksi', 'catatan'];

    protected $casts = [
        'menu_pesanan' => 'array',
    ];
}
