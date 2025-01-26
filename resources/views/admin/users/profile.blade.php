@extends('master')

@section('content')


<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">User List</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-heder">
                <h3>Change Name</h3>
            </div>
            @if (session ('name'))
                    <div class="alert alert-success">{{ session('name') }}</div>
                @endif

            <div class="card-body">
                <form action="{{route('name.change')}}" method="POST">
                 @csrf 
                    <div class="mb-3">
                        <input type="text"  name="name" value="" class="form-control">
                    </div> 
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary">
                    </div>   
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-heder">
                <h3>Change Password</h3>
            </div>
            @if (session ('password'))
                    <div class="alert alert-success">{{ session('password') }}</div>
                @endif

            <div class="card-body">
                <form action="{{route ('password.change')}}" method="POST">
                 @csrf 
                        @if(session('success'))
                            <strong class="text-primary">{{session ('success')}}</strong>
                        @endif

                    <div class="mb-3">
                        <label for="" class="form-label"> Old Password</label>
                        <input type="password"  name="old_password"  class="form-control">
                        @error('old_password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror

                        @if(session('wrong'))
                            <strong class="text-danger">{{session ('wrong')}}</strong>
                        @endif

                    </div> 
                    <div class="mb-3">
                        <label for="" class="form-label"> New Password</label>
                        <input type="password"  name="new_password"  class="form-control">
                        @error('new_password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div> 
                    <div class="mb-3">
                        <label for="" class="form-label"> Confirm Password</label>
                        <input type="password"  name="confirm_password"  class="form-control">
                        @error('confirm_password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div> 
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" >Update Password</button>
                    </div>   
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-heder">
                <h3>Update Profile_Photo</h3>
            </div>
            <div class="card-body">
                @if (session ('photo_success'))
                    <div class="alert alert-success">{{ session('photo_success') }}</div>
                @endif
                <form action="" method="POST" enctype="multipart/form-data">
                 @csrf 
                    <div class="mb-3">
                        <input type="file"  name="profile_photo" value="" class="form-control">
                    </div> 
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary">
                    </div>   
                </form>
            </div>
        </div>
    </div>
</div>




@endsection