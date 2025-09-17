@extends('master')

@section('content')
<div class="row ">
    <div class="col-md-12">
        <div class="col-md-7 p-2">
            <h5 class="text-white">Departments Assets</h5>
        </div>

        <div class="col-md-2 top_search">
            <form action="" method="GET">
                <div class="input-group">

                </div>
            </form>
        </div>
        <div class="col-md-2 ">
            <form action="" method="GET">
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
                                <th>Employee ID</th>
                                <th>Employee Name</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company</th>
                                <th>Asset</th>
                                <th>Conumable</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $emp)
                            

                            <tr>
                                <td>{{ $emp->emp_id }}</td>
                                <td>{{ $emp->emp_name }}</td>
                                <td>{{ $emp->designation_name ?? '-' }}</td>
                                <td>{{ $emp->department_name ?? '-' }}</td>
                                <td>{{ $emp->email}}</td>
                                <td>{{ $emp->phone}}</td>
                                <td>{{ $emp->company}}</td>
                                <td>{{ $emp->total_asset}}</td>
                                <td>{{$emp->total_consumable}}</td>
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