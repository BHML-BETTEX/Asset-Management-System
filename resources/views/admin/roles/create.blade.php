@extends('master')

@section('content')
    <!-- Button trigger modal -->
    <div class="row">
        <div class="col-md-4">
            <div class="row m-auto p-1">
                <h4 class="text-white ">Role Managment </h4>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('roles.index') }}" class="btn btn-info">Back</a>
                            <form action="{{ route('roles_store') }}" Method="POST" enctype="multipart/form-data">
                        @csrf
                                <div class="form-group">
                                    <label for="text">Role Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>

                                <div>
                                    <h3>Permission:</h3>
                                    @foreach ($permission as $permission)
                                        <label><input type="checkbox" name="permision[{{ $permission->name}}]" value="{{  $permission->name}}">{{  $permission->name}}</label><br/>
                                    @endforeach
                                </div>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection