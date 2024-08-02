<?php

use App\Http\Controllers\LivestockController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\RFIDTagController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/







Route::controller(RFIDTagController::class)->group(function () {
    Route::get('/get-csrf-token', 'getCsrfToken')
        ->name('get.csrf.token')->middleware(['auth', 'verified']);
    Route::get('/rfid-tags', 'show')
        ->name('rfid.tag')->middleware(['auth', 'verified']);

    Route::get('/history-rfid', 'history')
        ->name('rfid.history')->middleware(['auth', 'verified']);
    Route::get('/test', 'test');

    // Route::get('/get-csrf-token', 'getCsrfToken');
});


Route::controller(UserController::class)->group(function () {

    Route::get('/', 'index')
        ->name('home')->middleware(['auth', 'verified']);
    Route::get('/login', 'login')
        ->name('login')->middleware('guest');
    Route::get('/register', 'register')
        ->name('register')->middleware('guest');
    Route::post('/logout', 'logout')
        ->name('logout')->middleware(['auth', 'verified']);

    Route::post('/store', 'store')
        ->name('register.store');
    Route::post('/addUser', 'addUserAdmin')
        ->name('add.user')->middleware(['auth', 'verified']);
    Route::post('/process', 'process')
        ->name('login.process');

    Route::get('/user', 'userManagement')
        ->name('user.management')
        ->middleware(['auth', 'verified']);
    Route::get('/user/search', 'search')
        ->name('user.search')->middleware(['auth', 'verified']);
    Route::delete('/user/{user}', 'destroy')
        ->name('user.delete')->middleware(['auth', 'verified']);
    Route::put('/user/update', 'update')
        ->name('user.update')->middleware(['auth', 'verified']);
});

Route::controller(LivestockController::class)->group(function () {
    Route::get('/herd', 'myHerd')
        ->name('livestock.my.herd')->middleware(['auth', 'verified']);
    Route::get('/herd/add', 'addHerd')
        ->name('livestock.add.herd')->middleware(['auth', 'verified']);
    Route::delete('/herd/{herd}', 'destroy')
        ->name('livestock.delete')->middleware(['auth', 'verified']);
    Route::get('/herd/search', 'search')
        ->name('livestock.search')->middleware(['auth', 'verified']);

    Route::get('/herd/edit', 'edit')
        ->name('livestock.edit')->middleware(['auth', 'verified']);

    Route::post('/herd/add/store', 'store')
        ->name('livestock.store')->middleware(['auth', 'verified']);
    Route::put('/herd/status', 'status')
        ->name('livestock.status')->middleware(['auth', 'verified']);

    Route::get('/rfid', 'rfid')
        ->name('livestock.rfid')->middleware(['auth', 'verified']);
    Route::get('/schedule', 'schedule')
        ->name('livestock.schedule')->middleware(['auth', 'verified']);

    Route::post('herd/breed/add', 'addBreed')
        ->name('livestock.breed.add')->middleware(['auth', 'verified']);
    Route::post('herd/breed/edit', 'editBreed')
        ->name('livestock.breed.edit')->middleware(['auth', 'verified']);
    Route::delete('herd/breed/delete/{breed}', 'deleteBreed')
        ->name('livestock.breed.delete')->middleware(['auth', 'verified']);

    Route::post('herd/milk/add', 'addMilk')
        ->name('livestock.milk.add')->middleware(['auth', 'verified']);
    Route::post('herd/milk/edit', 'editMilk')
        ->name('livestock.milk.edit')->middleware(['auth', 'verified']);
    Route::delete('herd/milk/delete', 'deleteMilk')
        ->name('livestock.milk.delete')->middleware(['auth', 'verified']);

    Route::post('herd/milk/add/today', 'addMilkToday')
        ->name('livestock.milk.add.today')->middleware(['auth', 'verified']);



    Route::post('herd/edit/store', 'herdEdit')
        ->name('livestock.herd.edit')->middleware(['auth', 'verified']);

    Route::post('herd/progress/edit', 'progressEdit')
        ->name('livestock.progress.edit')->middleware(['auth', 'verified']);
    Route::post('herd/progress/store', 'progressStore')
        ->name('livestock.progress.store')->middleware(['auth', 'verified']);

    Route::get('herd/establishment/add', 'addEstablishment')
        ->name('add.forage.establishment')->middleware(['auth', 'verified']);
    Route::post('herd/establishment/store', 'storeEstablishment')
        ->name('store.forage.establishment')->middleware(['auth', 'verified']);

    Route::get('herd/establishment/edit', 'editEstablishment')
        ->name('edit.forage.establishment')->middleware(['auth', 'verified']);
    Route::post('herd/establishment/update', 'updateEstablishment')
        ->name('update.forage.establishment')->middleware(['auth', 'verified']);
    Route::post('herd/establishment/delete', 'deleteEstablishment')
        ->name('delete.forage.establishment')->middleware(['auth', 'verified']);

    Route::post('herd/forage/store', 'storeForage')
        ->name('store.forage')->middleware(['auth', 'verified']);
    Route::delete('herd/forage/delete', 'deleteForage')
        ->name('delete.forage')->middleware(['auth', 'verified']);
    Route::post('herd/forage/edit', 'editForage')
        ->name('edit.forage')->middleware(['auth', 'verified']);

    Route::post('/ajax', 'ajax')
        ->name('ajax')->middleware(['auth', 'verified']);

    Route::post('/milkAjax', 'milkAjax')
        ->name('milk.ajax')->middleware(['auth', 'verified']);

    Route::post('/progressAjax', 'progressAjax')
        ->name('progress.ajax')->middleware(['auth', 'verified']);

    Route::get('/generate-report', 'generateReport')
        ->name('generate.report')->middleware(['auth', 'verified']);

    Route::get('/finance', 'showFinance')
        ->name('finance')->middleware(['auth', 'verified']);


    Route::get('/batch', 'showBatch')
        ->name('livestock.batch')->middleware(['auth', 'verified']);
    Route::post('/batch/weight/store', 'batchWeightStore')
        ->name('livestock.batch.weight.store')->middleware(['auth', 'verified']);
    Route::post('/batch/milk/store', 'batchMilkStore')
        ->name('livestock.batch.milk.store')->middleware(['auth', 'verified']);
    Route::post('/batch/forage/store', 'batchForageStore')
        ->name('livestock.batch.forage.store')->middleware(['auth', 'verified']);
    Route::post('/batch/buyer/store', 'batchBuyerStore')
        ->name('livestock.batch.buyer.store')->middleware(['auth', 'verified']);
    Route::post('/batch/health/store', 'batchHealthStore')
        ->name('livestock.batch.health.store')->middleware(['auth', 'verified']);
    Route::post('/batch/death/store', 'batchDeathStore')
        ->name('livestock.batch.death.store')->middleware(['auth', 'verified']);

    Route::post('/ajaxDisease', 'getDisease')
        ->name('ajax.disease')->middleware(['auth', 'verified']);
    Route::post('/updateDisease', 'updateDisease')
        ->name('update.disease')->middleware(['auth', 'verified']);
    Route::post('/updateSched', 'updateSched')
        ->name('update.sched')->middleware(['auth', 'verified']);
    Route::post('/RFID-AJAX', 'RFIDAJAX')
        ->name('RFID.AJAX')->middleware(['auth', 'verified']);

    Route::post('/OPEN-RFID', 'openApp')
        ->name('OPEN.RFID')->middleware(['auth', 'verified']);
});

Route::controller(PasswordResetController::class)->group(function () {
    Route::get('/forgot', 'forgotPassword')
        ->name("forgot.password")->middleware('guest');
    Route::post('/forgot', 'forgotPasswordPost')
        ->name("forgot.password.post")->middleware('guest');
    Route::get('/reset/{token}', 'resetPassword')
        ->name("reset.password")->middleware('guest');
    Route::post('/reset', 'resetPasswordPost')
        ->name("reset.password.post")->middleware('guest');
});


Route::controller(VerificationController::class)->group(function () {
    Route::get('/email/verify/{id}/{hash}', 'verify')
        ->name('verification.verify');
    Route::get('/email/resend', 'resend')
        ->name('verification.resend');
});
