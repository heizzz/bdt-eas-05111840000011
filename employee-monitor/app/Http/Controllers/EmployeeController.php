<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class EmployeeController extends Controller
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
    public function search(Request $request)
    {
        $key = $request->q;

        $cachedSearch = Cache::tags('search')->get('search_' . $key);
        $input = $request->all();
        $page = array_key_exists("page", $input) ? $input["page"] : 1;
        $perPage = 20;
        $employees = null;
        if($cachedSearch != null) {
            $employees = new LengthAwarePaginator(
                $cachedSearch->forPage($page, $perPage), $cachedSearch->count(), $perPage, $page,
                ['path' => Paginator::resolveCurrentPath(), 'pageName' => "page"]
            );
        }
        else {
            $employees = DB::table('employees')
                ->select('emp_no', 'first_name', 'last_name', 'gender', 'hire_date')
                ->where('emp_no', 'like', '%' . $key . '%')
                ->orWhere('first_name', 'like', '%' . $key . '%')
                ->orWhere('last_name', 'like', '%' . $key . '%')
                ->get();
            Cache::tags('search')->put('search_' . $key, $employees, 600);
            $employees = new LengthAwarePaginator(
                $employees->forPage($page, $perPage), $employees->count(), $perPage, $page,
                ['path' => Paginator::resolveCurrentPath(), 'pageName' => "page"]
            );
        }
        return view('home', ['employees' => $employees]);
    }

    public function detail($id)
    {
        $employee = DB::table('employees')
                        ->where('emp_no', '=', $id)
                        ->first();

        $cachedSalaries = Cache::tags('salary')->get('salary_' . $id);
        if ($cachedSalaries != null) {
            $salaries = $cachedSalaries;
        }
        else {
            $salaries = DB::table('salaries')
                    ->where('emp_no', '=', $id)
                    ->orderBy('to_date', 'desc')
                    ->get();
            Cache::tags('salary')->put('salary_' . $id, $salaries, 600);
        }
        return view('employee.details', ['employee' => $employee, 'salaries' => $salaries]);
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        DB::table('employees')
            ->insert([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'hire_date' => $request->hire_date,
            ]);
            Cache::tags('search')->flush();
        return redirect()->route('home');
    }

    public function edit($id)
    {
        $employee = DB::table('employees')
            ->where('emp_no', '=', $id)
            ->first();
        return view('employee.edit', ['employee' => $employee]);
    }

    public function update(Request $request)
    {
        $emp_no = $request->emp_no;
        DB::table('employees')
            ->where('emp_no', '=', $emp_no)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'hire_date' => $request->hire_date,
            ]);
        Cache::tags('search')->flush();
        return redirect()->route('detail', ['id' => $emp_no]);
    }

    public function delete($id)
    {
        DB::table('employees')
            ->where('emp_no', '=', $id)
            ->delete();
        Cache::tags('search')->flush();
        return redirect()->route('home');
    }
}
