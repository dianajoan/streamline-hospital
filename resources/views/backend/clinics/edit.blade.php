@extends('backend.layouts.master')
@section('title') Edit Clinic @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Edit Clinic</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('admin')}}">Dashboard</a></li>
                          <li><a href="{{ route('clinics.index') }}">View</a></li>
                          <li class="active">Edit</li>
                      </ol>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="content">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
              <strong>Edit</strong>
          </div>
          <div class="card-body card-block">
            <form method="post" action="{{route('clinics.update',$clinic->id)}}">
              @csrf 
              @method('PATCH')

              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif


              <div class="form-group">
                <label for="inputTitle" class="col-form-label">Name</label>
                <input id="inputTitle" type="text" name="name" placeholder=""  value="{{$clinic->name}}" class="form-control" required>
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="status" class="col-form-label">Status</label>
                <select name="status" class="form-control">
                  <option value="active" {{(($clinic->status=='active') ? 'selected' : '')}}>Active</option>
                  <option value="inactive" {{(($clinic->status=='inactive') ? 'selected' : '')}}>Inactive</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="form-group mb-3">
                <button class="btn btn-success" type="submit">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
