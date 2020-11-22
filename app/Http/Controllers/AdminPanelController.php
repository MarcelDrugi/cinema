<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEmployeeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\CreateUserService;

class AdminPanelController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }
    
    public function index()
    {
        return response()->view('adminpanel.index');
    }

    public function store(CreateEmployeeRequest $request)
    {
        $employee = new CreateUserService('employee');
        $employee->createUser($request->input());
        
        return redirect()->route('homepage.index', ['action' => 'new_employee']);
    }
}
