@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add New Salary for {{ $employee->first_name . " " . $employee->last_name }}</div>
                <div class="card-body">
                    <form action="{{ route('salary-store', ['id' => $employee->emp_no]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="emp_no" value="{{ $employee->emp_no }}">
                        <div class="form-group my-3">
                            <strong>Salary</strong>
                            <input type="number" min="1" step="any" name="salary" class="form-control"
                                placeholder="Salary" required>
                        </div>
                        <div class="form-group my-3">
                            <strong>From Date</strong>
                            <input type="date" name="from_date" class="form-control" required>
                        </div>
                        <div class="form-group my-3">
                            <strong>To Date</strong>
                            <input type="date" name="to_date" class="form-control">
                            <small>Leave blank if valid until now</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
