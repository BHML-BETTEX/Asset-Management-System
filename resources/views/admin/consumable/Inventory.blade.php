@extends('master')
@section('content')
<div class="container">
    <div class="page-title">
        <div class="row ">
            <div class="col-md-12 col-xl-12 col-lg-12">
                <div class="col-md-3 col-lg-3 col-sm-3 p-2">
                    <h5 class="text-white">Product Summary</h5>
                </div>

                <div class="col-md-3 col-lg-3 d-flex flex-wrap gap-1">
                    <a href="" class="btn btn-info text-white" data-toggle="modal" data-target="#addLocationModal"><i class="fa fa-plus"></i></a>
                    <a href="" class="btn btn-info text-white" data-toggle="modal" data-target="#addissueModal"><i class="fa fa-send"></i></a>
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
                                <table class="table table-striped table-bordered ">
                                    <thead class="bg-info text-white ">
                                        <tr>
                                            <th>Product Type</th>
                                            <th>Model</th>
                                            <th>In Quantity</th>
                                            <th>Out Quantity</th>
                                            <th>Total Balance</th>
                                            <th>Company</th>


                                        </tr>
                                    </thead>
                                    <tbody style="height: 3px !important; overflow: scroll; ">
                                        @foreach($stocks_qty as $item)
                                        <tr>
                                            <td>{{ $item->product_type_name }}</td>
                                            <td>{{ $item->model }}</td>
                                            <td>{{ $item->in_qty }}</td>
                                            <td>{{ $item->out_qty }}</td>
                                            <td>{{ $item->balance}}</td>
                                            <td>{{ $item->company_name }}</td>
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

<div class="modal fade bd-example-modal-xl" id="addLocationModal" tabindex="-1" role="dialog"
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
                            <h5 class="text-white">Add Consumable Product</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('productdetails_store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="controls">
                                    <!-- Asset Type & brand start -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label"> Asset Type *
                                                    <span class="text-success" data-toggle="modal" data-target="#addAssetModal"><i
                                                            class="fa fa-plus"
                                                            style="font-size:10px;"></i></span>
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
                                                <label for="form_label">Brand * <span class="text-success" data-toggle="modal" data-target="#addBrandModal"><i
                                                            class="fa fa-plus"
                                                            style="font-size:10px;"></button></i></span>
                                                </label>
                                                <select id="brand" name="brand"
                                                    class="form-control select2" required="required"
                                                    data-error="Please specify your need.">
                                                    <option value="" selected disabled>--Select
                                                        Your
                                                        Issue--</option>
                                                    @foreach ($all_brands as $all_brands)
                                                    <option value="{{ $all_brands->id }}">
                                                        {{ $all_brands->brand_name }}
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
                                                <label for="form_label">Model * <span class="text-success" data-toggle="modal" data-target="#addModelModal"><i
                                                            class="fa fa-plus"
                                                            style="font-size:10px;"></button></i></span>
                                                </label>
                                                <select id="brand" name="model"
                                                    class="form-control select2" required="required"
                                                    data-error="Please specify your need.">
                                                    <option value="" selected disabled>--Select
                                                        Your
                                                        Issue--</option>
                                                    @foreach ($products as $product)
                                                    <option value="{{ $product->product_model }}">
                                                        {{ $product->product_model }}
                                                    </option>
                                                    @endforeach
                                                </select>
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
                                                <textarea id="form_message" name="description" class="form-control" rows="6"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Quantity <span
                                                        class="text-danger">*</span></label>
                                                <input id="qty" type="number" name="qty"
                                                    class="form-control" value="1">
                                            </div>
                                        </div>

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
                                                    @foreach ($SizeMaseurment as $SizeMaseurments)
                                                    <option value="{{ $SizeMaseurments->id }}">
                                                        {{ $SizeMaseurments->size }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Cost</label>
                                                <input id="cost" type="number" name="cost"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Currency </span><a
                                                        class="text-success" href=""><i
                                                            style="font-size:10px;"></a></i></label>
                                                <select id="form_need" name="currency"
                                                    class="form-control"
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
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="form_label">Total Amount</label>
                                                <input id="total" type="text" readonly
                                                    name="total" class="form-control">
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
                                                    class="form-control"
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
                                                <label for="form_label"> Vendor *
                                                    <span class="text-success" data-toggle="modal" data-target="#addVendorModal"><i
                                                            class="fa fa-plus"
                                                            style="font-size:10px;"></i></span>
                                                </label>
                                                <select id="vendor" name="vendor"
                                                    class="form-control select2">
                                                    <option value="" selected disabled>--Select
                                                        Your
                                                        Issue--</option>
                                                    @foreach ($all_supplier as $all_supplier)
                                                    <option value="{{ $all_supplier->id }}">
                                                        {{ $all_supplier->supplier_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Company
                                                    <span class="text-success" data-toggle="modal" data-target="#addCompanyModal"><i
                                                            class="fa fa-plus"
                                                            style="font-size:10px;"></i></span>
                                                </label>
                                                <select id="company" name="company"
                                                    class="form-control select2" required="required">
                                                    <option value="" selected disabled>--Select
                                                        Your
                                                        Issue--</option>
                                                    @foreach ($all_company as $all_company)
                                                    <option value="{{ $all_company->id }}">
                                                        {{ $all_company->company }}
                                                    </option>
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

                                    <div class="form-group">
                                        <div class="col-md-12 ">
                                            <button type="submit" onclick="showAlert"
                                                class="btn btn-primary"><span class="fa fa-file-text"> Submit</button>
                                            <button type="reset"
                                                class="btn btn-secondary"><span class="fa fa-undo"></span> Reset</button>
                                            <a href="{{route('productdetails')}}" class="btn btn-info"><span class="fa fa-step-backward"></span> Back</a>
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

<div class="modal fade bd-example-modal-lg" id="addModelModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card p-1">
                        <div class="card-header " style="background-color: #99abb0;">
                            <h5 class="text-white">Add Product</h5>
                        </div>
                        @if (session ('brand_add'))
                        <div class="alert alert-success">{{ session('brand_add') }}</div>
                        @endif
                        <div class="card-body">
                            <form action="{{route('product_store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="form_label">Product Type
                                            <span class="text-success" data-toggle="modal" data-target="#addCompanyModal"><i
                                                    class="fa fa-plus"
                                                    style="font-size:10px;"></i></span>
                                        </label>
                                        <select id="product_type" name="product_type"
                                            class="form-control select2" required="required">
                                            <option value="" selected disabled>--Select
                                                Your
                                                Issue--</option>
                                            @foreach ($all_product_types as $all_product_type)
                                            <option value="{{ $all_product_type->id }}">
                                                {{ $all_product_type->product }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Model</label>
                                    <input type="text" class="form-control" name="product_model" placeholder="note">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn text-white" style="background-color: #0cb0b7;">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="addissueModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                            <form action="{{route('consumableIssue_store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="controls">
                                    <!-- Asset Type & brand start -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Issue date</label>
                                                <input id="issue_date" type="date"
                                                    name="issue_date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Product Names * <span class="text-success" data-toggle="modal" data-target="#addBrandModal"><i
                                                            class="fa fa-plus"
                                                            style="font-size:10px;"></button></i></span>
                                                </label>
                                                <select id="product_type" name="product_type"
                                                    class="form-control " required>
                                                    <option value="" selected disabled>-- Select Asset Type --</option>
                                                    @foreach ($all_product_types as $all_product_type)
                                                    <option value="{{ $all_product_type->product }}">
                                                        {{ $all_product_type->product}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="form_label">Company<span
                                                        class="text-danger">*</span></label>
                                                <span class="text-success" data-toggle="modal" data-target="#addUnitModal"><i
                                                        class="fa fa-plus"
                                                        style="font-size:10px;"></i></span>
                                                </label>

                                                <select id="company_id" name="company"
                                                    class="form-control" required="required">
                                                    <option value="" selected disabled>--Select
                                                        Your
                                                        Issue--</option>
                                                    @foreach ($stocks_qty as $item)
                                                    <option value="{{ $item->company }}">
                                                        {{ $item->company }}
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
                                                <select id="model_id" name="model_id"
                                                    class="form-control " required>
                                                    <option value="" selected disabled>-- Select Asset Type --</option>
                                                    @foreach ($stocks_qty as $item)
                                                    <option value="{{ $item->model }}">
                                                        {{ $item->model }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Stock Qty <span
                                                        class="text-danger">*</span></label>
                                                <input id="qty" type="number" name="qty"
                                                    class="form-control" value="" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Issue Qty <span
                                                        class="text-danger">*</span></label>
                                                <input id="issue_qty" type="number" name="issue_qty"
                                                    class="form-control" value="1">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Units <span
                                                        class="text-danger">*</span></label>
                                                <span class="text-success" data-toggle="modal" data-target="#addUnitModal"><i
                                                        class="fa fa-plus"
                                                        style="font-size:10px;"></i></span>
                                                </label>

                                                <select id="form_label" name="units_id"
                                                    class="form-control" required="required">
                                                    <option value="" selected disabled>--Select
                                                        Your
                                                        Issue--</option>
                                                    @foreach ($SizeMaseurment as $SizeMaseurments)
                                                    <option value="{{ $SizeMaseurments->id }}">
                                                        {{ $SizeMaseurments->size }}
                                                    </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Employee ID <span
                                                        class="text-danger">*</span></label>
                                                <span class="text-success" data-toggle="modal" data-target="#addUnitModal"><i
                                                        class="fa fa-plus"
                                                        style="font-size:10px;"></i></span>
                                                </label>

                                                <select id="form_label" name="emp_name"
                                                    class="form-control" required="required">
                                                    <option value="" selected disabled>--Select
                                                        Your
                                                        Issue--</option>
                                                    @foreach($employee as $employees)
                                                    <option value="{{$employees->emp_name}}">
                                                        {{$employees->emp_name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_label">Department <span
                                                        class="text-danger">*</span></label>
                                                <span class="text-success" data-toggle="modal" data-target="#addUnitModal"><i
                                                        class="fa fa-plus"
                                                        style="font-size:10px;"></i></span>
                                                </label>

                                                <select id="form_label" name="department_id"
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
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="form_label">Note</label>
                                                    <textarea id="form_message" name="others" class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12 ">
                                            <button type="submit" onclick="showAlert"
                                                class="btn btn-primary"><span class="fa fa-file-text"> Submit</button>
                                            <button type="reset"
                                                class="btn btn-secondary"><span class="fa fa-undo"></span> Reset</button>
                                            <a href="{{route('consumableIssue')}}" class="btn btn-info"><span class="fa fa-step-backward"></span> Back</a>
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
@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const costInput = document.getElementById('cost');
        const qtyInput = document.getElementById('qty');
        const totalInput = document.getElementById('total');

        function calculateTotal() {
            const cost = parseFloat(costInput.value) || 0;
            const qty = parseFloat(qtyInput.value) || 0;
            const total = cost * qty;
            totalInput.value = total.toFixed(2);
        }

        costInput.addEventListener('input', calculateTotal);
        qtyInput.addEventListener('input', calculateTotal);
    });
</script>

@if(session('add_message'))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session("add_message") }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('product_delete'))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session("product_delete") }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif

<script>
    $(document).ready(function () {
        function fetchStockQty() {
            var company = $('#company_id').val();
            var model = $('#model_id').val();

            if (company && model) {
                $.ajax({
                    url: '{{ route("get.stock.qty") }}', // You'll define this route
                    type: 'GET',
                    data: {
                        company: company,
                        model: model
                    },
                    success: function (response) {
                        $('#qty').val(response.qty ?? 0);
                    },
                    error: function () {
                        $('#qty').val(0);
                    }
                });
            }
        }

        $('#company_id, #model_id').change(fetchStockQty);
    });
</script>


@endpush