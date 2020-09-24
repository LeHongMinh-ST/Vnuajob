<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EmployerAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = 'employers/';

    protected function guard()
    {
        return Auth::guard('employer');
    }

    public function showLoginForm()
    {
        return view('backend.auth.employer.login');
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);


        $employer = Employer::where('email', $request->email)->first();

        if($employer==null)
        {
            Session::put('login_error', 'Tài khoản không tồn tại');
            return back();
        }

        if($employer->is_active != 1)
        {
            Session::put('login_error', 'Tài khoản đang bị khóa');
            return back();
        }



        if (auth()->guard('employer')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'deleted_at' => null])) {
            return redirect($this->redirectTo);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('employer')->logout();
        return redirect('/');
    }
}
