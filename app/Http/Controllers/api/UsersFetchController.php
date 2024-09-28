<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersFetchController extends Controller
{
    public function allUsers()
    {
        return User::all();
    }

    public function suggestedUsers(Request $request)
    {
        $user = Auth::user();
        return User::whereNot('id',$user->id)->get();
        // return ($request->user());
    }
    public function User(string $id)
    {
    
        return User::where('id',$id)->first();
        // return ($id);
    }
}
