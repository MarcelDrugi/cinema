<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Services\PricingService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        return response()->view('pricing.index', [
            'pricings' => Pricing::all(),
            'weekDays' => PricingService::$weekDays,
            'today' => Carbon::now()->englishDayOfWeek,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
