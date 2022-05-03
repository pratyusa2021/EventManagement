@extends('employee.layouts.app')

@section('content')
<div class="container">
    <h2>Add Employee</h2>
    @if (count($errors) > 0)
   <div class = "alert alert-danger">
      <ul>
         @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <form method="post" action="{{route('store')}}" id="createEmployee">
                    @csrf
                    <ul>
                        <li>
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" placeholder="Enter Name" value="{{ old('name')}}"/>
                        </li>
                        <li>
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" placeholder="Enter Email" value="{{ old('email')}}" />
                        </li>
                        <li>
                            <label for="phone">Phone:</label>
                            <input type="number" id="phone" name="phone" placeholder="Enter Phone" value="{{ old('phone')}}"/>
                        </li>
                        <li>
                            <label for="address">Address:</label>
                            <textarea id="address" name="address">{{ old('address')}}</textarea>
                        </li>
                        <li>
                            <label for="dob">Date of Birth:</label>
                            <input type="date" id="dob" name="date_of_birth" value="{{ old('date_of_birth')}}">
                        </li>
                        <li>
                            <label for="department">Department:</label>
                            <select name="department_id" id="department">
                                <option value="">Choose Department</option>
                                @foreach($departments as $key => $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </li>
                             
                            <button type="submit" class="btn btn-primary"> Submit</button>
                    </ul>
                </form>
                <a class="btn btn-primary" href="{{route('index')}}"> Back</a>
        </div>
    </div>
</div>
@endsection
