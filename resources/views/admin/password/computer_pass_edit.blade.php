@extends('master')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Computer Password info</h3>
                </div>
                <div class="card-body">

                    <form action="{{route('computer_update')}}" Method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Asset Tag</label>
                            <input class="form-control" type="hidden" name="id" value={{$com_pass_info->id}}>
                            <input type="text" class="form-control" name="asset_tag" value={{$com_pass_info->asset_tag}} readonly></input>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Employee ID</label>
                            <input class="form-control" type="hidden" name="empl_id" value={{$com_pass_info->id}}>
                            <input type="text" class="form-control" name="emp_id" value={{$com_pass_info->emp_id}} readonly></input>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Employee Name</label>
                            <input class="form-control" type="hidden" name="name" value={{$com_pass_info->id}}>
                            <input type="text" class="form-control" name="emp_name" value={{$com_pass_info->emp_name}} readonly></input>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Password</label>
                            <input class="form-control" type="hidden" name="com_password" value={{$com_pass_info->id}}>
                            <input type="text" class="form-control" name="password" value={{$com_pass_info->password}}></input>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
