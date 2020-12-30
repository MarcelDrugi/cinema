<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isEmpty;
use App\Models\Reservation;
use App\Services\ConfirmReservationService;
use App\Models\Information;

class HomepageController extends Controller
{
    public function index($action=null)
    {
        $parameters = request()->all();
        
        if (!empty($parameters['paymentId']) && !empty($parameters['PayerID'])) {
            $reservationId = session()->pull('reservationId');
            $confirmReservation = new ConfirmReservationService($reservationId, $parameters);
            $confirmReservation->confirm();
        }
        
        $movies = Movie::where('new_movie', true)->take(5)->get();
        
        return response()->view('homepage.index', [
            'movies' => $movies,
            'action' => $action,
            'info_slider' => Information::where('place', 'homepage_slider')->first(),
            'info_top' => Information::where('place', 'homepage_top')->first(),
            'info_bottom' => Information::where('place', 'homepage_bottom')->first(),
        ]);
    }
}
