<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;



class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/json/products.json');

        $posts = collect(json_decode($json));

        $posts->each(function ($post) {
            Product::insert([
                "name" => $post->title,
                "slug" => $post->id,
                "description" => $post->description,
                "cover" => $post->cover,
                "preview_pages" => json_encode($post->preview_pages),
                "preview_limit" => $post->preview_limit,
                "in_stock" => true,
                "page_count" => $post->page_count,
                "price" => $post->price,
                "tags" => json_encode($post->tags),
                "categories" => json_encode($post->categories),
                "download_link" => $post->download_link,
            ]);
        });
    }
}
