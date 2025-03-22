@extends('master')
@section('content')
<div class="container">
    <div class="page-title">
        <div class="row ">
            <div class="col-md-12">
                <div class="col-md-6 p-2">
                    <h5 class="text-white">Wast Product List</h5>
                </div>

                <div class="col-md-1 ">
                    <button type="button" class="btn btn-info"> <a href="{{route('wastproduct')}}" class="text-white"><span
                                class="fa fa-plus"> Add</span></a></button>
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
                    <form action="{{route('wastproduct_export')}}" method="GET">
                            <div class="input-group">
                                <select name="type" class="form-control">
                                    <option value="">Select Type</option>
                                    <option value="xlsx">XLSX</option>
                                    <option value="csv">CSV</option>
                                    <option value="xls">XLS</option>
                                </select>
                                <button type="submit" id="export-btn" class="btn btn-success">Export</button>
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
                                        <th>PURCHASE DATE</th>
                                        <th>DESCRIPTION</th>
                                        <th>ASSET SERISL NO</th>
                                        <th>COMPANY</th>
                                        <th>DATE</th>
                                        <th>NOTE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody style="height: 5px !important; overflow: scroll; ">
                                    @foreach ($wastproduct as $key => $wastproducts)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $wastproducts->asset_tag }}</td>
                                        <td>{{ $wastproducts->asset_type }}</td>
                                        <td>{{ $wastproducts->model }}</td>
                                        <td>{{ $wastproducts->purchase_date }}</td>
                                        <td>{{ $wastproducts->description }}</td>
                                        <td>{{ $wastproducts->asset_sl_no }}</td>
                                        <td>{{ $wastproducts->others }}</td>
                                        <td>{{ $wastproducts->date }}</td>
                                        <td>{{ $wastproducts->note }}</td>
                                        <td>
                                            <button class="border-0 bg-white"><a class="text-primary"
                                                    href="{{route('wastproduct_edit', $wastproducts->id)}}"><i
                                                        class="fa fa-edit "
                                                        style="font-size:20px;"></a></i></button>
                                            <button class="border-0 bg-white"><a class="text-danger"
                                                    href="{{route('wastproduct_delete', $wastproducts->id)}}"><i
                                                        class="fa fa-trash "
                                                        style="font-size:20px;"></a></i></button>
                                        </td>
                                        @endforeach
                                </tbody>
                            </table>
                            {{$wastproduct->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Display Table End -->
@endsection


@push('script')

@endpush