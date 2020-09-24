<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function showAdminLoginForm()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $user = User::where('email', $request->email)->first();

        if($user==null || $user->role == 0)
        {
            Session::put('login_error', 'Tài khoản không tồn tại');
            return back();
        }

        if($user->is_active != 1)
        {
            Session::put('login_error', 'Tài khoản đang bị khóa');
            return back();
        }

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'deleted_at' => null])) {
            return redirect('/');
        }
    }

    public function adminLogin(Request $request)
    {
        $this->validateLogin($request);

        $user = User::where('email', $request->email)->first();

        if($user==null || $user->role != 0)
        {
            Session::put('login_error', 'Tài khoản không tồn tại');
            return back();
        }

        if($user->is_active != 1)
        {
            Session::put('login_error', 'Tài khoản đang bị khóa');
            return back();
        }

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'deleted_at' => null])) {
            return redirect($this->redirectTo);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
