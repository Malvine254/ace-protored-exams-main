<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductsController extends Controller
{
    public function getProducts(Request $request)
    {
        // Check if the access_key is provided and valid
        if ($request->query('access_key') !== 'QrF8aWW86ykW5JL') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Generate and return the CSV as a downloadable file
        $response = new StreamedResponse(function () {
            // Open output stream
            $handle = fopen('php://output', 'w');

            // Add CSV header
            fputcsv($handle, ['Name', 'Download URL']);

            // Fetch all products with only name and download_url fields
            $products = Product::select('name', 'download_link')->get();

            // Add each product to the CSV
            foreach ($products as $product) {
                fputcsv($handle, [$product->name, $product->download_link]);
            }

            // Close output stream
            fclose($handle);
        });

        // Set headers for the response
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="products.csv"');

        return $response;
    }
}
