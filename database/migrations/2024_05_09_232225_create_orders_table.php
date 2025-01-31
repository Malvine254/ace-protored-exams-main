<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('status');
            $table->string('payment_method');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('stripe_checkout_url')->nullable();
            $table->date('paid_at')->nullable();
            $table->string('source');
            $table->boolean('email_sent')->default(false);
            $table->foreignId('user_id')->nullable();
            $table->decimal('total_amount', 8, 2);
            $table->json('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
