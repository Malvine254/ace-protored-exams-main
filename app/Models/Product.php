<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'download_link',
        'slug',
        'categories',
        'tags',
        'in_stock',
        'images',
        'type',
        'discounted_from'
    ];

    protected function casts(): array
    {
        return [
            'preview_pages' => 'array',
            'tags' => 'array',
            'categories' => 'array',
            'images' => 'array'
        ];
    }
}
