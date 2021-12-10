@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Employee Details</div>
                <div class="card-body">
                    <form action="{{ route('employee-update') }}" method="POST">
                        @method("PUT")
                        @csrf
                        <input type="hidden" name="emp_no" value="{{ $employee->emp_no }}">
                        <div class="form-group mb-3">
                            <strong>First Name</strong>
                            <input type="text" name="first_name" class="form-control"
                                placeholder="First Name" value="{{ $employee->first_name }}" required>
                        </div>
                        <div class="form-group my-3">
                            <strong>Last Name</strong>
                            <input type="text" name="last_name" class="form-control"
                                placeholder="Last Name" value="{{ $employee->last_name }}" required>
                        </div>
                        <div class="form-group my-3">
                            <strong>Gender</strong>
                            <select name="gender" class="form-control">
                                @if ($employee->gender == 'M')
                                    <option value="M" selected>Male</option>
                                    <option value="F">Female</option>
                                @else
                                    <option value="M">Male</option>
                                    <option value="F" selected>Female</option>
                                @endif

                            </select>
                        </div>
                        <div class="form-group my-3">
                            <strong>Birth Date</strong>
                            <input type="date" name="birth_date" class="form-control" value="{{ $employee->birth_date }}" required>
                        </div>
                        <div class="form-group my-3">
                            <strong>Hire Date</strong>
                            <input type="date" name="hire_date" class="form-control" value="{{ $employee->hire_date }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
