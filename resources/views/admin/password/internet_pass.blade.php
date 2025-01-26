@extends('master')
@section('content')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
        data-whatever="@mdo">Add</button>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('internet_pass_store')}}" Method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Internet Name</label>
                            <input class="form-control" name="internet_name" required></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Position</label>
                            <input class="form-control" name="position"></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Password</label>
                            <input class="form-control" type="text" name="password" required></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Company</label>
                            <input class="form-control" type="text" name="company" required></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Note</label>
                            <input class="form-control" type="text" name="note" required></input>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal end-->

    <!--display form start-->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Internet Password List</h3>
                </div>
                @if (session('delete_employee'))
                    <div class="alert alert-success">{{ session('delete_employee') }}</div>
                @endif
                <div class="card-body">
                    <table class="table table-striped table table-bordered ">
                        <thead class="bg-info text-white">
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Internet Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">Password</th>
                                <th scope="col">Company</th>
                                <th scope="col">Note</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <thead>
                            @foreach ($internet_pass_info as $key => $internet_pass_info)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $internet_pass_info->internet_name }}</td>
                                    <td>{{ $internet_pass_info->position }}</td>
                                    <td>{{ $internet_pass_info->password }}</td>
                                    <td>{{ $internet_pass_info->company }}</td>
                                    <td>{{ $internet_pass_info->note }}</td>
                                    <td>
                                        <button class="border-0 bg-white"><a class="text-primary"
                                                href=""><i class="fa fa-edit "
                                                    style="font-size:20px;"></a></i></button>
                                        <button class="border-0  bg-white"><a class="text-danger"
                                                href="{{route('internet_pass_delete', $internet_pass_info->id)}}"><i
                                                    class="fa fa-trash " style="font-size:20px;"></a></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Ajax code -->
@endsection
