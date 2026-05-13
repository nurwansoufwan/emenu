<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak jamak (optional)
    protected $table = 'laporans';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'periode',
        'pendapatan',
        'total_pesanan',
        'status',
        'catatan',
    ];
}