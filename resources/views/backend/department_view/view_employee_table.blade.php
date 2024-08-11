@if($department && $department->employees->count())
    <h5 class="card-title">Employees in {{ $department->name }} Department</h5>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Joining Date</th>
                <th>Salary</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach($department->employees as $employee)
            <tr>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->gender }}</td>
                <td>{{ $employee->joindate }}</td>
                <td>{{ $employee->salary }}</td>
                <td>{{ $employee->address }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <h5 class="text-center">No employees found in this department.</h5>
@endif
