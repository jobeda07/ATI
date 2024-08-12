@extends('backend.master')

@section('content')
<div class="pagetitle">
    <h1>Edit Employee</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employees</a></li>
            <li class="breadcrumb-item active">Edit Employee</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Employee Information</h5>

                    <!-- Displaying Errors -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Edit Form -->
                    <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $employee->name) }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $employee->email) }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}" required>
                            </div>
                        </div>
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male" {{ old('gender', $employee->gender) == 'Male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="Female" {{ old('gender', $employee->gender) == 'Female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row mb-3">
                            <label for="joindate" class="col-sm-2 col-form-label">Joining Date</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="joindate" name="joindate" value="{{ old('joindate', $employee->joindate) }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="salary" class="col-sm-2 col-form-label">Salary</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="salary" name="salary" value="{{ old('salary', $employee->salary) }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="department_id" class="col-sm-2 col-form-label">Department</label>
                            <div class="col-sm-10">
                                <select id="department_id" class="form-control" name="department_id" required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="image" name="image">
                                @if($employee->image)
                                    <img src="{{ asset($employee->image) }}" alt="Employee Image" class="img-thumbnail mt-2" width="150">
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="address" name="address" rows="4" required>{{ old('address', $employee->address) }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
