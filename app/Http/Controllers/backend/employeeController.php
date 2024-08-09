<?php

namespace App\Http\Controllers\backend;

use App\Models\Employee;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class employeeController extends Controller
{
    use ImageUpload;
    public function index(){
        $employees=Employee::latest()->get();
        return view('backend.employee.index',compact('employees'));
    }
    public function create(){
        return view('backend.employee.create');
    }

    public function store(Request $request){
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->joindate = $request->joindate;
        $employee->gender = $request->gender;
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
        return view('backend.employee.edit',compact('employee'));
    }
    public function update(Request $request, $id){
        $employee =Employee::find($id);
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->joindate = $request->joindate;
        $employee->gender = $request->gender;
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
