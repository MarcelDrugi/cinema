<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class ApiDescriptionController extends Controller
{
    public function index()
    {
        return response()->view('api-description.index', [
            'info' => Information::where('place', 'api')->first(),
        ]);
    }
}
