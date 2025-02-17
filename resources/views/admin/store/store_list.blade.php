@extends('master')
@section('content')
    <div class="container">
        <div class="page-title">
            <div class="row ">
                <div class="col-md-12">
                    <div class="col-md-2 p-2">
                        <h5 class="text-white">Product List</h5>
                    </div>

                    <div class= "col-md-5">
                        <button type="button" class="btn btn-info " data-toggle="modal" data-target="#exampleModal"
                            data-whatever="@mdo"><span class="fa fa-plus"> Add</span></button>
                        <button type="button" class="btn btn-info"> <a href="{{ route('issue') }}" class="text-white"><span
                                    class="fa fa-mail-forward"> Issue</span></a></button>
                        <button type="button" class="btn btn-info"> <a href="{{ route('return') }}"
                                class="text-white"><span class="fa fa-mail-reply"> Return</span></a></button>
                        <button type="button" class="btn btn-info"> <a href="{{ route('transfer') }}" class="text-white"><span
                                    class="fa fa-send"> Transfer</span></a></button>
                        <button type="button" class="btn btn-info"> <a href="" class="text-white"><span
                                    class="fa fa-gears"> Maintenance</span></a></button>
                        <button type="button" class="btn btn-info"> <a href="" class="text-white"><span
                                    class="fa fa-gears"> Store Return</span></a></button>
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
                        <form action="{{ route('store_export') }}" method="GET">
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


            <div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="row ">
                                <div class="col-lg-10 mx-auto">
                                    <div class="card mt-2 mx-auto p-4 bg-light">
                                        <div class="card-body bg-light">
                                            <div class = "container">
                                                <form action="{{ route('store.store') }}" Method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="controls">
                                                        <!-- Asset Type & brand start -->
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="form_label">Asset Type <span
                                                                            class="">*
                                                                            <!-- Trigger the modal with a button -->

                                                                            <!-- Modal Start-->
                                                                            <div class="modal fade" id="myModal_id"
                                                                                role="dialog">
                                                                                <div class="modal-dialog">
                                                                                    <!-- Modal content-->
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5>Add New Asset</h5>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form action=""
                                                                                                Method="POST"
                                                                                                enctype="multipart/form-data">
                                                                                                @csrf
                                                                                                <div class="mb-3">
                                                                                                    <label for="form_label"
                                                                                                        class="form-label">Product</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="product">
                                                                                                </div>
                                                                                                <div class="mb-3">
                                                                                                    <button
                                                                                                        class="btn btn-primary"
                                                                                                        type="submit">submit</button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Modal End-->
                                                                            </div>
                                                                        </span>
                                                                    </label>
                                                                    <select id="form_need" name="asset_type"
                                                                        class="form-control" required="required"
                                                                        data-error="Please specify your need.">
                                                                        <option value="" selected disabled>--Select
                                                                            Your
                                                                            Issue--</option>
                                                                        @foreach ($all_product_types as $all_product_types)
                                                                            <option value="{{ $all_product_types->id }}">
                                                                                {{ $all_product_types->product }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="form_label">Brand <span
                                                                            class="text-danger">* <a class="text-success"
                                                                                href="{{ route('brand') }}"><i
                                                                                    class="fa fa-plus"
                                                                                    style="font-size:10px;"></a></i></span>
                                                                    </label>
                                                                    <select id="form_need" name="brand"
                                                                        class="form-control" required="required"
                                                                        data-error="Please specify your need.">
                                                                        <option value="" selected disabled>--Select
                                                                            Your
                                                                            Issue--</option>
                                                                        @foreach ($all_brands as $all_brands)
                                                                            <option value="{{ $all_brands->id }}">
                                                                                {{ $all_brands->brand_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Asset Type & brand start -->
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="form_label">Model</label>
                                                                    <input id="" type="text" name="model"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="form_label">Serial</label>
                                                                    <input id="" type="text"
                                                                        name="asset_sl_no" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="form_label">Description</label>
                                                                    <textarea id="form_message" name="description" class="form-control"rows="4"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="form_label">Cost</label>
                                                                    <input id="" type="number" name="cost"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="form_label">Currency </span><a
                                                                            class="text-success" href=""><i
                                                                                class="fa fa-plus"
                                                                                style="font-size:10px;"></a></i></label>
                                                                    <select id="form_need" name="currency"
                                                                        class="form-control" required="required"
                                                                        data-error="brand">
                                                                        <option value="" selected disabled>--Select
                                                                            Your
                                                                            Issue--</option>
                                                                        <option>BDT</option>
                                                                        <option>USD</option>
                                                                        <option>RMB</option>
                                                                        <option>Other</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="form_label">Warrenty</label>
                                                                    <input id="" type="number" name="warrenty"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="form_need">Durablity </span><a
                                                                            class="text-success" href=""><i
                                                                                class="fa fa-plus"
                                                                                style="font-size:10px;"></a></i></label>
                                                                    <select id="form_label" name="durablity"
                                                                        class="form-control" required="required"
                                                                        data-error="brand">
                                                                        <option value="" selected disabled>--Select
                                                                            Your
                                                                            Issue--</option>
                                                                        <option>Days</option>
                                                                        <option>Week</option>
                                                                        <option>Month</option>
                                                                        <option>Year</option>
                                                                        <option>Other</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="form_label">Quantity <span
                                                                            class="text-danger">*</span></label>
                                                                    <input id="" type="number" name="qty"
                                                                        required="required" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="form_label">Units </span><a
                                                                            class="text-success" href=""><i
                                                                                class="fa fa-plus"
                                                                                style="font-size:10px;"></a></i></label>
                                                                    <select id="form_label" name="units"
                                                                        class="form-control">
                                                                        <option value="" selected disabled>--Select
                                                                            Your
                                                                            Issue--</option>
                                                                        @foreach ($all_SizeMaseurment as $all_SizeMaseurment)
                                                                            <option value="{{ $all_SizeMaseurment->id }}">
                                                                                {{ $all_SizeMaseurment->size }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="form_label">Purchase date</label>
                                                                    <input id="" type="date"
                                                                        name="purchase_date" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="form_label">Vendor </span><a
                                                                            class="text-success" href=""><i
                                                                                class="fa fa-plus"
                                                                                style="font-size:10px;"></a></i></label>
                                                                    <select id="form_need" name="vendor"
                                                                        class="form-control">
                                                                        <option value="" selected disabled>--Select
                                                                            Your
                                                                            Issue--</option>
                                                                        @foreach ($all_supplier as $all_supplier)
                                                                            <option value="{{ $all_supplier->id }}">
                                                                                {{ $all_supplier->supplier_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="form_label">Company </span><a
                                                                            class="text-success" href=""><i
                                                                                class="fa fa-plus"
                                                                                style="font-size:10px;"></a></i></label>
                                                                    <select id="form_need" name="company"
                                                                        class="form-control">
                                                                        <option value="" selected disabled>--Select
                                                                            Your
                                                                            Issue--</option>
                                                                        @foreach ($all_company as $all_company)
                                                                            <option value="{{ $all_company->id }}">
                                                                                {{ $all_company->company }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="form_label">Location<span
                                                                            class="text-danger">*
                                                                        </span><a class="text-success" href=""><i
                                                                                class="fa fa-plus"
                                                                                style="font-size:10px;"></a></i></span></label>
                                                                    <select id="form_need" name="location"
                                                                        class="form-control" required="required"
                                                                        data-error="location">
                                                                        <option value="" selected disabled>--Select
                                                                            Your
                                                                            Issue--</option>
                                                                        @foreach ($all_departments as $all_departments)
                                                                            <option value="{{ $all_departments->id }}">
                                                                                {{ $all_departments->department_name }}
                                                                            </option>
                                                                        @endforeach
                                                                        <option>Other</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="form_label">Status </span><a
                                                                            class="text-success" href=""><i
                                                                                class="fa fa-plus"
                                                                                style="font-size:10px;"></a></i></label>
                                                                    <select id="form_need" name="status"
                                                                        class="form-control" data-error="status">
                                                                        <option value="" selected disabled>--Select
                                                                            Your
                                                                            Issue--</option>
                                                                        @foreach ($all_status as $all_status)
                                                                            <option value="{{ $all_status->id }}">
                                                                                {{ $all_status->status_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="form_label">Challan Number</label>
                                                                    <input id="" type="text"
                                                                        name="challan_no" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="form_label">Note</label>
                                                                    <input id="" type="text" name="others"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="form_label">Picture</label>
                                                                    <input id="form_email" type="file" name="picture"
                                                                        required="required" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-md-12 offset-md-3">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Submit</button>
                                                                <button type="reset"
                                                                    class="btn btn-secondary">Reset</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.8 -->
                            </div>
                            <!-- /.row-->
                        </div>
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
                                            <th>CHECKSTATUS</th>
                                            <th>PICTURE</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody style="height: 5px !important; overflow: scroll; ">
                                        @foreach ($stores as $key => $store)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
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
                                                <td style="background-color: #feefe6;">{{ $store->checkstatus }}</td>
                                                <td><img width="50" height="25"
                                                        src="{{ asset('/uploads/store/' . $store->picture) }}"
                                                        alt="picture"></td>
                                                <td>
                                                    <button class="border-0 bg-white"><a class="text-primary"
                                                            href="{{ route('store.edit', $store->id) }}"><i
                                                                class="fa fa-edit "
                                                                style="font-size:20px;"></a></i></button>
                                                    <button class="border-0 bg-white"><a class="text-danger"
                                                            href="{{ route('store.delete', $store->id) }}"><i
                                                                class="fa fa-trash "
                                                                style="font-size:20px;"></a></i></button>
                                                    <button class="border-0 bg-white"><a class="text-success"
                                                            href="{{ route('invoice', $store->id) }}"><i
                                                                class="fa fa-eye "
                                                                style="font-size:20px;"></a></i></button>
                                                </td>
                                            </tr>
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
