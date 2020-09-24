<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = 'admin/';

    public function __construct()
    {
        $this->middleware('admin.guest')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    public function showLoginForm()
    {
        return view('backend.auth.admin.login');
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);


        $user = User::where('email', $request->email)->first();

        if($user==null)
        {
            Session::put('login_error', 'Tài khoản không tồn tại');
            return back();
        }

        if($user->is_active != 1)
        {
            Session::put('login_error', 'Tài khoản đang bị khóa');
            return back();
        }

        if (auth()->guard('user')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'deleted_at' => null])) {
            return redirect($this->redirectTo);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        return redirect('/');
    }
}
