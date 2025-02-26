@extends('master')
@section('content')
    <div class="container">
        <div class="page-title">
            <div class="row ">
                <div class="col-md-12">
                    <div class="col-md-6 p-2">
                        <h5 class="text-white">Product Transfer List</h5>
                    </div>

                    <div class="col-md-1 ">
                        <button type="button" class="btn btn-info"> <a href="{{ route('transfer') }}" class="text-white"><span
                            class="fa fa-send"> Transfer</span></a></button>
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
                        <form action="{{ route('transfer_export') }}" method="GET">
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
                                            <th>OLD COMAPANY</th>
                                            <th>Company</th>
                                            <th>DESCRIPTION</th>
                                            <th>Note</th>
                                            <th>Date</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody style="height: 5px !important; overflow: scroll; ">
                                        @foreach ($transer_data as $key => $transer_data)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $transer_data->asset_tag }}</td>
                                                <td>{{ $transer_data->asset_type }}</td>
                                                <td>{{ $transer_data->model }}</td>
                                                <td>{{ $transer_data->oldcompany }}</td>
                                                <td>{{ $transer_data->company }}</td>
                                                <td>{{ $transer_data->description }}</td>
                                                <td>{{ $transer_data->note }}</td>
                                                <td>{{ $transer_data->transfer_date }}</td>
                                                <td>
                                                    <button class="border-0 bg-white"><a class="text-primary"
                                                            href="{{route('transfer_edit', $transer_data->id)}}"><i
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
