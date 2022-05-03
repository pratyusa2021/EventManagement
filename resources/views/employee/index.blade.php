@extends('employee.layouts.app')

@section('content')
<div class="container">
    <h2>Employee Details</h2>
    <a href="{{route('create')}}" type="button" class="btn btn-info btn-lg">Add Employee</a>
    <a type="button" href="{{route('home')}}">Back</a>
    <div class="row">
        <div class="col-md-8">
            <h3>Employees</h3>
            <hr>
            <table class="table table-bordered yajra-datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
