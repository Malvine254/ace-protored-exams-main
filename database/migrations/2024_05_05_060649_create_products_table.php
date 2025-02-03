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
            $table->text('description');  // Use TEXT for large descriptions
            $table->decimal('price', 8, 2);  // DECIMAL for price
            $table->string('download_link')->nullable();
            $table->string('slug');
            $table->string('type')->nullable();
            $table->text('categories')->nullable();  // Use TEXT for JSON data in SQLite
            $table->text('tags')->nullable();  // Use TEXT for JSON data in SQLite
            $table->text('images')->nullable();  // Use TEXT for JSON data in SQLite
            $table->string('cover')->nullable();
            $table->text('preview_pages')->nullable();  // Use TEXT for JSON data in SQLite
            $table->integer('preview_limit')->default(1);
            $table->integer('page_count')->nullable();
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
