@extends('master')

@section('content')
<div class="row ">
    <div class="col-md-12">
        <div class="col-md-7 p-2">
            <h5 class="text-white">History List</h5>
        </div>

        <div class="col-md-3 top_search">
            <form action="" method="GET">
                <div class="input-group">
                    <input type="search" class="form-control" name="search" placeholder="Search for..."
                        value="{{$search}}">
                    <button class="btn btn-secondary" type="submit">Go!</button>
                </div>
            </form>
        </div>
        <div class="col-md-2 ">
            <form action="{{route('history_export')}}" method="GET">
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
                                @foreach ($issue_info as $key => $issue_info)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $issue_info->asset_tag }}</td>
                                    <td>{{ $issue_info->asset_type }}</td>
                                    <td>{{ $issue_info->model }}</td>
                                    <td>{{ $issue_info->description }}</td>
                                    <td>{{ $issue_info->others }}</td>
                                    <td>{{ $issue_info->emp_id }}</td>
                                    <td>{{ $issue_info->emp_name }}</td>
                                    <td>{{ $issue_info->designation_id }}</td>
                                    <td>{{ $issue_info->department_id }}</td>
                                    <td>{{ $issue_info->phone_number }}</td>
                                    <td>{{ $issue_info->email }}</td>
                                    <td>{{ $issue_info->others }}</td>
                                    <td>{{ $issue_info->issue_date }}</td>
                                    <td>{{ $issue_info->return_date }}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
