<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/old-home', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', [\App\Http\Controllers\HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

//Route::view('dashboard', 'dashboard')
//    ->middleware(['auth', 'verified'])
//    ->name('dashboard');

Route::view('user-dashboard', 'user-dashboard')
    ->middleware(['auth', 'verified'])
    ->name('user.dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    Route::get('settings/user', \App\Livewire\Settings\User::class)->name('settings.user')->middleware('is_admin');
    Route::get('settings/supplier', \App\Livewire\Settings\Supplier::class)->name('settings.supplier');

    Route::get('creators/funding-request/index', \App\Livewire\FundingRequest\Index::class)->name('funding.index');
    Route::get('creators/funding-request/budget/{request}', \App\Livewire\FundingRequest\Budget::class)->name('funding.budget');
    Route::get('funding-request/detailed-view/{request}', \App\Livewire\FundingRequest\DetailedView::class)->name('funding.detailed-view');
    Route::get('creators/funding-request/approvals', \App\Livewire\FundingRequest\Approval::class)->name('funding.approval.index')->middleware('is_approver');
    Route::get('creators/funding-request/responses', \App\Livewire\FundingRequest\Response::class)->name('funding.response.index');
    Route::get('creators/asset-management/index', \App\Livewire\AssetManagement\Index::class)->name('asset.index');
    Route::get('creators/asset-management/view/{asset}', \App\Livewire\AssetManagement\DetailedView::class)->name('asset.view');
    Route::get('creators/asset-management/approvals', \App\Livewire\AssetManagement\AssetApproval::class)->name('asset.approvals')->middleware('is_approver');
    Route::get('creators/asset-management/disposed-assets', \App\Livewire\AssetManagement\DisposedAssets::class)->name('asset.disposed');
    Route::get('creators/procurement/index', \App\Livewire\Procurement\Index::class)->name('procurement.index');
    Route::get('creators/procurement/quotation/{item}', \App\Livewire\Procurement\Quotation::class)->name('procurement.quotation');
    Route::get('creators/procurement/approvals', \App\Livewire\Procurement\Approval::class)->name('procurement.approvals');
    Route::get('creators/procurement/approve/{item}', \App\Livewire\Procurement\Approve::class)->name('procurement.approve');

    Route::get('funding-request/index', \App\Livewire\Donors\FundingRequest\Index::class)->name('donor.funding.index');
    Route::get('donors/funding-request/detailed-view/{request}', \App\Livewire\Donors\FundingRequest\DetailedView::class)->name('donors.funding.detailed-view');
    Route::get('reports', \App\Livewire\Reports\Index::class)->name('reports.index');
    Route::get('reports/detailed/{request}', \App\Livewire\Reports\DetailedView::class)->name('reports.detailed');
    Route::get('reports/income-expenditure/{request}', [\App\Http\Controllers\HomeController::class, 'incomeReport'])->name('reports.income-expenditure');


});

require __DIR__.'/auth.php';
