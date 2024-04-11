@extends('backend.layouts.master')
@section('title') Lab Results @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Lab</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                <li><a href="{{ route('admin')}}">Dashboard</a></li>
                <li><a href="{{ route('lab_results.create')}}"> Add Lab</a></li>
                <li class="active">Lab</li>
              </ol>
          </div>
      </div>
  </div>
</div>

<div class="content mt-3">
  <div class="animated fadeIn">
      <div class="row">

          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <strong class="card-title">Lab</strong>
                  </div>
                  <div class="card-body">
                    @if(count($labResults)>0)
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                <th>ID</th>
                                <th>Medical Record</th>
                                <th>Test Name</th>
                                <th>Result Detail</th>
                                <th>Result Date</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($labResults as $lab)
                              @php 
                                $medicalRecord=DB::table('medical_records')->select('visit_date')->where('id',$lab->medical_record_id)->get();
                              @endphp
                              <tr>
                                <td>{{$lab->id}}</td>
                                <td>
                                  @foreach($medicalRecord as $data)
                                    {{$lab->medicalRecord->visit_date}}
                                    @endforeach
                                </td>
                                <td>{{$lab->test_name}}</td>
                                <td>{{$lab->result_detail}}</td>
                                <td>{{$lab->result_date}}</td>
                                <td>
                                    @if($lab->status=='active')
                                        <span class="badge badge-success">{{$lab->status}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$lab->status}}</span>
                                    @endif
                                </td>
                                <td>
                                  <a href="{{route('lab_results.edit',$lab->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                  <form method="POST" action="{{route('lab_results.destroy',[$lab->id])}}">
                                    @csrf 
                                    @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$lab->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                      </form>
                                </td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                      @else
                      <h6 class="text-center">No lab results found!!! Please add lab</h6>
                    @endif
                  </div>
              </div>
          </div>


      </div>
  </div><!-- .animated -->
</div><!-- .content -->

@endsection

