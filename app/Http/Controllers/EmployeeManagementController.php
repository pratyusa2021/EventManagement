<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EmployeeRepository;
use App\Models\Department;
use App\Models\User;

class EmployeeManagementController extends Controller
{
    protected $employeeRepository;
    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->middleware('auth');
        $this->employeeRepository = $employeeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            return  $this->employeeRepository->getAll();
        }
        else{
            return view('employee.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $departments = Department::all();
        return view('employee.create')->with('departments',$departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|integer',
            'address' => 'required',
            'date_of_birth' => 'required|date',
            'department_id' => 'required'
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => "It's not an email address",
            'email.unique' => "Please enter a unique email address",
            'address' => 'Address is required',
            'date_of_birth' => 'DOB is required',
            'department_id' => 'Department is required'
        ]);


        $inputUserData = $request->only('name','email');
        $inputUserData['role_id'] = 2;
        $inputUserDetailsData = $request->only('phone','address','date_of_birth','department','department_id');

        $this->employeeRepository->store($inputUserData,$inputUserDetailsData);

        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $departments = Department::all();
        $user = User::with('userDetails')->where('id',$id)->first();
        return view('employee.edit')->with('departments',$departments)->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|integer',
            'address' => 'required',
            'date_of_birth' => 'required|date',
            'department_id' => 'required'
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => "It's not an email address",
            'address' => 'Address is required',
            'date_of_birth' => 'DOB is required',
            'department_id' => 'Department is required'
        ]);
        $inputUserData = $request->only('name','email');
        $inputUserDetailsData = $request->only('phone','address','date_of_birth','department','department_id');

        $id = $request->id;
        $this->employeeRepository->update($inputUserData,$inputUserDetailsData,$id);

        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->employeeRepository->delete($id);
    }
}
