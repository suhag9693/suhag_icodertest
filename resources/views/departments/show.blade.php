
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Department Details</h1>
        <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input type="text" class="form-control" id="id" value="{{ $department->id }}" disabled>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Department Name</label>
            <input type="text" class="form-control" id="name" value="{{ $department->name }}" disabled>
        </div>
        <a href="{{ route('departments.index') }}" class="btn btn-primary">Back to List</a>
    </div>
@endsection
