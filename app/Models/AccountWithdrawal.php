<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountWithdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'cleared',
        'cleared_at',
        'total_amount',
        'notes',
        'starting_balance',
        'ending_balance',
    ];
}
