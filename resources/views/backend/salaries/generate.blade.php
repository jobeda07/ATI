@extends('backend.master')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">
                <h2>Generate Salary Slip</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('salaries.generateSlip') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Select Employee</label>
                        <select name="employee_id" id="employee_id" class="form-select" required>
                            <option value="" disabled selected>Choose an Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="month" class="form-label">Month</label>
                        <input type="text" name="month" id="month" class="form-control" placeholder="e.g. January 2024" required>
                    </div>

                    <div class="mb-3">
                        <label for="total_working_days" class="form-label">Total Working Days</label>
                        <input type="number" name="total_working_days" id="total_working_days" class="form-control" placeholder="e.g. 30" required>
                    </div>

                    <div class="mb-3">
                        <label for="attending_days" class="form-label">Attending Working Days</label>
                        <input type="number" name="attending_days" id="attending_days" class="form-control" placeholder="e.g. 28" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Generate Slip</button>
                    </div>
                </form>
            </div>
        </div>

        @if(isset($totalSalary))
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h2>Salary Slip - Invoice</h2>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <strong>Employee Name:</strong> {{ $employee->name }}<br>
                            <strong>Employee ID:</strong> {{ $employee->id }}
                        </div>
                        <div class="col text-end">
                            <strong>Month:</strong> {{ $request->month }}<br>
                            <strong>Date:</strong> {{ now()->format('d-m-Y') }}
                        </div>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th class="text-end">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Base Salary</td>
                                <td class="text-end">${{ number_format($employee->salary, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Attendance Bonus</td>
                                <td class="text-end">${{ number_format($totalSalary - $employee->salary, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Total Working Days</td>
                                <td class="text-end">{{ $request->total_working_days }} days</td>
                            </tr>
                            <tr>
                                <td>Attending Working Days</td>
                                <td class="text-end">{{ $request->attending_days }} days</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total Salary</th>
                                <th class="text-end">${{ number_format($totalSalary, 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>

           <div class="d-grid">
    <form action="{{ route('salaries.generatePdf') }}" method="POST">
    @csrf
    <input type="hidden" name="employee_id" value="{{ $employee->id }}">
    <input type="hidden" name="month" value="{{ $request->month }}">
    <input type="hidden" name="total_working_days" value="{{ $request->total_working_days }}">
    <input type="hidden" name="attending_days" value="{{ $request->attending_days }}">
    <button type="submit" class="btn btn-secondary mt-3">Download PDF</button>
</form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
