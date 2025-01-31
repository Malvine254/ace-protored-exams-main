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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('description');
            $table->float('price', 6, 2);
            $table->string('download_link')->nullable();
            $table->string('slug');
            $table->string('type')->nullable();
            $table->json('categories')->nullable();
            $table->json('tags')->nullable();
            $table->json('images')->nullable();
            $table->string('cover')->nullable();  // ✅ Added Cover Column
            $table->json('preview_pages')->nullable();  // ✅ Added Preview Pages Column
            $table->integer('preview_limit')->default(1);  // ✅ Added Preview Limit Column
            $table->integer('page_count')->nullable();  // ✅ Added Page Count Column
            $table->boolean('in_stock')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
