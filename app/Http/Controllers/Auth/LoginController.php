<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

      protected $redirectTo = '/home';
    // 'admin' => '/admin',
    // 'user' => '/home',
   public function redirectTo()
    {
        //$rollen = Auth()->user();
        $redirects = [
    'admin' => '/admin',
    'user' => '/home',
        ];

        $roles = Auth()->user()->roles->map->name;

        foreach ($redirects as $role => $url) {
            if ($roles->contains($role)) {
                return $url;
            }
        }
        return '/login';
         
    } 

    public function apiLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $response = Http::post('http://your-api-domain/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $apiResponse = $response->json();

            // Example assuming API returns a structure similar to what you provided
            $user = $apiResponse['results'];

            // Check if user is active or any other required conditions
            if ($user['status'] === 'active') {
                // Optionally, you can store API tokens or session info if needed
                // Example: session(['api_token' => $user['access']]);

                // Redirect based on user role or any other logic
                if ($user['role']['name'] === 'admin') {
                    return redirect('/admin');
                } else {
                    return redirect('/home');
                }
            } else {
                return back()->withErrors([
                    'email' => 'User is not active or other custom message.',
                ]);
            }
        }

        // Handle unsuccessful login attempt
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

 public function logout()
    {
        Auth()->logout();
        return redirect('/login');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // protected function loggedOut(Request $request)
    // {
    //     dd('d')
    // }
}
