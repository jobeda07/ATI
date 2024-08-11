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
            'name' => 'required|string|max:255',
        ]);

        $department = Department::create($request->all());
        return response()->json($department, 201);
    }

    public function show($id)
    {
        return Department::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department = Department::findOrFail($id);
        $department->update($request->all());
        return response()->json($department, 200);
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return response()->json(null, 204);
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