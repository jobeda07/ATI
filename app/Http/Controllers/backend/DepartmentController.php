<?php

namespace App\Http\Controllers\backend;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('backend.department.index', compact('departments'));
    }

    // Show the form for creating a new department
    public function create()
    {
        return view('backend.department.create');
    }

    // Store a newly created department in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')
                         ->with('success', 'Department created successfully.');
    }

    // Display the specified department
    public function show(Department $department)
    {

        return view('departments.show', compact('department'));
    }

    // Show the form for editing the specified department
    public function edit($department)
    { 
        $department = Department::find($department);
        return view('backend.department.edit', compact('department'));
    }

    // Update the specified department in storage
    public function update(Request $request,$department)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $department =Department::find($department);
        $department->name = $request->name;
        $department->save();

        return redirect()->route('departments.index')
                         ->with('success', 'Department updated successfully.');
    }

    // Remove the specified department from storage
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
                         ->with('success', 'Department deleted successfully.');
    }
    
    public function showDepartmentEmployees()  
    {
    $departments = Department::all();
    return view('backend.department_view.department_employees', compact('departments'));
    }

    public function getDepartmentEmployees(Request $request)
    {
    $department = Department::with('employees')->find($request->department_id);

    if ($department && $department->employees->count()) {
        return view('backend.department_view.view_employee_table', compact('department'))->render();
    } else {
        return '<h5 class="text-center">No employees found in this department.</h5>';
    }
}}