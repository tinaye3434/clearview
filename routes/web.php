<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/old-home', function () {
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
    Route::get('settings/user', \App\Livewire\Settings\User::class)->name('settings.user');
    Route::get('settings/supplier', \App\Livewire\Settings\Supplier::class)->name('settings.supplier');

    Route::get('creators/funding-request/index', \App\Livewire\FundingRequest\Index::class)->name('funding.index');
    Route::get('creators/funding-request/budget/{request}', \App\Livewire\FundingRequest\Budget::class)->name('funding.budget');
    Route::get('funding-request/detailed-view/{request}', \App\Livewire\FundingRequest\DetailedView::class)->name('funding.detailed-view');
    Route::get('creators/funding-request/approvals', \App\Livewire\FundingRequest\Approval::class)->name('funding.approval.index');
    Route::get('creators/funding-request/responses', \App\Livewire\FundingRequest\Response::class)->name('funding.response.index');
    Route::get('creators/asset-management/index', \App\Livewire\AssetManagement\Index::class)->name('asset.index');


    Route::get('funding-request/index', \App\Livewire\Donors\FundingRequest\Index::class)->name('donor.funding.index');
    Route::get('donors/funding-request/detailed-view/{request}', \App\Livewire\Donors\FundingRequest\DetailedView::class)->name('donors.funding.detailed-view');

});

require __DIR__.'/auth.php';
