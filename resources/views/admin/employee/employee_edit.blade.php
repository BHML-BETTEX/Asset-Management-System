@extends('master')

@section('content')
<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Edit Employee</h3>
            </div>
            <div class="card-body">

                <form action="{{ route('employee_update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label for="" class="form-label">Employee Id</label>
                            <input type="hidden" value="{{ $employees_info->id }}" name="employee_id">
                            <input type="text" class="form-control" name="emp_id" value={{$employees_info->emp_id}}>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="">Employee Name</label>
                            <input type="hidden" value="{{ $employees_info->id }}" name="employee_name">
                            <input type="text" class="form-control" value="{{ $employees_info->emp_name }}"
                                name="emp_name">
                        </div>
                    </div>
                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label class="form-label" for="">Joining Date</label>
                            <input type="hidden" value="{{ $employees_info->id }}" name="employee_date">
                            <input type="text" class="form-control" value="{{ $employees_info->join_date }}"
                                name="join_date">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="">Phone Number</label>
                            <input type="hidden" value="{{ $employees_info->id }}" name="employee_number">
                            <input type="text" class="form-control" value="{{ $employees_info->phone_number }}"
                                name="phone_number">
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Company <span class="text-danger">*</span></label>
                            <select class="form-control select2-modal" name="company" id="company_select" required>
                                @foreach ($companies as $comp)
                                <option value="{{ $comp->id }}" {{ $employees_info->company == $comp->id ? 'selected' : '' }}>
                                    {{ $comp->company }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Department <span class="text-danger">*</span></label>
                            <select class="form-control select2-modal" name="department_id" id="department_select" required>
                                @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ $employees_info->department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->department_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Designation</label>
                            <select class="form-control select2-modal" name="designation_id" id="designation_select">
                                @foreach ($designation as $desig)
                                <option value="{{ $desig->id }}" {{ $employees_info->designation_id == $desig->id ? 'selected' : '' }}>
                                    {{ $desig->designation_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="">Email</label>
                            <input type="hidden" value="{{ $employees_info->id }}" name="employee_email">
                            <input type="text" class="form-control" value="{{ $employees_info->email }}" name="email">
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Other Info</label>
                            <input type="text"
                                name="others"
                                class="form-control"
                                value="{{ $employees_info->others }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="active" {{ $employees_info->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $employees_info->status == 'inactive' ? 'selected' : '' }}>In Active</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-3">
                        <input type="file" name="picture" value="" class="form-control"
                            onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <img src="{{ asset('uploads/employees') }}/{{ $employees_info->picture }}" id="blah"
                            alt="" width="200">
                    </div>


                    <button class="btn btn-success" type="submit">submit</button>
                    <a href="{{route('employee')}}" class="btn btn-info">Back</a>
                    <div class="modal-footer">

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection