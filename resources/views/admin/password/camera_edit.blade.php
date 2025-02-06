@extends('master')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Camera info</h3>
                </div>
                <div class="card-body">

                    <form action="{{route('camera_update')}}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Camera No</label>
                            <input type="hidden" value="{{ $camera_info->id }}" name="name">
                            <input class="form-control" name="camera_no" value ={{$camera_info->camera_no}}></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Camera Position</label>
                            <input type="hidden" value="{{ $camera_info->id }}" name="name">
                            <input class="form-control" name="possition" value ={{$camera_info->possition}}></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Password</label>
                            <input type="hidden" value="{{ $camera_info->id }}" name="name">
                            <input class="form-control" name="password" value ={{$camera_info->password}}></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Note</label>
                            <input type="hidden" value="{{ $camera_info->id }}" name="name">
                            <input class="form-control" type="text" name="others" value ={{$camera_info->others}}></input>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
