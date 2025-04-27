@extends('master')
@section('content')
<div class="container">
    <div class="page-title">
        <div class="row ">
            <div class="col-md-12 col-xl-12 col-lg-12">
                <div class="col-md-2 col-lg-2 col-sm-2 p-2">
                    <h5 class="text-white">Product List</h5>
                </div>

                <div class="col-md-4 col-lg-4 d-flex flex-wrap gap-1">
                    <a href="{{ route('add_product') }}" class="btn btn-info text-white"><i class="fa fa-plus"></i></a>
                    <a href="{{ route('issue') }}" class="btn btn-info text-white"><i class="fa fa-mail-forward"></i></a>
                    <a href="{{ route('return') }}" class="btn btn-info text-white"><i class="fa fa-mail-reply"></i></a>
                    <a href="{{ route('transfer') }}" class="btn btn-info text-white"><i class="fa fa-send"></i></a>
                    <a href="{{ route('maintenance') }}" class="btn btn-info text-white"><i class="fa fa-gears"></i></a>
                    <a href="{{ route('wastproduct') }}" class="btn btn-info text-white"><i class="fa fa-briefcase"></i></a>
                </div>
                <div class="col-md-3 col-lg-2 top_search">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" placeholder="Search for..."
                                value="{{ $search }}">
                            <button class="btn btn-info" type="submit"><span class="fa fa-search"> </span></button>
                        </div>
                    </form>
                </div>

                <div class="col-md-2 col-lg-2">
                    <form action="" method="GET">
                        <div class="input-group">
                            <select id="product_search" name="product_search" class="form-control select2" data-error="Please specify your need.">
                                <option value="">--Product Type--</option>
                                @foreach ($all_product_types as $all_product)
                                <option value="{{ $all_product->id }}">{{ $all_product->product }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-info" type="submit">
                                <span class="fa fa-search"></span>
                            </button>
                        </div>
                    </form>
                </div>


                <div class="col-md-1  col-lg-2">
                    <form action="{{ route('store_export') }}" method="GET">
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
            </div>
        </div>

        <!-- Display Table Start -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped table-bordered ">
                                <thead class="bg-info text-white ">
                                    <tr>
                                        <th>SL</th>
                                        <th>ASSET TAG</th>
                                        <th>ASSET TYPE</th>
                                        <th>MODEL</th>
                                        <th>BRAND</th>
                                        <th>DESCRIPTION</th>
                                        <th>ASSET SL No</th>
                                        <th>QTY</th>
                                        <th>UNITS</th>
                                        <th>WARRENTY</th>
                                        <th>DURABLITY</th>
                                        <th>COST</th>
                                        <th>CURRENCY</th>
                                        <th>VENDOR</th>
                                        <th>PURCHASE DATE</th>
                                        <th>CHALLAN NO</th>
                                        <th>STATUS</th>
                                        <th>COMPANY</th>
                                        <th>OTHERS</th>
                                        <th>Balance</th>
                                        <th>CHECKSTATUS</th>
                                        <th>PICTURE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody style="height: 3px !important; overflow: scroll; ">
                                    @foreach ($stores as $key => $store)
                                    <tr>
                                        <td>{{ $stores->firstItem() + $key }}</td>
                                        <td>{{ $store->products_id }}</td>
                                        <td>{{ $store->rel_to_ProductType->product }}</td>
                                        <td>{{ $store->model }}</td>
                                        <td>{{ $store->rel_to_brand->brand_name }}</td>
                                        <td>{{ $store->description }}</td>
                                        <td>{{ $store->asset_sl_no }}</td>
                                        <td>{{ $store->qty }}</td>
                                        <td>{{ $store->rel_to_SizeMaseurment->size }}</td>
                                        <td>{{ $store->warrenty }}</td>
                                        <td>{{ $store->durablity }}</td>
                                        <td>{{ $store->cost }}</td>
                                        <td>{{ $store->currency }}</td>
                                        <td>{{ $store->rel_to_Supplier->supplier_name }}</td>
                                        <td>{{ $store->purchase_date }}</td>
                                        <td>{{ $store->challan_no }}</td>
                                        <td>{{ $store->rel_to_Status->status_name }}</td>
                                        <td>{{ $store->rel_to_Company->company }}</td>
                                        <td>{{ $store->others }}</td>
                                        <td>


                                        </td>
                                        <td style="background-color: #feefe6;">
                                            @if($store->checkstatus == "INSTOCK")
                                            <span class="badge bg-success text-white">{{ $store->checkstatus }}</span>
                                            @elseif($store->checkstatus == "MAINTENANCE")
                                            <span class="badge bg-warning text-white">{{ $store->checkstatus }}</span>
                                            @else
                                            <span class="badge bg-primary text-white">{{ $store->checkstatus }}</span>
                                            @endif

                                        </td>
                                        <td><img width="40" height="15"
                                                src="{{ asset('/uploads/store/' . $store->picture) }}"
                                                alt="picture"></td>
                                        <td>
                                            <button class="border-0 bg-white"><a class="text-primary"
                                                    href="{{ route('store.edit', $store->id) }}"><i
                                                        class="fa fa-edit "
                                                        style="font-size:20px;"></a></i></button>

                                            <button class="border-0 bg-white"><a class="text-success"
                                                    href="{{ route('qr_code_view', $store->id) }}"><i
                                                        class="fa fa-eye "
                                                        style="font-size:20px;"></a></i></button>

                                            <button class="border-0 bg-white"><a class="text-success"
                                                    href="{{route('qr_code', $store->id)}}"><i
                                                        class="fa fa-qrcode "
                                                        style="font-size:20px;"></a></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$stores->links()}}
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
<script>
    $(document).ready(function() {
        $('#product_search').select2({
            placeholder: "--Product Type--",
            allowClear: true
        });
    });
</script>
@endpush