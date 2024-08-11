<?php

namespace App\Http\Controllers\backend;

use App\Models\Message;
use App\Models\Employee;
use App\Models\Department;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class EmployeeController extends Controller
{
    use ImageUpload;
   
    public function index(){
        $employees=Employee::latest()->get();
        return view('backend.employee.index',compact('employees'));
    }
    public function create(){
        $department=Department::all();
        return view('backend.employee.create',compact('department'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|digits:11|unique:employees,phone',
            'joindate' => 'required',
            'gender' => 'required',
            'image' => 'required',
            'address' => 'required',
        ]);
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->department_id = $request->department_id;
        $employee->joindate = $request->joindate;
        $employee->gender = $request->gender;
        $employee->salary = $request->salary;
        $employee->address = $request->address;
        if ($request->file('image')) {
            $filename = $this->imageUpload($request->image, 148, 177, 'uploads/employee/');
            $employee->image = 'uploads/employee/'.$filename;
        }
        $employee->save();
        return redirect()->route('employee.index');
    }
    
    public function edit($id){
        $employee=Employee::find($id);
        $department=Department::all();
        return view('backend.employee.edit',compact('employee','department'));
    }
    public function update(Request $request, $id){
         $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:employees,email' . $id,
             'phone' => 'required|digits:11|unique:employees,phone,' . $id,
            'joindate' => 'required',
            'gender' => 'required',
            'image' => 'required',
            'address' => 'required',
        ]);
        $employee =Employee::find($id);
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->department_id = $request->department_id;
        $employee->joindate = $request->joindate;
        $employee->gender = $request->gender;
        $employee->salary = $request->salary;
        $employee->address = $request->address;
        if ($request->file('image')) {
            $this->deleteOne('uploads/employee/', $employee->image);
            $filename = $this->imageUpload($request->image, 148, 177, 'uploads/employee/');
            $employee->image = 'uploads/employee/'.$filename;
        }else{
            $employee->image = $employee->image;
        }
        $employee->save();
        return redirect()->route('employee.index');
    }
    public function delete($id){
        $employee=Employee::find($id);
        $this->deleteOne('uploads/employee/', $employee->image);
        $employee->delete();
        return back();
    }

    
}
