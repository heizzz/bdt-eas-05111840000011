@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Employee</div>
                <div class="card-body">
                    <form action="{{ route('employee-store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <strong>First Name</strong>
                            <input type="text" name="first_name" class="form-control"
                                placeholder="First Name" required>
                        </div>
                        <div class="form-group my-3">
                            <strong>Last Name</strong>
                            <input type="text" name="last_name" class="form-control"
                                placeholder="Last Name" required>
                        </div>
                        <div class="form-group my-3">
                            <strong>Gender</strong>
                            <select name="gender" class="form-control">
                                <option selected value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div class="form-group my-3">
                            <strong>Birth Date</strong>
                            <input type="date" name="birth_date" class="form-control" required>
                        </div>
                        <div class="form-group my-3">
                            <strong>Hire Date</strong>
                            <input type="date" name="hire_date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
