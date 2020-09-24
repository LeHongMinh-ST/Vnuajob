<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexUser(Request $request)
    {
        return view('backend.dashboard');
    }

    public function indexEmployer(Request $request)
    {
        return view('backend.dashboard');
    }
}
