@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('home') }}" class="btn btn-secondary mb-3"><i class="fa fa-arrow-left"></i> Back</a>
            <div class="card">
                <div class="card-header">Employee Detail</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless text-left">
                            <tr>
                                <td>Emp No</td>
                                <td>{{ $employee->emp_no }}</td>
                            </tr>
                            <tr>
                                <td>Full Name</td>
                                <td>{{ $employee->first_name . " " . $employee->last_name }}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>{{ $employee->gender }}</td>
                            </tr>
                            <tr>
                                <td>Hire Date</td>
                                <td>{{ $employee->hire_date }}</td>
                            </tr>
                            <tr>
                                <td>Birth Date</td>
                                <td>{{ $employee->birth_date }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <a class="btn btn-primary px-4" href="{{route('employee-edit', $employee->emp_no)}}">Edit Employee</a>
                        </div>
                        <div class="col-3">
                            <form action="{{route('employee-delete', $employee->emp_no)}}" method="POST">
                                @csrf
                                @method("delete")
                                <button class="btn btn-danger px-4" type="submit">Delete Employee</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="card my-3">
                <div class="card-header">Titles</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>From</th>
                                    <th>To</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($titles as $title)
                                <tr>
                                    <td>{{ $title->title }}</td>
                                    <td>{{ $title->from_date }}</td>
                                    <td>
                                        @if ($title->to_date == "9999-01-01")
                                            Present
                                        @else
                                            {{ $title->to_date }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
            <div class="card my-3">
                <div class="card-header">Salaries</div>
                <div class="card-body">
                    <a class="btn btn-primary px-4" href="{{route('salary-create', ['id' => $employee->emp_no])}}">Add Salary</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Salary</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($salaries as $salary)
                                <tr>
                                    <td>{{ $salary->salary }}</td>
                                    <td>{{ $salary->from_date }}</td>
                                    <td>
                                        @if ($salary->to_date == "9999-01-01")
                                            Present
                                        @else
                                            {{ $salary->to_date }}
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('salary-edit', ['id' => $employee->emp_no, 'id_salary' => $salary->from_date]) }}">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('salary-delete', ['id' => $employee->emp_no, 'id_salary' => $salary->from_date]) }}" method="POST">
                                            @csrf
                                            @method("delete")
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
