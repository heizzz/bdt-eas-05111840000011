@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Existing Salary for {{ $employee->first_name . " " . $employee->last_name }}</div>
                <div class="card-body">
                    <form action="{{ route('salary-update', ['id' => $employee->emp_no, 'id_salary' => $salary->from_date]) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="emp_no" value="{{ $employee->emp_no }}">
                        <div class="form-group my-3">
                            <strong>Salary</strong>
                            <input type="number" min="1" step="any" name="salary" class="form-control"
                                placeholder="Salary" value="{{ $salary->salary }}" required>
                        </div>
                        <div class="form-group my-3">
                            <strong>From Date</strong>
                            <input type="date" name="from_date" class="form-control" value="{{ $salary->from_date }}" required>
                        </div>
                        <div class="form-group my-3">
                            <strong>To Date</strong>
                            @if ($salary->to_date == "9999-01-01")
                            <input type="date" name="to_date" class="form-control">
                            @else
                            <input type="date" name="to_date" class="form-control" value="{{ $salary->to_date }}">
                            @endif
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
