<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function currentUser(Request $request){
        $user = $request->user();
        return response($user);
    }
    public function updatePhoto(AuthRequest $request)
    {
        // Log::info('Stripe session object: {user}',['user' => $request->imagepath]);
        $user = User::findOrFail($request->user()->id);
        if(!is_null($user->imagepath)){
            Storage::disk('public')->delete($user->imagepath);
        }
        $user->imagepath = $request->file('imagepath')->storePublicly('images', 'public');

        $user->save();

        return $user;
    //     $validated = $request->validated();
    //     $user = $request->user();
    //     $carouselItem = User::findOrFail($user)
    //   ->update($validated);

    //     return $carouselItem;
    }

    public function login(AuthRequest $request)
    {
        $user = User::where('username', $request->username)->first();
     Log::info('Stripe session object: {user}',['user' => $user]);
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $response = [
            'user' => $user,
            'token' => $user->createToken($user->username)->plainTextToken
        ];

        return $response;
    }

    public function signup(AuthRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        return $user;
    }

    /**
     * Display the specified resource.
     */

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        $response = [
            'message' => 'Logout successfully.'
        ];

        return $response;
    }
}
