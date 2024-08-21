@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Employee Details</h1>
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" class="form-control" id="id" value="{{ $employee->id }}" disabled>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" value="{{ $employee->name }}" disabled>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="{{ $employee->email }}" disabled>
        </div>
        <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <input type="text" class="form-control" id="department" value="{{ $employee->department->name }}" disabled>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" value="{{ $employee->phone }}" disabled>
        </div>
        <div class="mb-3">
            <label for="salary" class="form-label">Salary</label>
            <input type="text" class="form-control" id="salary" value="{{ $employee->salary }}" disabled>
        </div>
        <a href="{{ route('employees.index') }}" class="btn btn-primary">Back to List</a>
    </div>
@endsection
