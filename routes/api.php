<?php

use App\Http\Controllers\Api\Payments\Callbacks\TinkoffController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/contacts', [ContactsController::class, 'send'])->name('api.contacts.send');

Route::controller(CartController::class)->prefix('/merch/cart')->as('api.merch.cart.')->group(function () {
    Route::post('/add', 'add')->name('add');
    Route::post('/remove', 'remove')->name('remove');
    Route::post('/remove/all', 'removeAll')->name('removeAll');
});

// Education //
Route::post('/payments/callbacks/tinkoff', TinkoffController::class)->name('api.payments.callbacks.tinkoff');
