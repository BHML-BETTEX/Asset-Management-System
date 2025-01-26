@extends('master')

@section('content')
    <div class="row">

        <div class="col-lg-8 m-auto">
        @if (session('designation_update'))
                <div class="alert alert-primary">{{ session('designation_update') }}</div>
            @endif
            <div class="card">
                <div class="card-header" style="background-color: #0cb0b7; color:white;">
                    <h3>Add Designation</h3>
                </div>

                <div class="card-body ">
                    <form action="{{route('designation.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Designation</label>
                            <input type="hidden" value="{{ $designation->id }}" name="designation_id">
                            <input type="text" class="form-control" name="designation_name" value ={{$designation->designation_name}}>

                            @error('designation_update')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
