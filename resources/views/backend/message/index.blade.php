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
         <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                <form action="{{route('message.store')}}" method="post" enctype="multipart/form-data">
                   @csrf               
                    <div class="col-12 pt-4">
                  <label for="inputNanme4" class="form-label">Phone</label>
                  <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                </div>
                <div class="col-12">
                  <label for="inputNanme4" class="form-label">Message</label>
                    <textarea class="form-control" name="message" style="height: 100px">{{old('message')}}</textarea>
                </div>
                <div class="col-12 pt-3">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
                </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Messages</h5>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th> Phone </th>
                    <th>Message</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($messages as $item)
                    <tr>
                      <td>{{$item->phone}}</td>
                      <td>{{$item->message}}</td>
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