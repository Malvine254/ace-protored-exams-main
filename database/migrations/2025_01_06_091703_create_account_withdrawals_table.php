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
        Schema::create('account_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('total_amount', 8, 2);
            $table->float('starting_balance', 8, 2);
            $table->float('ending_balance', 8, 2);
            $table->string('notes')->nullable();
            $table->boolean('cleared')->default(false);
            $table->timestamp('cleared_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_withdrawals');
    }
};
