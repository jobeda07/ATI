@extends('backend.master')
@section('content')
<div class="pagetitle">
    <h1>Department-wise Employees</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Employees</li>
            <li class="breadcrumb-item active">Department-wise</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Select Department</h5>

                    <!-- Department Selection Form -->
                    <div class="row mb-3">
                        <label for="department" class="col-sm-2 col-form-label">Department</label>
                        <div class="col-sm-10">
                            <select id="department_id" class="form-control">
                                <option value="">-- Select a Department --</option>
                                @foreach ($departments as $department)
                                <option value="{{ $department->id }}">
                                    {{ $department->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div><!-- End Department Selection Form -->

                    <!-- Employees Table -->
                    <div id="employee-table" class="table-responsive">
                        <h5 class="text-center">Select a department to view employees.</h5>
                    </div><!-- End Employees Table -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Add this in your Blade template before the script using jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#department_id').change(function() {
        var department_id = $(this).val();
        if (department_id) {
            $.ajax({
                url: '{{ route("get.department.employees") }}',
                type: 'GET',
                data: { department_id: department_id },
                success: function(response) {
                    $('#employee-table').html(response);
                }
            });
        } else {
            $('#employee-table').html('<h5 class="text-center">Select a department to view employees.</h5>');
        }
    });
});
</script>
@endsection
