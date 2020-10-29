<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole extends Authenticate
{
    public function handle($request, Closure $next, $role)
    {
            $user = Auth::user();
            
            if($user->hasRole($role))
                return $next($request);
                
                return redirect()->route('no-perm', ['acction' => 'admin']);
    }
}
