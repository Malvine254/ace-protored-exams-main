<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display all products.
     * 
     * @response array{data: array{Product},"current_page": 1,"next_page_url": null,"total": 4}
     * @unauthenticated
     */
    public function index(Request $request)
    {
        $data = Product::paginate(request()->all());
        return response($data, 200);
    }

    /**
     * Create product
     * 
     * @response array{status:'success',data: Product}
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'cover' => 'required|string',
            'download_link' => 'nullable|string',
            'slug' => 'required|string',
            'page_count' => 'nullable|integer',
            'preview_limit' => 'nullable|integer',
            'preview_pages' => 'nullable|array',
            'categories' => 'nullable|array',
            'tags' => 'nullable|array',
            'in_stock' => 'required|boolean',
            'sample_link' => 'nullable|string',
        ]);

        $data_to_save = $request->all();

        $product = Product::create($data_to_save);

        $res = [
            'status' => 'success',
            'data' => $product
        ];

        return response($res);
    }

    /**
     * Find and return a product by id
     * 
     * @param string $id unique id of the ad
     * 
     * @response Product
     * @unauthenticated
     */
    public function show(string $id)
    {
        return Product::find($id);
    }

    /**
     * Update a product item by id
     * 
     * @param string $id The unique id of the ad resource
     * 
     * @response array{'status':'success', data: Product}
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'cover' => 'required|string',
            'download_link' => 'nullable|string',
            'slug' => 'required|string',
            'page_count' => 'nullable|integer',
            'preview_limit' => 'nullable|integer',
            'preview_pages' => 'nullable|array',
            'categories' => 'nullable|array',
            'tags' => 'nullable|array',
            'in_stock' => 'required|boolean',
            'sample_link' => 'nullable|string',
        ]);

        $product = Product::find($id);
        $product->update($request->all());

        return $product;
    }

    /**
     * Delete Product
     * 
     * @param string $id The unique id of the product resource
     * 
     * @response array{'status':'success', message: 'Deleted'}
     */
    public function destroy(string $id)
    {
        return Product::destroy($id);
    }

    /**
     * Search
     * 
     * Search for a specific ad by a query string.
     * 
     * @response array{data: array{Product}}
     * @unauthenticated
     */
    public function search(Request $request)
    {
        Validator::make($request->all(), [
            // This is a search string to filter ads by.
            'search' => 'string',

        ]);

        $search = $request->query('search');

        return Product::where('name', 'like', '%' . $search . '%')->paginate();
    }
}
