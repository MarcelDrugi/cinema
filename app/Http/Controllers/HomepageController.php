<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isEmpty;
use App\Models\Reservation;
use App\Services\ConfirmReservationService;

class HomepageController extends Controller
{
    public function index($action=null)
    {
        $parameters = request()->all();
        if(!empty($parameters['paymentId']) && !empty($parameters['payerId'])) {
            $reservationId = session()->pull('reservationId');
            $confirmReservation = new ConfirmReservationService($reservationId, $parameters);
            $confirmReservation->confirm();
        }
        $movies = Movie::where('new_movie', true)->take(5)->get();
        return response()->view('homepage.index', ['movies' => $movies, 'action' => $action]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $path = $request->file('myfile')->store('posters', 's3');
        
        echo basename($path);
        echo "<br />";
        echo Storage::disk('s3')->url($path);
        echo "<br />";
        return "Ala ma kota";
        //return redirect()->action('App\Http\Controllers\HomepageController@index');
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
