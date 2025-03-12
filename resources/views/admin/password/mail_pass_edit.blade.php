@extends('master')
@section('content')

<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Edit Mail Info</h3>
            </div>
            <div class="card-body">

                <form action="{{route('mail_pass_update')}}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="mb-3">
                        <label for="" class="form-label">Display name</label>
                        <input type="hidden" value="{{ $mail_info->id }}" name="mail_id">
                        <input  class="form-control" name="display_name" value ={{$mail_info->display_name}}>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Mail Address</label>
                        <input type="hidden" value="{{ $mail_info->id }}" name="address">
                        <input  class="form-control" name="mail_address" value ={{$mail_info->mail_address}}>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="hidden" value="{{ $mail_info->id }}" name="pass">
                        <input  class="form-control" name="password" value ={{$mail_info->password}}>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Others</label>
                        <input type="hidden" value="{{ $mail_info->id }}" name="pass_others">
                        <input  class="form-control" name="others" value ={{$mail_info->others}}>
                    </div>

                    <button class="btn btn-success" type="submit">submit</button>
                    <a href="{{route('mail_pass')}}" class="btn btn-info">Back</a>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
