<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UpdateUserService;
use App\Models\Reservation;
use App\Models\Discount;
use App\Services\PayPalService;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:customer');
    }
    
    public function index($action=null)
    {
        $userId = Auth::user()->id;
        return view('profile.index', [
            'action' => $action,
            'user' => User::findOrFail($userId),
            'reservations' => Reservation::where('user_id', $userId)->orderBy('screening_id')->get(),
            'discounts' => Discount::where('user_id', $userId)->get(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request, PayPalService $paypal)
    {
        $reservation = Reservation::findOrFail($request->input('reservationId'));
        session()->put('reservationId', $reservation->id);
        
        if(!$reservation->payment_status) {
            if($redirect_url = $paypal->createPayment($reservation->price))
                return redirect($redirect_url);
            else
                return redirect()->route('homepage.index', ['action' => 'nonpaid']);
        }
            
        return $request->input('reservationId');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $update = new UpdateUserService($id);
        $update->updateUser($request->all());
        return redirect()->route('profile.index', ['action' => 'newData']);
    }

    public function destroy($id)
    {
        //
    }
}
