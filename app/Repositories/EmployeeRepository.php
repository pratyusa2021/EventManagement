<?php


namespace App\Repositories;

use App\Models\User;
use App\Models\UserDetail;
use Hash;

class EmployeeRepository
{
    public function store($inputUserData,$inputUserDetailsData)
    {
        $inputUserData['password'] = Hash::make($inputUserData['email']);
        $row = User::create($inputUserData);
        $inputUserDetailsData['user_id'] = $row->id;
        $addDetails = UserDetail::create($inputUserDetailsData);
        if ($row && $row->id > 0) {
            return ['success' => true,'user'=>$row->id];
        } else {
            return ['success' => false];
        }
    }

    public function getAll(){
        $employees = User::with('userDetails')->with('userDetails.department')->where('role_id','!=',1)->get();
        $data = array();
        foreach($employees as $key=>$value){
            $data[$key]['id'] = $value->id;
            $data[$key]['name'] = $value->name;
            $data[$key]['email'] = $value->email;
            $data[$key]['date_of_birth'] = $value->userDetails->date_of_birth;
            $data[$key]['phone'] = $value->userDetails->phone;
            $data[$key]['address'] = $value->userDetails->address;
            $data[$key]['department'] = $value->userDetails->department->name;
        }
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="/edit/'.$row['id'].'" class="edit btn btn-success btn-sm">Edit</a> <button onclick="deleteEmployee('.$row['id'].')" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function update($inputUserData,$inputUserDetailsData,$id){
        if ($id > 0) {
            $row = User::where('id',$id)->update($inputUserData);
            $userDetailsUpdate = UserDetail::where('user_id',$id)->update($inputUserDetailsData);
            if ($row) {
                return ['success' => true];
            } else {
                return ['success' => false];
            }
        } else {
            return ['success' => false];
        }
    }

    public function delete($id){
        if ($id > 0) {
            $row = User::find($id);
            if ($row) {
                $row->delete();
                return ['success' => true];
            } else {
                return ['success' => false];
            }
        } else {
            return ['success' => false];
        }
    }
}
