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
        if (!strpos($referer, '/order')) 
            abort(400, 'Bad request.');
            
        return view('ordersummary.index', $order->orderContext());
    }
}
