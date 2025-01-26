@extends('master')

@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Products</h3>
                </div>
                <div class="card-body">

                    <form action="{{ route('employee_update') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="mb-3">
                            <label for="" class="form-label">Employee Id</label>
                            <input type="hidden" value="{{ $employees_info->id }}" name="employee_id">
                            <input type="text" class="form-control" name="emp_id" value ={{$employees_info->emp_id}}>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="">Employee Name</label>
                            <input type="hidden" value="{{ $employees_info->id }}" name="employee_name">
                            <input type="text" class="form-control" value="{{ $employees_info->emp_name }}"
                                name="emp_name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="">Joining Date</label>
                            <input type="hidden" value="{{ $employees_info->id }}" name="employee_date">
                            <input type="text" class="form-control" value="{{ $employees_info->join_date }}"
                                name="join_date">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="">Phone Number</label>
                            <input type="hidden" value="{{ $employees_info->id }}" name="employee_number">
                            <input type="text" class="form-control" value="{{ $employees_info->phone_number }}"
                                name="phone_number">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="">Email</label>
                            <input type="hidden" value="{{ $employees_info->id }}" name="employee_email">
                            <input type="text" class="form-control" value="{{ $employees_info->email }}" name="email">
                        </div>
                        <div class="mb-3">
                            <input type="file" name="picture" value="" class="form-control"
                                onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <img src="{{ asset('uploads/employees') }}/{{ $employees_info->picture }}" id="blah"
                                alt="" width="200">
                        </div>
                        <button class="btn btn-success" type="submit">submit</button>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
