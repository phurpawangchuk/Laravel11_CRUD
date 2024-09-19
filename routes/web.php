<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\ProductManager;
use App\Http\Livewire\StudentManager;
use App\Http\Livewire\PostManager;
use App\Http\Livewire\ContactForm;
use App\Http\Livewire\CustomerManager;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerController;

use App\Mail\ContactFormMail;

Route::get('/send-email', function () {
    Mail::to('phurpawangchuk20@gmail.com')->send(new ContactFormMail());

    return 'Test email sent!';
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});

Route::middleware(['auth'])->group(function () {
    // Route::get('/products', ProductManager::class)->name('products');
    Route::get('/customers', CustomerManager::class)->name('customers');
});

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');

Route::get('/products', ProductManager::class)->name('products');
Route::get('/students', StudentManager::class)->name('students');
Route::get('/posts', PostManager::class)->name('posts');

// Route::get('/checkout', [PaymentController::class, 'checkoutForm'])->name('checkout.form');
// Route::post('/checkout', [PaymentController::class, 'processCheckout'])->name('checkout.process');

Route::get('/success', [PaymentController::class, 'success']);
Route::get('/checkout', [PaymentController::class, 'showCheckoutForm']);
Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);
Route::post('/confirm-payment', [PaymentController::class, 'confirmPayment']);

Route::post('/query', [CustomerController::class, 'handleQuery']);
Route::get('/query', [CustomerController::class, 'handleQuery']);