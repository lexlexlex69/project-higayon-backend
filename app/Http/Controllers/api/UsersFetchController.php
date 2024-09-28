<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    ///////for fgetching current user's followers

    public function userFollowers(string $id)
    {
        $followers = DB::table('users')->whereIn('id', function($query) use ($id){
            $query->select('followedBy')
            ->from('follows')
            ->where('followedUser', $id);
        })
        ->get();

        return response($followers);
    }

    ///////for fetching current user's followed

    public function userFollowed(string $id)
    {
        $followers = DB::table('users')->whereIn('id', function($query) use ($id){
            $query->select('followedUser')
            ->from('follows')
            ->where('followedBy', $id)
            ->orderBy('created_at','desc');
        })
        ->get();

        return response($followers);
    }

    ///////for fetching current user's not yet followed users

    public function userSuggestions(string $id)
    {
        $followers = DB::table('users')->whereNotIn('id', function($query) use ($id){
            $query->select('followedUser')
            ->from('follows')
            ->where('followedBy', $id);
        })
        ->whereNot('id', $id)
        ->orderBy('created_at', 'desc')
        ->get();

        return response($followers);
    }

    //for checking current user's profile
    public function profileCheck(string $id){
        $user = Auth::user();

        return response()->json($user->id == $id);
    }
}
