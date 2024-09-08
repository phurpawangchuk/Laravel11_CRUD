<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ProductManager;
use App\Http\Livewire\StudentManager;
use App\Http\Livewire\ContactForm;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;

use App\Mail\ContactFormMail;

// Route::get('/livewire/livewire.js', function() {
//     return response()->file(public_path('livewire/livewire.js'));
// });

Route::get('/send-email', function () {
    Mail::to('phurpawangchuk20@gmail.com')->send(new ContactFormMail());

    return 'Test email sent!';
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// Route::middleware(['auth'])->group(function () {
//     Route::get('/products', ProductManager::class)->name('products');
// });

Route::get('/', [WelcomeController::class, 'welcome']);
Route::get('/about', [AboutController::class, 'about']);
Route::get('/contact', [ContactController::class, 'contact']);

Route::get('/products', ProductManager::class)->name('products');
Route::get('/students', StudentManager::class)->name('students');

// Route::get('/checkout', [PaymentController::class, 'checkoutForm'])->name('checkout.form');
// Route::post('/checkout', [PaymentController::class, 'processCheckout'])->name('checkout.process');

Route::get('/success', [PaymentController::class, 'success']);
Route::get('/checkout', [PaymentController::class, 'showCheckoutForm']);
Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent']);
Route::post('/confirm-payment', [PaymentController::class, 'confirmPayment']);
