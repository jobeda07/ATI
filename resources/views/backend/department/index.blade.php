@extends('backend.master')
@section('content')
<div class="pagetitle">
      <h1>Data Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Department</h5>
              <a href="{{route('departments.create')}}" class="btn btn-primary" >Create</a>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <b>N</b>ame
                    </th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($departments as $item)
                    <tr>
                      <td>{{$item->name}}</td>
                      <td>
                        <a href="{{route('departments.edit',$item->id)}}" class="btn btn-success">Edit</a>
                        <a href="{{route('departments.destroy',$item->id)}}" class="btn btn-danger">Delete</a>
                      </td>
                     </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
@endsection