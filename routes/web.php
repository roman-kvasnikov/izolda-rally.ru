<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\GoalsController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MerchController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TechController;
use App\Services\Orders\Factories\OrderFactory;
use Illuminate\Support\Facades\Route;

Route::get('/input_mask', function () {
    return view('input_mask');
});

Route::get('/', IndexController::class)->name('index');
Route::get('/crew', CrewController::class)->name('crew');
Route::get('/activity', ActivityController::class)->name('activity');
Route::get('/team', TeamController::class)->name('team');
Route::get('/tech', TechController::class)->name('tech');
Route::get('/goals', GoalsController::class)->name('goals');
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');

Route::get('/merch', MerchController::class)->name('merch');

Route::prefix('/merch')->as('merch.')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');

    Route::controller(OrderController::class)->prefix('/order')->as('order.')->group(function () {
        Route::get('/create', 'create')->name('create');
        Route::get('/{order:uuid}', 'show')->name('show')->whereUuid('order');
        Route::post('/{order:uuid}/payment', 'payment')->name('payment')->whereUuid('order');
    });

    Route::controller(PaymentController::class)->prefix('/payment')->as('payment.')->group(function () {
        Route::get('/{payment:uuid}/checkout', 'checkout')->name('checkout')->whereUuid('payment');
        Route::post('/{payment:uuid}/method', 'method')->name('method')->whereUuid('payment');
        Route::get('/{payment:uuid}/process', 'process')->name('process')->whereUuid('payment');
        Route::post('/{payment:uuid}/complete', 'complete')->name('complete')->whereUuid('payment');
        Route::post('/{payment:uuid}/cancel', 'cancel')->name('cancel')->whereUuid('payment');
        Route::get('/success', 'success')->name('success');
        Route::get('/failure', 'failure')->name('failure');
    });
});

// Education //
Route::get('/order-factory', [OrderFactory::class, 'create']);

Route::get('/currency/{currency}', CurrencyController::class)->name('currency'); // Установка валюты

Route::get('/orders', [OrderController::class, 'index'])->name('orders'); // Список ордеров
Route::get('/orders/{order:uuid}', [OrderController::class, 'show'])->name('orders.show')->whereUuid('order'); // Просмотр ордера
Route::post('/orders/{order:uuid}/payment', [OrderController::class, 'payment'])->name('orders.payment')->whereUuid('order'); // Создается пеймент и переносится на страницу оплаты

Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions');
Route::get('/subscriptions/create', [SubscriptionController::class, 'create'])->name('subscriptions.create');
Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');
Route::get('/subscriptions/{subscription:uuid}', [SubscriptionController::class, 'show'])->name('subscriptions.show')->whereUuid('subscription');
Route::post('/subscriptions/{subscription:uuid}', [SubscriptionController::class, 'payment'])->name('subscriptions.payment')->whereUuid('subscription');

Route::get('/payments/{payment:uuid}/checkout', [PaymentController::class, 'checkout'])->name('payments.checkout')->whereUuid('payment');
Route::post('/payments/{payment:uuid}/method', [PaymentController::class, 'method'])->name('payments.method')->whereUuid('payment');
Route::get('/payments/{payment:uuid}/process', [PaymentController::class, 'process'])->name('payments.process')->whereUuid('payment');
Route::post('/payments/{payment:uuid}/complete', [PaymentController::class, 'complete'])->name('payments.complete')->whereUuid('payment');
Route::post('/payments/{payment:uuid}/cancel', [PaymentController::class, 'cancel'])->name('payments.cancel')->whereUuid('payment');
Route::get('/payments/success', [PaymentController::class, 'success'])->name('payments.success');
Route::get('/payments/failure', [PaymentController::class, 'failure'])->name('payments.failure');
