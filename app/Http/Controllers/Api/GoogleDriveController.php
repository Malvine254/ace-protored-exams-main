<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DownloadLogs;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GoogleDriveController extends Controller
{
    /**
     * Get the Google Drive download link for a product associated with an order.
     *
     * @param  int  $orderId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDownloadLink($orderId, $productId)
    {
        try {
            // Fetch the order by ID
            $order = Order::findOrFail($orderId);

            if ($order->status !== 'paid') {
                return response()->json(['error' => 'Not allowed'], 400);
            }

            // Get the product from the order
            $products = $order->products;

            if (!is_array($products)) {
                return response()->json(['error' => 'Invalid products data.'], 400);
            }

            $product = collect($products)->firstWhere('product_id', $productId);


            if (!$product || empty($product['download_link'])) {
                return response()->json(['error' => 'Product or download link not found.'], 404);
            }

            // Check the download count
            $downloadCount = DownloadLogs::where('order_id', $orderId)
                ->where('product_id', $productId)
                ->count();

            if ($downloadCount >= 3) {
                return response()->json(['error' => 'Maximum download limit reached.'], 403);
            }

            $download_link = $this->fetchFile($product['download_link']);

            // Log Download
            $download_log = DownloadLogs::create([
                'product_id' => $productId,
                'order_id' => $orderId,
                'url' => $download_link
            ]);

            // Return the Google Drive download link
            // return response()->json(['download_link' => $download_link], 200);
            return redirect()->away($download_link);
        } catch (Exception $exception) {
            Log::error("Error retrieving download link: " . $exception->getMessage());

            return response()->json(['error' => 'Failed to retrieve the download link.'], 500);
        }
    }

    /**
     * Fetch a file from a publicly accessible Google Drive link and provide a download link.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchFile(string $fileUrl)
    {

        try {
            // Convert the public link to a direct download link
            if (strpos($fileUrl, 'drive.google.com') !== false) {
                $fileId = $this->extractFileId($fileUrl);
                $directDownloadUrl = "https://drive.google.com/uc?export=download&id=$fileId";
            } else {
                $directDownloadUrl = $fileUrl;
            }

            Log::info("Direct download url", ["url" => $directDownloadUrl]);

            return $directDownloadUrl;
            // // Download the file content
            // $response = Http::get($directDownloadUrl);
            // if ($response->failed()) {
            //     return response()->json(['error' => 'Failed to fetch the file.'], 400);
            // }

            // $fileContents = $response->body();
            // $fileName = uniqid('google_drive_') . '.file';
            // $filePath = 'downloads/' . $fileName;

            // // Store the file locally
            // Storage::disk('local')->put($filePath, $fileContents);

            // // Generate a temporary download URL
            // $downloadUrl = route('download.file', ['file' => $fileName]);

            // return $downloadUrl;
        } catch (Exception $exception) {
            Log::error("Error fetching file from Google Drive: " . $exception->getMessage());

            return "Error";
        }
    }

    /**
     * Serve a file for download.
     *
     * @param  string  $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile($file)
    {
        $filePath = storage_path('app/downloads/' . $file);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    /**
     * Extract the file ID from a Google Drive link.
     *
     * @param  string  $url
     * @return string|null
     */
    private function extractFileId($url)
    {
        preg_match('/d\/([a-zA-Z0-9_-]+)|id=([a-zA-Z0-9_-]+)/', $url, $matches);

        return $matches[1] ?? $matches[2] ?? null;
    }
}
