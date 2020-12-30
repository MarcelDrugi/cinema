<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

final class UpdateUserService
{
    public function __construct($id)
    {
        $this->id = $id;
    }
    
    public function updateUser(array $data)
    {
        $user = User::find($this->id);
        
        $user->update([
            'first_name' =>$data['first_name'],
            'last_name' =>$data['last_name'],
            'email' =>$data['email'],
        ]);
        
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
            $user->save();
        }
        
        if (!empty($data['avatar'])) {
            $s3 = Storage::disk('s3');
            $s3->delete(substr($user->avatar, 50));
            
            $request = request();
            $path = $request->file('avatar')->store('avatars', 's3');
            $url = $s3->url($path);
            
            $user->avatar = $url;
            $user->save();
        }
    }
}