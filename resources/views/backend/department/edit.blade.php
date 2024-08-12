@extends('backend.master')
@section('content')
<div class="pagetitle">
    <h1>Form Elements</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item active">Elements</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-10 mx-auto">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">General Form Elements</h5>

                    <!-- General Form Elements -->
                    <form action="{{route('departments.update',$department->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{$department->name}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit Form</button>
                            </div>
                        </div>
                    </form><!-- End General Form Elements -->
                </div>
            </div>

        </div>
    </div>
</section>
@endsection