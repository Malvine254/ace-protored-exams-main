<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'description',
        'country',
        'state_province',
        'courses'
    ];

    protected function casts(): array
    {
        return [
            'courses' => 'array',
        ];
    }
}
