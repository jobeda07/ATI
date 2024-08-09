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
              <h5 class="card-title">Employees</h5>
              <a href="{{route('employee.create')}}" class="btn btn-primary" >Create</a>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <b>N</b>ame
                    </th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th data-type="date" data-format="YYYY/DD/MM">join Date</th>
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($employees as $item)
                    <tr>
                      <td>
                        <div class="d-flex justify-content-between">
                          <img src="{{ asset($item->image) }}" alt="" width="50" height="50">
                          <p> {{$item->name}}</p>
                        </div>
                       </td>
                      <td>{{$item->phone}}</td>
                      <td>{{$item->email}}</td>
                      <td>{{$item->joindate}}</td>
                      <td>{{$item->address}}</td>
                      <td>
                        <a href="{{route('employee.edit',$item->id)}}">Edit</a>
                        <a href="{{route('employee.delete',$item->id)}}">Delete</a>
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