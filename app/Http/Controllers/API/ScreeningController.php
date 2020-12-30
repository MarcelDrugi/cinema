<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ScreeningResource;
use App\Filters\ScreeningFilter;

class ScreeningController extends Controller
{
    public function index(Request $request)
    {
        $filter = new ScreeningFilter($request->all());
        
        if ($filtered = $filter->resultFiltering())
            return ScreeningResource::collection($filtered);
        else
            return response()->json(['error' => 'Wrong filters.'], 400);
    }
}
