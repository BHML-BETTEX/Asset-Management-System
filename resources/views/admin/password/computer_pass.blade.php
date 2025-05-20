@extends('master')
@section('content')
<div class="container">
    <div class="page-title">
        <div class="row ">
            <div class="col-md-12">
                <div class="col-md-5 p-2">
                    <h5 class="text-white">Computer Password List</h5>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"
                        data-whatever="@mdo"><span class="fa fa-plus"> Add</span></button>
                </div>

                <div class="col-md-4 top_search">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" placeholder="Search for..."
                                value="{{ $search }}">
                            <button class="btn btn-secondary" type="submit">Go!</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 ">
                    <form action="{{ route('computer_export') }}" method="GET">                        
                            @foreach ($_GET as $key=> $item)
                                <input type="hidden" name="{{$key}}" value="{{$item}}">
                            @endforeach
                        <div class="input-group">
                            <select name="type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="xlsx">XLSX</option>
                                <option value="csv">CSV</option>
                                <option value="xls">XLS</option>
                            </select>
                            <button type="submit" class="btn btn-success">Export</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Computer Password Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('computer_pass_store') }}" Method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Asset Tag <span class="text-danger">*</span></label>
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
                                <label for="message-text" class="col-form-label">Password <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="password" required></input>
                            </div>

                            <div class="form-group">
                                <label for="form_label">Company <span class="text-danger">*</span><a class="text-success" href=""></a></label>
                                <select id="form_need" name="company" class="form-control" required>
                                    <option value="" selected disabled>--Select Your
                                        Issue--</option>
                                    @foreach ($all_company as $all_company)
                                    <option value="{{ $all_company->company }}">
                                        {{ $all_company->company }}
                                    </option>
                                    @endforeach
                                </select>
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
                                    <th scope="col">Company</th>
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
                                    <td>{{ $computer_pass->company }}</td>
                                    <td></td>
                                    <td>
                                        <button class="border-0 bg-white"><a class="text-primary"
                                                href="{{ route('computer_pass_edit', $computer_pass->id) }}"><i
                                                    class="fa fa-edit " style="font-size:20px;"></a></i></button>
                                        <button class="border-0  bg-white"><a class="text-danger"
                                                href="{{ route('computer_pass_delete', $computer_pass->id) }}"><i
                                                    class="fa fa-trash " style="font-size:20px;"></a></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </thead>
                        </table>
                        {{$computer_password->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ajax code -->
@endsection