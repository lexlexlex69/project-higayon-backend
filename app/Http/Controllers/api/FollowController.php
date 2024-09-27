<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Follow::all();
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function follow(Request $request)
    {
        $currentUser = $request->user();
        $followedUser = User::findOrFail($request->followedUser);

        if(!$followedUser && $currentUser){
            return response()->json(['message' => 'User not found.'], 404);
        }
        // $operation = $request->operation;

        $followedUser->followerUpdate('1')->save();
        $currentUser->followingUpdate('1')->save();


            $follow = Follow::create([
                'followedBy' => $currentUser->id,
                'followedUser' => $followedUser->id,
            ]);
      
        
        return response($follow, 201);
    }
    public function unfollow(Request $request)
    {
        $currentUser = $request->user();
        $followedUser = User::find($request->followedUser);

        if(!$followedUser){
            return response()->json(['message' => 'User not found.'], 404);
        }
        // $operation = $request->operation;

        $followedUser->followerUpdate('0')->save();
        $currentUser->followingUpdate('0')->save();

        $follow = Follow::where('followedBy', $currentUser->id)
        ->where('followedUser', $followedUser->id)
        ->delete();
        
        return response($follow);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
