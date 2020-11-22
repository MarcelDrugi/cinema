<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Services\PricingService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Information;

class PricingController extends Controller
{
    public function index()
    { 
        return response()->view('pricing.index', [
            'pricings' => Pricing::all(),
            'weekDays' => PricingService::$weekDays,
            'today' => Carbon::now()->englishDayOfWeek,
            'info' => Information::where('place', 'pricing')->first(),
        ]);
    }
}
