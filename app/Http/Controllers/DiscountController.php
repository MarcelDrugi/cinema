<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\User;
use App\Services\DiscountService;
use App\Http\Requests\CreateDiscountRequest;
use App\Http\Requests\RemoveDiscountRequest;

class DiscountController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:employee');
    }
    
    public function index(Request $request)
    {
        $newDiscount = $request->session()->get('newDiscount');
        $deletedDiscount = $request->session()->get('deletedDiscount');
        
        return response()->view('discount.index', [
            'discounts' => Discount::orderBy('code')->with(['user'])->get(),
            'newDiscount' => $newDiscount ? Discount::findOrFail($newDiscount) : null,
            'deletedDiscount' => $deletedDiscount,
            'customers' => User::whereHas('roles', fn($q) => $q->where('name', 'Customer'))->orderBy('last_name')->get()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(CreateDiscountRequest $request)
    {
        $service = new DiscountService($request->all());
        $service->createDiscount();
        return redirect()->route('discount.index');
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

    public function destroy(RemoveDiscountRequest $request)
    {
        $service = new DiscountService($request->all());
        $service->delDiscount();
        return redirect()->route('discount.index');
    }
}
