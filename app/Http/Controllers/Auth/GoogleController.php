<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('google_id', $googleUser->id)->first();

            if (!$user) {
                $user = User::where('email', $googleUser->email)->first();
                if ($user) {
                    $user->update([
                        'google_id' => $googleUser->id,
                        'avatar' => $googleUser->avatar
                    ]);
                } else {
                    $user = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'avatar' => $googleUser->avatar,
                        'password' => null,
                    ]);
                }
            }
        
            Auth::login($user);
        
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
        
            return redirect()->route('front.home');

        } catch (\Exception $e) {
            // Debugging: Uncomment line below to see the actual error
            // dd($e->getMessage());
            return redirect()->route('login')->with('error', 'Something went wrong with Google Login: ' . $e->getMessage());
        }
    }
}
