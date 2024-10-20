<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Login;
use Illuminate\Http\Request;
use App\Models\RegisterMasjid;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class LoginController extends Controller
{
  
    public function index()
    {
        return view('auth/login');
    }

    // function login ke web
    public function authenticate(Request $request)
    {
        $credentials = $request ->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        // prosess login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        
            // Simpan data user yang login ke session jika diperlukan
            $user = Auth::user();
            session(['userMasjid' => $user]);
        
            return redirect()->intended('/dashboard');
        }        
        
        // jika tidak bisa login return
        return back()->with('loginError', 'Login gagal!');
    }

    // logut
    public function logout (Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        return redirect('/login');
    }

    // google login
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            // Get user info from Google
            $googleUser = Socialite::driver('google')->user();
    
            // Try to find user by Google OAuth ID
            $findUser = User::where('gauth_id', $googleUser->id)->first();
    
            if ($findUser) {
                // User found, log them in
                Auth::login($findUser);
                return redirect('/dashboard');
            } else {
                // If no user found by gauth_id, check if there's a user with the same email
                $existingUser = User::where('email', $googleUser->email)->first();
    
                if ($existingUser) {
                    // User exists with the same email, update their Google ID
                    $existingUser->update([
                        'gauth_id' => $googleUser->id,
                        'gauth_type' => 'google'
                    ]);
    
                    // Log them in
                    Auth::login($existingUser);
                    return redirect('/dashboard');
                } else {
                    // No user exists, create a new one
                    $newUser = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'gauth_id' => $googleUser->id,
                        'gauth_type' => 'google',
                        'password' => Hash::make(Str::random(16)) // Generate a random password
                    ]);
    
                    // Log the newly created user in
                    Auth::login($newUser);
                    return redirect('/dashboard');
                }
            }
        } catch (Exception $e) {
            // Catch errors and display them for debugging
            return redirect('/login')->with('loginError', 'Akun tidak ditemukan!');
        }
    }    

}
