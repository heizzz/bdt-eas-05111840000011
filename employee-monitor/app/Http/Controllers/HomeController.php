<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employees = DB::table('employees')
                        ->select('emp_no', 'first_name', 'last_name', 'gender', 'hire_date')
                        ->paginate(20);
        return view('home', ['employees' => $employees]);
    }
}
