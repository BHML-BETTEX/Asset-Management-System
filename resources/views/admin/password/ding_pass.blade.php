@extends('master')
@section('content')
<div class="container">
    <div class="page-title">
        <div class="row ">
            <div class="col-md-12">
                <div class="col-md-5 p-2">
                    <h5 class="text-white">Ding Password List</h5>
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
                    <form action="{{route('ding_export')}}" method="GET">
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
                        <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('ding_pass_store') }}" Method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Display Name</label>
                                <input class="form-control" type="text" name="display_name" required></input>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Mail Address</label>
                                <input class="form-control" type="mail" name="mail_id" required></input>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Phone</label>
                                <input class="form-control" type="number" name="phone"></input>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Password</label>
                                <input class="form-control" type="text" name="password" required></input>
                            </div>
                            <div class="form-group">
                                <label for="form_label">Company </span><a class="text-success" href=""><i
                                            class="fa fa-plus" style="font-size:10px;"></a></i></label>
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
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Note</label>
                                <input class="form-control" type="text" name="note"></input>
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
                                    <th scope="col">Display Name</th>
                                    <th scope="col">Mail Address</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Note</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <thead>
                                @foreach ($dingpass_info as $key => $dingpass)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $dingpass->display_name }}</td>
                                    <td>{{ $dingpass->mail_id }}</td>
                                    <td>{{ $dingpass->phone }}</td>
                                    <td>{{ $dingpass->password }}</td>
                                    <td>{{ $dingpass->company }}</td>
                                    <td>{{ $dingpass->note }}</td>
                                    <td>
                                        <button class="border-0 bg-white"><a class="text-primary"
                                                href="{{ route('ding_edit', $dingpass->id) }}"><i
                                                    class="fa fa-edit " style="font-size:20px;"></a></i></button>
                                        <button class="border-0  bg-white"><a class="text-danger"
                                                href="{{ route('ding_pass_delete', $dingpass->id) }}"><i
                                                    class="fa fa-trash " style="font-size:20px;"></a></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </thead>
                        </table>

                        {{$dingpass_info->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Ajax code -->
@endsection