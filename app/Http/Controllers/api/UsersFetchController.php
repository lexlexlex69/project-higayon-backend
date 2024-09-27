<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersFetchController extends Controller
{
    public function allUsers()
    {
        return User::all();
    }

    public function suggestedUsers(Request $request)
    {
        return User::whereNot('id','1')->get();
        // return ($request->user());
    }
}
