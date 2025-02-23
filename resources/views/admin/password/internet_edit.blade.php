@extends('master')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Internet info</h3>
                </div>
                <div class="card-body">

                    <form action="{{route('internet_update')}}" Method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">internet_name</label>
                            <input class="form-control" type="hidden" name="internet_id" value={{$internet_pass_info->id}}>
                            <input type="text" class="form-control" name="internet_name" value={{$internet_pass_info->internet_name}}></input>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">position</label>
                            <input class="form-control" type="hidden" name="int_position" value={{$internet_pass_info->id}}>
                            <input type="text" class="form-control" name="position" value={{$internet_pass_info->position}}></input>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">position</label>
                            <input class="form-control" type="hidden" name="int_position" value={{$internet_pass_info->id}}>
                            <input type="text" class="form-control" name="password" value={{$internet_pass_info->password}}></input>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
