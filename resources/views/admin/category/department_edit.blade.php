@extends('master')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            @if (session('category_update'))
                <div class="alert alert-primary">{{ session('category_update') }}</div>
            @endif
            <div class="card p-1">
                <div class="card-header " style="background-color: #0cb0b7;">
                    <h3 class="text-white">Update Department</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('department.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Department_name</label>
                            <input type="hidden" value="{{ $all_departments->id }}" name="department_id">
                            <input type="text" class="form-control" name="department_name"
                                value="{{ $all_departments->department_name }}">
                            @error('department_name')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
