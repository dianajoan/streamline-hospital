@extends('backend.layouts.master')
@section('title') Edit Appointment @endsection
@section('main-content')
@include('backend.layouts.notification')

<div class="breadcrumbs">
  <div class="breadcrumbs-inner">
      <div class="row m-0">
          <div class="col-sm-4">
              <div class="page-header float-left">
                  <div class="page-title">
                      <h1>Edit Appointment</h1>
                  </div>
              </div>
          </div>
          <div class="col-sm-8">
              <div class="page-header float-right">
                  <div class="page-title">
                      <ol class="breadcrumb text-right">
                          <li><a href="{{ route('admin')}}">Dashboard</a></li>
                          <li><a href="{{ route('appointments.index') }}">Appointment</a></li>
                          <li class="active">Edit Appointment</li>
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
                <strong>Edit Appointment</strong>
            </div>
            <div class="card-body card-block">
              <form method="post" action="{{ route('appointments.update', $appointment->id) }}" enctype="multipart/form-data">
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
                    <label for="patient_id">Patient<span class="text-danger">*</span></label>
                    <select name="patient_id" id="patient_id" class="form-control" required>
                        <option value="">Select Patient</option>
                        @foreach($patients as $patient)
                        <option value="{{ $patient->id }}" {{ $appointment->patient_id == $patient->id ? 'selected' : '' }}>
                            {{ $patient->first_name }} {{ $patient->last_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('patient_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                  <label for="medical_record_id" class="col-form-label">Medical Record</label>
                  <select id="medical_record_id" name="medical_record_id" class="form-control" required>
                    <option value="">Select Medical Record</option>
                    @foreach($medicalRecords as $record)
                      <option value="{{ $record->id }}" {{ $appointment->medical_record_id == $record->id ? 'selected' : '' }}>
                        {{ $record->symptoms }}
                      </option>
                    @endforeach
                  </select>
                  @error('medical_record_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="authenticated_by">Authenticated By <span class="text-danger">*</span></label>
                  <select name="authenticated_by" class="form-control" required>
                      <option value="">----</option>
                      @foreach($users as $key => $data)
                          <option value='{{$data->id}}' {{(($data->id == $appointment->authenticated_by) ? 'selected' : '')}}>{{$data->name}}</option>
                      @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="clinic_id">Clinics <span class="text-danger">*</span></label>
                  <select name="clinic_id" class="form-control" required>
                      <option value="">----</option>
                      @foreach($clinics as $key => $data)
                          <option value='{{$data->id}}' {{(($data->id == $appointment->clinic_id) ? 'selected' : '')}}>{{$data->name}}</option>
                      @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
                  <input id="inputTitle" type="text" name="name" placeholder="" value="{{ $appointment->name }}" class="form-control" required>
                  @error('name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="date" class="col-form-label">Date of Appointment <span class="text-danger">*</span></label>
                  <input id="date" type="datetime-local" name="appointment_date" value="{{ $appointment->appointment_date }}" class="form-control" required>
                  @error('appointment_date')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="inputDesc" class="col-form-label">Clinical Notes <span class="text-danger">*</span></label>
                  <textarea class="form-control ckeditor" id="clinical_notes" name="clinical_notes" required>{{$appointment->clinical_notes}}</textarea>
                  @error('clinical_notes')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                  <select name="status" class="form-control" required>
                    <option value="postponed" {{ ($appointment->status == 'postponed') ? 'selected' : '' }}>Postponed</option>
                    <option value="brought_forward" {{ ($appointment->status == 'brought_forward') ? 'selected' : '' }}>Brought Forward</option>
                    <option value="canceled" {{ ($appointment->status == 'canceled') ? 'selected' : '' }}>Canceled</option>
                    <option value="started" {{ ($appointment->status == 'started') ? 'selected' : '' }}>Started</option>
                    <option value="completed" {{ ($appointment->status == 'completed') ? 'selected' : '' }}>Completed</option>
                  </select>
                  @error('status')
                    <span class="text-danger">{{ $message }}</span>
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

@push('scripts')

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>

@endpush