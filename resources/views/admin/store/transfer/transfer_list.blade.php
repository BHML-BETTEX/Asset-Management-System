@extends('master')
@section('content')
<div class="container">
    <div class="page-title">
        <div class="row ">
            <div class="col-md-12">
                <div class="col-md-5 p-2">
                    <h5 class="text-white">Product Transfer List</h5>
                </div>

                <div class="col-md-2 ">
                    <button type="button" class="btn btn-info"> <a href="{{ route('transfer') }}" class="text-white"><span
                                class="fa fa-send"> Transfer</span></a></button>
                    <button type="button" class="btn btn-info"> <a href="{{ route('transfer_return') }}"
                            class="text-white"><span class="fa fa-reply"> Return</span></a></button>
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
                            @foreach ($_GET as $key=> $item)
                                <input type="hidden" name="{{$key}}" value="{{$item}}">
                            @endforeach
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
                                        <th>NOTE</th>
                                        <th>TRANSFER DATE</th>
                                        <th>RETURN DATE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody style="height: 5px !important; overflow: scroll; ">
                                    @foreach ($transer_data as $key => $transers_data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $transers_data->asset_tag }}</td>
                                        <td>{{ $transers_data->asset_type }}</td>
                                        <td>{{ $transers_data->model }}</td>
                                        <td>{{ $transers_data->oldcompany }}</td>
                                        <td>{{ $transers_data->company }}</td>
                                        <td>{{ $transers_data->description }}</td>
                                        <td>{{ $transers_data->note }}</td>
                                        <td>{{ $transers_data->transfer_date }}</td>
                                        <td>{{ $transers_data->return_date }}</td>
                                        <td>
                                            <button class="border-0 bg-white"><a class="text-primary"
                                                    href="{{ route('transfer_edit', $transers_data->id) }}"><i
                                                        class="fa fa-edit "
                                                        style="font-size:20px;"></a></i></button>

                                        </td>
                                        @endforeach
                                </tbody>
                            </table>
                            {{$transer_data->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Display Table End -->
@endsection