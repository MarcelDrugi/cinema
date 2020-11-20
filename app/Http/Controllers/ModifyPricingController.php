<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PricingRequest;
use App\Models\Pricing;
use App\Services\PricingService;

class ModifyPricingController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:employee');
    }
    
    public function index(Request $request)
    {
        $pricingCreated = $request->session()->get('pricingCreated');
        $pricingDeleted = $request->session()->get('pricingDeleted');
        $pricingModified = $request->session()->get('pricingModified');
        
        return response()->view('modifypricing.index', [
            'pricings' => Pricing::all(),
            'weekDays' => PricingService::$weekDays,
            'pricingCreated' => $pricingCreated ? $pricingCreated : null,
            'pricingDeleted' => $pricingDeleted ? $pricingDeleted : null,
            'pricingModified' => $pricingModified ? $pricingModified : null,
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

    public function update(PricingRequest $request)
    {
        $service = new PricingService($request->all());
        $service->updatePricing();
        return redirect()->route('modify-pricing.index', []);
    }

    public function destroy($id)
    {
        //
    }
}
