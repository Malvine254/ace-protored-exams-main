<?php

use App\Http\Controllers\Api\GoogleDriveController;
use App\Http\Controllers\Api\ImageUploadController;
use App\Http\Controllers\CheckoutController;
use App\Livewire\Admin\AllOrders;
use App\Livewire\Admin\AllProducts;
use App\Livewire\Admin\AllSchools;
use App\Livewire\Admin\AllUsers;
use App\Livewire\Admin\EditProduct;
use App\Livewire\Admin\EditSchool;
use App\Livewire\Admin\FinancialDashboard;
use App\Livewire\Admin\OrderDetails;
use App\Livewire\Admin\UserDetails;
use App\Livewire\Checkout\CartPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrders;
use App\Livewire\OrderSuccessfulPage;
use App\Livewire\Shop\Categories;
use App\Livewire\Shop\PopularProductsPage;
use App\Livewire\Shop\ProductPage;
use App\Livewire\Shop\ProductsByCategory;
use App\Livewire\Shop\SearchResults;
use App\Livewire\Shop\ShopPage;
use App\Livewire\Shop\Universities;
use App\Livewire\Shop\UniversityBooks;
use Illuminate\Support\Facades\Route;

// Home apage
Route::get('/', HomePage::class)->name('home');

// Shop Pages
Route::get('/shop', ShopPage::class)->name('shop');
Route::get('/shop/popular', PopularProductsPage::class)->name('shop.popular');
Route::get('/shop/categories', Categories::class)->name('shop.categories');
Route::get('/shop/search', SearchResults::class)->name('shop.search');
Route::get('/tags/{id}', ProductsByCategory::class)->name('shop.tags');
Route::get('/products/{slug}', ProductPage::class)->name('shop.product');
Route::get('/school', Universities::class)->name('universities');
Route::get('/school/{country}/{state}/{university}', UniversityBooks::class)->name('universities.books');

// Checkout
Route::get('/cart', CartPage::class)->name('cart');

Route::get('/checkout', [CheckoutController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/process-payment', [CheckoutController::class, 'processPayment'])->name('process.payment');
Route::get('/payment/success', [CheckoutController::class, 'stripeCheckoutSuccess'])->name('payment.success');
Route::get('/payment/paypal/{id}', [CheckoutController::class, 'completePaypalPayment'])->name('payment.paypal');
Route::post('/payment/paypal/create-order', [CheckoutController::class, 'paypalPayment'])->name('payment.paypal.create-order');
Route::post('/payment/paypal/success', [CheckoutController::class, 'paypalCheckoutSuccess'])->name('payment.paypal.success');
Route::get('/orders/{id}', OrderSuccessfulPage::class)->name('order.success');
Route::view('/order-complete', 'payment.success')->name('order.complete');

Route::get('/payment/failure', function () {
    return view('payment.failure');
})->name('payment.failure');

Route::get('/blog', CartPage::class)->name('blog');

// Info pages
Route::view('/faq', 'faqs')->name('faqs');
Route::view('/about-us', 'about')->name('about');
Route::view('/request', 'request-product')->name('request-product');
Route::view('/contact-us', 'contact-us')->name('contact-us');
Route::view('/terms/refund-policy', 'refund-policy')->name('terms.refund-policy');

// Image Upload
Route::post('upload-image', [ImageUploadController::class, 'upload']);

// download
Route::get('/orders/{orderId}/products/{productId}/download-link', [GoogleDriveController::class, 'getDownloadLink'])->name('download.link');

// Auth Pages
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', MyOrders::class)->name('dashboard');

    //admin
    Route::get('/admin/orders', AllOrders::class)->name('admin.orders');
    Route::get('/admin/orders/{id}', OrderDetails::class)->name('admin.orders.details');
    Route::get('/admin/financials', FinancialDashboard::class)->name('admin.financials');
    Route::get('/admin/users', AllUsers::class)->name('admin.users');
    Route::get('/admin/users/{id}', UserDetails::class)->name('admin.users.details');
    Route::get('/admin/products', AllProducts::class)->name('admin.products');
    Route::get('/admin/products/{id}', EditProduct::class)->name('admin.products.edit');
    Route::get('/admin/schools', AllSchools::class)->name('admin.schools');
    Route::get('/admin/schools/{id}', EditSchool::class)->name('admin.schools.edit');
});
