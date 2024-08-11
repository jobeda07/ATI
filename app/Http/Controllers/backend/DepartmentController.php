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
        return Department::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required|string|max:255',
        ]);

        return Department::create($request->all());
    }

    public function show(Department $department)
    {
        return $department;
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'department' => 'required|string|max:255',
        ]);

        $department->update($request->all());

        return $department;
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return response(null, 204);
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