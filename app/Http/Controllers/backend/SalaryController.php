<?php

namespace App\Http\Controllers\backend;
use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class SalaryController extends Controller
{
    
    public function create()
    {
        $employees = Employee::all();
        return view('backend.salaries.generate', compact('employees'));
    }

    public function generateSlip(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|string',
            'total_working_days' => 'required|integer',
            'attending_days' => 'required|integer',
        ]);

        $employee = Employee::find($request->employee_id);
        $baseSalary = $employee->salary;

        // Calculate the salary based on attendance
        $totalSalary = Salary::calculateTotalSalary($baseSalary, $request->attending_days, $request->total_working_days);
        $salary = new Salary();
        $salary->employee_id = $request->employee_id;
        $salary->month = $request->month;
        $salary->total_working_days = $request->total_working_days;
        $salary->attending_days = $request->attending_days;  
        $salary->total_salary = $totalSalary; 
        $salary->save();
         
        // Return the data to the view
        return view('backend.salaries.generate', compact('employee', 'request', 'totalSalary'))->with('employees', Employee::all());



public function generatePdf(Request $request)
    {
        $employee = Employee::findOrFail($request->employee_id);
        $totalSalary = $employee->salary * ($request->attending_days / $request->total_working_days);

        $pdf = Pdf::loadView('backend.salaries.salary_invoice', [
            'employee' => $employee,
            'totalSalary' => $totalSalary,
            'request' => $request,
        ]);

        return $pdf->download('salary-slip-' . $employee->name . '-' . $request->month . '.pdf');
    }
   

}
