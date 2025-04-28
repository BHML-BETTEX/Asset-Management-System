@extends('master')

@section('content')
<div class="row ">
    <div class="col-md-12">
        <div class="col-md-7 p-2">
            <h5 class="text-white">History List</h5>
        </div>

        <div class="col-md-2 top_search">
            <form action="" method="GET">
                <div class="input-group">
                    <input type="search" class="form-control" name="search" placeholder="Search for..."
                        value="{{$search}}">
                    <button class="btn btn-info" type="submit"><span class="fa fa-search"></span></button>
                </div>
            </form>
        </div>
        <div class="col-md-2 ">
            <form action="{{route('history_export')}}" method="GET">
                <div class="input-group">
                    @foreach ($_GET as $key=> $item)
                    <input type="hidden" name="{{$key}}" value="{{$item}}">
                    @endforeach
                    <select name="type" class="form-control">
                        <option value="">Select Type</option>
                        <option value="xlsx">XLSX</option>
                        <option value="csv">CSV</option>
                        <option value="xls">XLS</option>
                    </select>
                    <button type="submit" class="btn btn-success"><span class="fa fa-file-excel-o"></button>
                </div>
            </form>
        </div>
        <div class="col-md-1 ">
            <div class="input-group">
                <a href="{{route('pdf.history', $_GET)}}">
                    <button class="btn btn-info"><i class="fa fa-download"></i> PDF</button>

            </div>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped table-bordered">
                        <thead class="bg-info text-white table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>ASSET TAG</th>
                                <th>ASSET TYPE</th>
                                <th>MODEL</th>
                                <th>DESCRIPTION</th>
                                <th>COMPANY</th>
                                <th>EMP ID</th>
                                <th>EMP NAME</th>
                                <th>DESIGNATION</th>
                                <th>DEPARTMENT</th>
                                <th>PHONE NUMBER</th>
                                <th>EMAIL</th>
                                <th>NOTE</th>
                                <th>ISSUE DATE</th>
                                <th>RETURN DATE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($issue_info as $key => $issue_infos)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $issue_infos->asset_tag }}</td>
                                <td>{{ $issue_infos->asset_type }}</td>
                                <td>{{ $issue_infos->model }}</td>
                                <td>{{ $issue_infos->description }}</td>
                                <td>{{ $issue_infos->others }}</td>
                                <td>{{ $issue_infos->emp_id }}</td>
                                <td>{{ $issue_infos->emp_name }}</td>
                                <td>{{ $issue_infos->designation_id }}</td>
                                <td>{{ $issue_infos->department_id }}</td>
                                <td>{{ $issue_infos->phone_number }}</td>
                                <td>{{ $issue_infos->email }}</td>
                                <td></td>
                                <td>{{ $issue_infos->issue_date }}</td>
                                <td>{{ $issue_infos->return_date }}</td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$issue_info->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection