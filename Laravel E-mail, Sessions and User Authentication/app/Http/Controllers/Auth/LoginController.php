<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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
    use Illuminate\Support\Facades\Auth;

    */ 
    /*
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('todolists.index');
        }
        return view('auth.login');

        // Redirect the user to the login page
        
    }
    */
    protected $redirectTo = '/manage/index';

    protected function loggedOut()
    {
        return redirect('/login');
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('todolists.index');
            
        }
        return view('auth.login');

        // Redirect the user to the login page
        
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
}
