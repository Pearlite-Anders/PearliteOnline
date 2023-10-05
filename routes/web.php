<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

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

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/companies', \App\Livewire\Company\Index::class)->name('companies.index');
    Route::get('/companies/create', \App\Livewire\Company\Create::class)->name('companies.create');
    Route::get('/companies/{company}/edit', \App\Livewire\Company\Edit::class)->name('companies.edit');

    Route::get('/users', \App\Livewire\User\Index::class)->name('users.index');
    Route::get('/users/create', \App\Livewire\User\Create::class)->name('users.create');
    Route::get('/users/{user}/edit', \App\Livewire\User\Edit::class)->name('users.edit');

    Route::get('/system-users', \App\Livewire\SystemUser\Index::class)->name('system-users.index');
    Route::get('/system-users/create', \App\Livewire\SystemUser\Create::class)->name('system-users.create');
    Route::get('/system-users/{user}/edit', \App\Livewire\SystemUser\Edit::class)->name('system-users.edit');


    Route::get('/switch-company/{company}', function (\App\Models\Company $company) {
        auth()->user()->current_company_id = $company->id;
        auth()->user()->save();

        return redirect()->route('companies.index');
    })->name('switch-company');


});
