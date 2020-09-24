<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employer;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployerRegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/employers';

    public function showRegistrationForm()
    {
        $companies = Company::select('id','name','is_active')->where('is_active',1)->get();
        return view('backend.auth.employer.register')->with([
            'companies'=>$companies
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $employer = Employer::create($input);

        $this->guard('employer')->login($employer);

        if ($response = $this->registered($request, $employer)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectTo);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
