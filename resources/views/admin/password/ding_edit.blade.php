@extends('master')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Ding info</h3>
                </div>
                <div class="card-body">
                        <form action="{{ route('ding_update') }}" Method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Display Name</label>
                                <input class="form-control" type="hidden" name="ding_id" value={{$dingpass_info->id}}>
                                <input class="form-control" type="text" name="display_name" value={{$dingpass_info->display_name}}></input>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Mail Address</label>
                                <input class="form-control" type="hidden" name="mail" value={{$dingpass_info->id}}>
                                <input class="form-control" type="mail" name="mail_id"  value={{$dingpass_info->mail_id}}></input>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Phone</label>
                                <input class="form-control" type="hidden" name="number" value={{$dingpass_info->id}}>
                                <input class="form-control" type="number" name="phone" value={{$dingpass_info->phone}}></input>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Password</label>
                                <input class="form-control" type="hidden" name="pass" value={{$dingpass_info->id}}>
                                <input class="form-control" type="text" name="password" value={{$dingpass_info->password}}></input>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Note</label>
                                <input class="form-control" type="hidden" name="noted" value={{$dingpass_info->id}}>
                                <input class="form-control" type="text" name="note" value={{$dingpass_info->note}}></input>
                            </div>
                            <button class="btn btn-primary">Submit</button>
                            <a href="{{route('ding_pass')}}" class="btn btn-info">Back</a>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
