<?php

namespace App\Models; // Harus persis seperti ini

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = 'food';
    protected $fillable = ['name', 'description', 'price', 'is_available', 'category_id', 'image', 'options'];

    protected $casts = [
        'options' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}