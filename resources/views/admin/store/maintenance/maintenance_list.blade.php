@extends('master')
@section('content')
    <div class="container">
        <div class="page-title">
            <div class="row ">
                <div class="col-md-12">
                    <div class="col-md-5 p-2">
                        <h5 class="text-white">Maintenance List</h5>
                    </div>

                    <div class="col-md-2 ">
                        <button type="button" class="btn btn-info"> <a href="{{route('maintenance')}}" class="text-white"><span
                            class="fa fa-mail-forward"> issue</span></a></button>
                            <button type="button" class="btn btn-info"> <a href="{{route('maintenance_return')}}" class="text-white"><span
                                class="fa fa-mail-reply"> Return</span></a></button>
                    </div>

                    <div class="col-md-3 top_search">
                        <form action="" method="GET">
                            <div class="input-group">
                                <input type="search" class="form-control" name="search" placeholder="Search for..."
                                    value="{{ $search }}">
                                <button class="btn btn-secondary" type="submit">Go!</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2 ">
                        <form action="{{route('maintenance_export')}}" method="GET">
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

            <!-- Modal End -->

            <!-- Display Table Start -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped table-bordered">
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th>SL</th>
                                            <th>ASSET TAG</th>
                                            <th>ASSET TYPE</th>
                                            <th>MODEL</th>
                                            <th>Purchase Date</th>
                                            <th>Company</th>
                                            <th>DESCRIPTION</th>
                                            <th>Strat Date</th>
                                            <th>End Date</th>
                                            <th>note</th>
                                            <th>Total Cost</th>
                                            <th>Currency</th>
                                            <th>Vendor</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="height: 5px !important; overflow: scroll; ">
                                        @foreach ($maintenance_data as $key => $maintenance_data)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $maintenance_data->asset_tag }}</td>
                                                <td>{{ $maintenance_data->asset_type }}</td>
                                                <td>{{ $maintenance_data->model }}</td>
                                                <td>{{ $maintenance_data->purchase_date }}</td>
                                                <td>{{ $maintenance_data->others }}</td>
                                                <td>{{ $maintenance_data->description }}</td>
                                                <td>{{ $maintenance_data->strat_date }}</td>
                                                <td>{{ $maintenance_data->end_date }}</td>
                                                <td>{{ $maintenance_data->note }}</td>
                                                <td>{{ $maintenance_data->amount }}</td>
                                                <td>{{ $maintenance_data->currency }}</td>
                                                <td>{{ $maintenance_data->vendor }}</td>
                                                <td>
                                                    <button class="border-0 bg-white"><a class="text-primary"
                                                            href="{{route('maintenance_edit', $maintenance_data->id)}}"><i
                                                                class="fa fa-edit "
                                                                style="font-size:20px;"></a></i></button>
                                                
                                                </td>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Display Table End -->
@endsection
