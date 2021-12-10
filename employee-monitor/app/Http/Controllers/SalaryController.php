<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class SalaryController extends Controller
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
    public function create($id)
    {
        $employee = DB::table('employees')
                        ->where('emp_no', '=', $id)
                        ->first();
        return view('salary.create', ['employee' => $employee, 'id' => $id]);
    }

    public function store(Request $request, $id)
    {
        $to_date = $request->to_date;
        if ($to_date == null) $to_date = "9999-01-01";
        DB::table('salaries')
            ->insert([
                'emp_no' => $id,
                'salary' => $request->salary,
                'from_date' => $request->from_date,
                'to_date' => $to_date,
            ]);
        Cache::tags('salary')->flush();
        return redirect()->route('detail', ['id' => $id]);
    }

    public function edit($id, $id_salary)
    {
        $employee = DB::table('employees')
                        ->where('emp_no', '=', $id)
                        ->first();
        $salary = DB::table('salaries')
            ->where('emp_no', '=', $id)
            ->where('from_date', '=', $id_salary)
            ->first();
        return view('salary.edit', ['salary' => $salary, 'id' => $id, 'id_salary', 'employee' => $employee]);
    }

    public function update(Request $request)
    {
        $emp_no = $request->emp_no;
        $id_salary = $request->id_salary;
        $to_date = $request->to_date;
        if ($to_date == null) $to_date = "9999-01-01";
        DB::table('salaries')
            ->where('emp_no', '=', $emp_no)
            ->where('from_date', '=', $id_salary)
            ->update([
                'salary' => $request->salary,
                'from_date' => $request->from_date,
                'to_date' => $to_date,
            ]);
        Cache::tags('salary')->flush();
        return redirect()->route('detail', ['id' => $emp_no]);
    }

    public function delete($id, $id_salary)
    {
        DB::table('salaries')
            ->where('emp_no', '=', $id)
            ->where('from_date', '=', $id_salary)
            ->delete();
        Cache::tags('salary')->flush();
        return redirect()->route('detail', ['id' => $id] );
    }
}
