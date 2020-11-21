<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InformationRequest;
use App\Models\Information;
use App\Services\InformationService;

class InformationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:employee');
    }
    
    public function index(Request $request)
    {
        return response()->view('information.index', [
            'infos' => Information::all(),
            'infoModified' => $request->session()->get('infoModified'),
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

    public function update(InformationRequest $request)
    {
        $service = new InformationService($request->all());
        $service->updateInfo();
        
        return redirect()->route('information.index');
    }

    public function destroy($id)
    {
        //
    }
}
