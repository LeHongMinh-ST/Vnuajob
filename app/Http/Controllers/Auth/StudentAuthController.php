<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\Student;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StudentAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    protected function guard()
    {
        return Auth::guard('student');
    }

    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);


        $employer = Student::where('email', $request->email)->first();

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



        if (auth()->guard('student')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'deleted_at' => null])) {
            return redirect($this->redirectTo);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        return redirect('/');
    }
}
