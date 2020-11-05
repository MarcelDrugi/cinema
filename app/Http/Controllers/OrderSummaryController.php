<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderSummaryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:customer');
    }

    public function index(Request $request)
    {
        $toPay = $request->session()->get('toPay');
        session()->forget('toPay');
        
        $discountId = $request->session()->get('discountId');
        session()->forget('discountId');
        
        $summOfTickets = $request->session()->get('summOfTickets');
        session()->forget('summOfTickets');
        
        return view('ordersummary.index', [
            'toPay' => $toPay,
            'discountId' => $discountId,
            'summOfTickets' => $summOfTickets
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
