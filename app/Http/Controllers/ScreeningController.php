<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Hall;
use App\Services\ScreeningService;
use App\Http\Requests\CreateScreeningRequest;
use App\Models\Screening;
use App\Http\Requests\EditScreeningRequest;

class ScreeningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:employee');
    }
    
    public function index(Request $request)
    {
        return response()->view('screening.index', [
            'movies' => Movie::with('screenings', 'screenings.term')->get(),
            'halls' => Hall::with('terms', 'terms.screening.movie')->get(),
            'newScreening' => $request->session()->get('newScreening'),
            'deletedScreening' => $request->session()->get('deletedScreening'),
            'screeningEdited' => $request->session()->get('screeningEdited'),
        ]);
    }

    public function store(CreateScreeningRequest $request)
    {
        $service = new ScreeningService($request->all());
        $service->createScreening();
        
        return redirect()->route('screening.index');
    }


    public function update(EditScreeningRequest $request)
    {
        $service = new ScreeningService($request->all());
        $service->updateScreening();

        return redirect()->route('screening.index');
    }

    public function destroy(Request $request)
    {
        $service = new ScreeningService($request->all());
        $service->removeScreening();
        
        return redirect()->route('screening.index');
    }
}
