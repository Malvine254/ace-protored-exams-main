<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'payment_method',
        'stripe_id',
        'paypal_order_id',
        'stripe_checkout_url',
        'paid_at',
        'source',
        'customer_name',
        'customer_email',
        'email_sent',
        'user_id',
        'total_amount',
        'products',
    ];

    protected function casts(): array
    {
        return [
            'products' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
