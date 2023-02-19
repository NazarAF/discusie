<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Authenticate user request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authenticate(Request $request)
    {
        $credential = $request->validate(
            [
                'username' => ['required'],
                'password' => ['required'],
            ]
        );

        $credential = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credential = [
            'data' => [$credential => $request->username, 'password' => $request->password,],
            'remember' => ($request->has('remember') ? true : false)
        ];

        if (Auth::attempt($credential['data'], $credential['remember'])) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'))->withErrors([
                'title' => 'Successful!',
                'message' => 'Login App',
                'type' => 'success'
            ]);
        }

        return back()->withErrors([
            'title' => 'Failed!',
            'message' => 'Login',
            'type' => 'error'
        ]);
    }

    /**
     * Logout user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->withErrors([
            'title' => 'Successful!',
            'message' => 'Logout',
            'type' => 'success'
        ]);
    }
}
