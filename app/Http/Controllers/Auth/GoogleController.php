<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = $this->findOrCreateUser($googleUser, 'google');
        Auth::login($user);

        return $this->redirectBasedOnRole();
    }

    protected function findOrCreateUser($googleUser, $provider)
    {
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            return $user;
        }

        return User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'provider' => $provider,
            'provider_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(),
        ]);
    }

    protected function redirectBasedOnRole()
    {
        if (auth()->user()->type == 'admin') {
            return redirect()->route('admin.dashboard');
        } else if (auth()->user()->type == 'manager') {
            return redirect()->route('manager.dashboard');
        } else {
            return redirect()->route('production');
        }
    }
}
