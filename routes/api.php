<?php

use App\Http\Controllers\ContactsController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\Api\Payments\Callbacks\TinkoffController;

use Illuminate\Support\Facades\Route;


Route::post('/contacts', [ContactsController::class, 'send'])->name('api.contacts.send');

Route::controller(CartController::class)
	->prefix('/merches/cart')
	->as('api.merches.cart.')
	->group(function () {
		Route::post('/add', 'add')->name('add');
		Route::post('/remove', 'remove')->name('remove');
	});

Route::controller(OrderController::class)
	->prefix('/merches/orders')
	->as('api.merches.orders.')
	->group(function () {
		Route::post('/{order:uuid}/payment', 'payment')->name('payment')->whereUuid('order');
	});

Route::controller(PaymentController::class)
	->prefix('/merches/payments')
	->as('api.merches.payments.')
	->group(function () {
		Route::post('/{payment:uuid}/method', 'method')->name('method')->whereUuid('payment');
	});

Route::post('/payments/callbacks/tinkoff', TinkoffController::class)->name('api.payments.callbacks.tinkoff');
