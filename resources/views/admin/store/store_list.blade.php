@extends('master')
@section('content')
<div class="container">
    <div class="page-title">
        <div class="row ">
            <div class="col-md-12 col-xl-12 col-lg-12">
                <div class="col-md-2 col-lg-1 col-sm-2 p-2">
                    <h5 class="text-white">Product List</h5>
                </div>

                <div class="col-md-5 col-lg-7">
                <button type="button" class="btn btn-info"> <a href="{{ route('add_product') }}"
                class="text-white"><span class="fa fa-plus"> Add</span></a></button>
                    <button type="button" class="btn btn-info"> <a href="{{ route('issue') }}" class="text-white"><span
                                class="fa fa-mail-forward"> Issue</span></a></button>
                    <button type="button" class="btn btn-info"> <a href="{{ route('return') }}"
                            class="text-white"><span class="fa fa-mail-reply"> Return</span></a></button>
                    <button type="button" class="btn btn-info"> <a href="{{ route('transfer') }}"
                            class="text-white"><span class="fa fa-send"> Transfer</span></a></button>
                    <button type="button" class="btn btn-info"> <a href="{{ route('maintenance') }}"
                            class="text-white"><span class="fa fa-gears"> Maintenance</span></a></button>
                    <button type="button" class="btn btn-info"> <a href="{{ route('wastproduct') }}"
                            class="text-white"><span class="fa fa-gears"> Wast Product</span></a></button>
                </div>
                <div class="col-md-3 col-lg-2 top_search">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" placeholder="Search for..."
                                value="{{ $search }}">
                            <button class="btn btn-secondary" type="submit">Go!</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 ">
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
                            <button type="submit" class="btn btn-success">Export</button>
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
                                <tbody style="height: 5px !important; overflow: scroll; ">
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
                                        <td><img width="50" height="25"
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