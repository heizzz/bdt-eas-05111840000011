@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                <a class="btn btn-primary px-4 mb-3" href="{{route('employee-create')}}">Add New Employee</a>
                    <form class="form-inline mb-3" action="{{ route('search') }}" method="GET">
                        <div class="row">
                            <div class="col-9">
                                <input class="form-control mr-sm-1 col-3 my-1" type="text" name="q" placeholder="Cari .." value="{{ app('request')->input('q') }}" required>
                            </div>
                        <button class="btn btn-primary col-1 my-1 mx-1" type="submit"><i class="fas fa-search"></i></button>
                        <a href="{{ route('home') }}" class="btn btn-danger col-1 my-1 mx-1">Clear</a>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                </tr>
                                    <th>Emp No</th>
                                    <th>Full Name</th>
                                    <th>Gender</th>
                                    <th>Hire Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->emp_no }}</td>
                                    <td><a href="{{ route('detail', ["id" => $employee->emp_no]) }}">{{ $employee->first_name . " " . $employee->last_name }}</a></td>
                                    <td>{{ $employee->gender }}</td>
                                    <td>{{ $employee->hire_date }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $employees->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
