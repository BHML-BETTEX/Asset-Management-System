@extends('master')
@section('content')
<div class="container">
    <div class="page-title">
        <div class="row ">
            <div class="col-md-12 col-xl-12 col-lg-12">
                <div class="col-md-3 col-lg-3 col-sm-3 p-2">
                    <h5 class="text-white">Product Issue List</h5>
                </div>

                <div class="col-md-3 col-lg-3 d-flex flex-wrap gap-1">
                    <a href="" class="btn btn-info text-white" data-toggle="modal" data-target="#addissueModal"><i class="fa fa-plus"></i></a>
                    <a href="" class="btn btn-info text-white"><i class="fa fa-mail-forward"></i></a>
                    <a href="" class="btn btn-info text-white"><i class="fa fa-mail-reply"></i></a>
                </div>
                <div class="col-md-5 col-lg-4 top_search">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" placeholder="Search for text...." value="{{ request('search') }}">
                            <select id="product_search" name="product_search" class="form-control select2" data-error="Please specify your need.">

                            </select>

                            <button class="btn btn-info" type="submit">
                                <span class="fa fa-search"></span>
                            </button>
                        </div>
                    </form>
                </div>


                <div class="col-md-1  col-lg-2">
                    <form action="" method="GET">
                        <div class="input-group">
                            @foreach ($_GET as $key=> $item)

                            <input type="hidden" name="" value="">
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
                                        <th>TOTAL</th>
                                        <th>CURRENCY</th>
                                        <th>VENDOR</th>
                                        <th>PURCHASE DATE</th>
                                        <th>CHALLAN NO</th>
                                        <th>COMPANY</th>
                                        <th>OTHERS</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody style="height: 3px !important; overflow: scroll; ">



                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-xl" id="addissueModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card p-1">
                        <div class="card-header " style="background-color: #0cb0b7;">
                            <h5 class="text-white">Consumable Issue</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('productdetails_store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="controls">
                                    <!-- Asset Type & brand start -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Purchase date</label>
                                                <input id="" type="date"
                                                    name="purchase_date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Product Name * <span class="text-success" data-toggle="modal" data-target="#addBrandModal"><i
                                                            class="fa fa-plus"
                                                            style="font-size:10px;"></button></i></span>
                                                </label>
                                                <select id="asset_type" name="asset_type"
                                                    class="form-control " required>
                                                    <option value="" selected disabled>-- Select Asset Type --</option>
                                                    @foreach ($all_product_types as $product_type)
                                                    <option value="{{ $product_type->id }}">
                                                        {{ $product_type->product }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Asset Type & brand start -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Model * <span class="text-success" data-toggle="modal" data-target="#addBrandModal"><i
                                                            class="fa fa-plus"
                                                            style="font-size:10px;"></button></i></span>
                                                </label>
                                                <select id="asset_type" name="asset_type"
                                                    class="form-control " required>
                                                    <option value="" selected disabled>-- Select Asset Type --</option>
                                                    @foreach ($all_product_types as $product_type)
                                                    <option value="{{ $product_type->id }}">
                                                        {{ $product_type->product }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Quantity <span
                                                        class="text-danger">*</span></label>
                                                <input id="qty" type="number" name="qty"
                                                    class="form-control" value="1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Units <span
                                                        class="text-danger">*</span></label>
                                                <span class="text-success" data-toggle="modal" data-target="#addUnitModal"><i
                                                        class="fa fa-plus"
                                                        style="font-size:10px;"></i></span>
                                                </label>

                                                <select id="form_label" name="units"
                                                    class="form-control" required="required">
                                                    <option value="" selected disabled>--Select
                                                        Your
                                                        Issue--</option>
                                                    @foreach ($all_SizeMaseurment as $all_SizeMaseurment)
                                                    <option value="{{ $all_SizeMaseurment->id }}">
                                                        {{ $all_SizeMaseurment->size }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Employee ID <span
                                                        class="text-danger">*</span></label>
                                                <span class="text-success" data-toggle="modal" data-target="#addUnitModal"><i
                                                        class="fa fa-plus"
                                                        style="font-size:10px;"></i></span>
                                                </label>

                                                <select id="form_label" name="units"
                                                    class="form-control" required="required">
                                                    <option value="" selected disabled>--Select
                                                        Your
                                                        Issue--</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Department <span
                                                        class="text-danger">*</span></label>
                                                <span class="text-success" data-toggle="modal" data-target="#addUnitModal"><i
                                                        class="fa fa-plus"
                                                        style="font-size:10px;"></i></span>
                                                </label>

                                                <select id="form_label" name="units"
                                                    class="form-control" required="required">
                                                    <option value="" selected disabled>--Select
                                                        Your
                                                        Issue--</option>
                                                    @foreach ($all_departments as $all_department)
                                                    <option value="{{ $all_department->id }}">
                                                        {{ $all_department->department_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Employee ID <span
                                                        class="text-danger">*</span></label>
                                                <span class="text-success" data-toggle="modal" data-target="#addUnitModal"><i
                                                        class="fa fa-plus"
                                                        style="font-size:10px;"></i></span>
                                                </label>

                                                <select id="form_label" name="units"
                                                    class="form-control" required="required">
                                                    <option value="" selected disabled>--Select
                                                        Your
                                                        Issue--</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

       
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
@endsection