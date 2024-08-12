<?php

namespace App\Http\Controllers\Backend;

use App\Models\Employee;
use App\Models\Department;
use App\Traits\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    use Image;

    // Display a listing of employees
    public function index()
    {
        $employees = Employee::latest()->get();
        return view('backend.employee.index', compact('employees'));
    }

    // Show the form for creating a new employee
    public function create()
    {
        $departments = Department::all();
        return view('backend.employee.create', compact('departments'));
    }

    // Store a newly created employee in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|digits:11|unique:employees,phone',
            'joindate' => 'required|date',
            'gender' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'required',
            'salary' => 'required|numeric',
            'department_id' => 'required|exists:departments,id',
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

        if ($request->hasFile('image')) {
            $filename = $this->imageUpload($request->file('image'), 148, 177, 'uploads/employee/');
            $employee->image = 'uploads/employee/' . $filename;
        }

        $employee->save();

        return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
    }

    // Show the form for editing the specified employee
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        return view('backend.employee.edit', compact('employee', 'departments'));
    }

    // Update the specified employee in the database
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:employees,email,' . $id,
            'phone' => 'required|digits:11|unique:employees,phone,' . $id,
            'joindate' => 'required|date',
            'gender' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'address' => 'required',
            'salary' => 'required|numeric',
            'department_id' => 'required|exists:departments,id',
        ]);

        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->department_id = $request->department_id;
        $employee->joindate = $request->joindate;
        $employee->gender = $request->gender;
        $employee->salary = $request->salary;
        $employee->address = $request->address;

        if ($request->hasFile('image')) {
            // Delete the old image
            $this->deleteOne('uploads/employee/', $employee->image);
            // Upload the new image
            $filename = $this->imageUpload($request->file('image'), 148, 177, 'uploads/employee/');
            $employee->image = 'uploads/employee/' . $filename;
        }

        $employee->save();

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');
    }

    // Remove the specified employee from the database
    public function delete($id)
    {
        $employee = Employee::findOrFail($id);
        $this->deleteOne('uploads/employee/', $employee->image);
        $employee->delete();

        return back()->with('success', 'Employee deleted successfully.');
    }
}
