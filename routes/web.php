<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('user-dashboard', 'user-dashboard')
    ->middleware(['auth', 'verified'])
    ->name('user.dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('creators/funding-request/index', \App\Livewire\FundingRequest\Index::class)->name('funding.index');
    Route::get('creators/funding-request/budget/{request}', \App\Livewire\FundingRequest\Budget::class)->name('funding.budget');
    Route::get('funding-request/detailed-view/{request}', \App\Livewire\FundingRequest\DetailedView::class)->name('funding.detailed-view');

    Route::get('funding-request/index', \App\Livewire\Donors\FundingRequest\Index::class)->name('donor.funding.index');
});

require __DIR__.'/auth.php';
