<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Screening;
use App\Models\Discount;
use App\Http\Requests\OrderRequest;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:customer');
    }
    
    public function index($id)
    {
        $screening = Screening::findOrFail($id);
        $freeTickets = $screening->term->hall->capacity - $screening->viewers;
        $discounts = Discount::where('user_id', Auth::user()->id)->get();
        return view('order.index', ['screening' => $screening, 'freeTickets' => $freeTickets, 'discounts' => $discounts]);
    }

    public function create()
    {
        //
    }

    public function store(OrderRequest $request)
    {
        $order = new OrderService($request->all());
        $order->toPay();
        return redirect()->route('summary.index');
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
