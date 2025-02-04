@extends('master')
@section('content')

        <div class="">
            <div class="page-title">
                <div class="title_left p-1">
                    <h4 class="text-white">Computer password List</h4>
                </div>
                <div class="title_right">
                    <div class="">
                        <div class= "col-md-6">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"
                                data-whatever="@mdo">Add</button>
                        </div>
                        <div class= "col-md-6 top_search">
                            <form action="" method="GET">
                                <div class="input-group">
                                    <input type="search" class="form-control" name="search" placeholder="Search for..."
                                        value={{ $search }}>
                                    <span class="input-group-btn">
                                        <button class="btn btn-secondary" type="submit">Go!</button>
                                    </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                    <form action="{{ route('computer_pass_store') }}" Method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Asset Tag</label>
                            <input class="form-control" name="asset_tag" required></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Employee ID</label>
                            <input class="form-control" name="emp_id"></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Employee Name</label>
                            <input class="form-control" name="emp_name"></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Password</label>
                            <input class="form-control" type="text" name="password" required></input>
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

                @if (session('delete_employee'))
                    <div class="alert alert-success">{{ session('delete_employee') }}</div>
                @endif
                <div class="card-body">
                    <table class="table table-striped table table-bordered ">
                        <thead class="bg-info text-white">
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Asset Tag</th>
                                <th scope="col">Employee Id</th>
                                <th scope="col">Employee Name</th>
                                <th scope="col">Password</th>
                                <th scope="col">Note</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <thead>
                            @foreach ($computer_password as $key => $computer_pass)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $computer_pass->asset_tag }}</td>
                                    <td>{{ $computer_pass->emp_id }}</td>
                                    <td>{{ $computer_pass->emp_name }}</td>
                                    <td>{{ $computer_pass->password }}</td>
                                    <td></td>
                                    <td>
                                        <button class="border-0 bg-white"><a class="text-primary"
                                                href=""><i class="fa fa-edit "
                                                    style="font-size:20px;"></a></i></button>
                                        <button class="border-0  bg-white"><a class="text-danger"
                                                href="{{route ('computer_pass_delete', $computer_pass->id)}}"><i
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
