<?php

namespace App\Http\Controllers;

use App\Models\BudgetItem;
use App\Models\Donation;
use App\Models\FundingRequest;
use App\Models\Ledger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    public function index()
    {
        $flagged = BudgetItem::where('flagged', 1)->get();
        $received = Donation::where('status', 'accepted')->sum('amount');
        $expenditure = BudgetItem::where('is_purchased', 1)->sum('actual_cost');
        $donors = \App\Models\Donation::where('creator_organisation_id', Auth::user()->organisation->id)->count();
        $donations = \App\Models\Donation::where('creator_organisation_id', Auth::user()->organisation->id)->get();

        return view('dashboard', compact('flagged', 'received', 'expenditure', 'donations', 'donors'));
    }

    public function incomeReport(FundingRequest $request)
    {
        $data = Ledger::where('request_id', $request->id)->get();

        $pdf = Pdf::loadView('income', compact('data'));

        return $pdf->stream();
    }
}
