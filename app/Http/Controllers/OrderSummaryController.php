<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderDetailService;

class OrderSummaryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:customer');
    }

    public function index(Request $request, OrderDetailService $order)
    {
        $referer = $request->server('HTTP_REFERER');
        if (!strpos($referer,'/order')) 
            dd("NOT ALLOWED");
            
        return view('ordersummary.index', $order->orderContext());
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
