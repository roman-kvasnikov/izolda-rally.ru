<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = ['name', 'description', 'image', 'price', 'quantity', 'is_published'];

    // protected $guarded = [];
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'image' => 'string',
        'price' => 'float',
        'quantity' => 'integer',
        'is_published' => 'boolean',
    ];

    protected $dates = ['created_at', 'updated_at'];
}
