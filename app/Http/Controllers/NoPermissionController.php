<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoPermissionController extends Controller
{
    public function index($role)
    {
        return response()->view('noperm.index', ['role' => $role]);
    }
}
