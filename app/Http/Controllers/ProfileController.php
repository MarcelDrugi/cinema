<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UpdateUserService;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('role:customer');
    }
    
    public function index($action=null)
    {
        $userId = Auth::user()->id;
        return view('profile.index', ['action' => $action])->with('user', User::findOrFail($userId));
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
