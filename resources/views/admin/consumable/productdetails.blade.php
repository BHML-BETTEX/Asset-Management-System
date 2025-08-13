@extends('master')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="container">
    <div class="page-title">
        <div class="row ">
            <div class="col-md-12 col-xl-12 col-lg-12">
                <div class="col-md-3 col-lg-3 col-sm-3 p-2">
                    <h5 class="text-white">Consumable Product</h5>
                </div>

                <div class="col-md-3 col-lg-3 d-flex flex-wrap gap-1">
                    <a href="" class="btn btn-info text-white" data-toggle="modal" data-target="#addLocationModal"><i class="fa fa-plus"></i> Add</a>
                </div>
                <div class="col-md-5 col-lg-4 top_search">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" placeholder="Search for text...." value="{{ request('search') }}">
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
                                    @foreach ($productdetails as $key => $productdetail)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $productdetail->rel_to_ProductType->product }}</td>
                                        <td>{{ $productdetail->model}}</td>
                                        <td>{{ $productdetail->rel_to_brand->brand_name }}</td>
                                        <td>{{ $productdetail->description }}</td>
                                        <td>{{ $productdetail->asset_sl_no }}</td>
                                        <td>{{ $productdetail->qty }}</td>
                                        <td>{{ $productdetail->rel_to_SizeMaseurment->size }}</td>
                                        <td>{{ $productdetail->warrenty }}</td>
                                        <td>{{ $productdetail->durablity }}</td>
                                        <td>{{ $productdetail->cost }}</td>
                                        <td>{{ $productdetail->total }}</td>
                                        <td>{{ $productdetail->currency }}</td>
                                        <td>{{ $productdetail->rel_to_Supplier->supplier_name }}</td>
                                        <td>{{ $productdetail->purchase_date }}</td>
                                        <td>{{ $productdetail->challan_no }}</td>
                                        <td>{{ $productdetail->rel_to_Company->company }}</td>
                                        <td>{{ $productdetail->others }}</td>
                                        <td>
                                            <button class="border-0 bg-white"><a class="text-primary"
                                                    href=""><i
                                                        class="fa fa-edit "
                                                        style="font-size:20px;"></a></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$productdetails->links()}}
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
                            <form action="{{ route('productdetails_store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="controls">
                                    <!-- Asset Type & Brand -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Asset Type *</label>
                                                <select id="asset_type" name="asset_type" class="form-control select2" required>
                                                    <option value="">-- Select Asset Types --</option>
                                                    @foreach ($all_product_types as $product_type)
                                                    <option value="{{ $product_type->id }}">{{ $product_type->product }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Brand</label>
                                                <select id="brand" name="brand" class="form-control select2">
                                                    <option value="" selected disabled>-- Select Brand --</option>
                                                    @foreach ($all_brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Model & Serial -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Model *
                                                    <span class="text-success" data-toggle="modal" data-target="#addModelModal">
                                                        <i class="fa fa-plus" style="font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select id="model" name="model" class="form-control select2" required>
                                                    <option value="" selected disabled>-- Select Model --</option>
                                                    @foreach ($products as $product)
                                                    <option value="{{ $product->product_model }}">{{ $product->product_model }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Serial</label>
                                                <input type="text" name="asset_sl_no" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" class="form-control" rows="6"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Quantity & Units -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Quantity <span class="text-danger">*</span></label>
                                                <input id="qty" type="number" name="qty" class="form-control" value="1" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Units <span class="text-danger">*</span>
                                                    <span class="text-success" data-toggle="modal" data-target="#addUnitModal">
                                                        <i class="fa fa-plus" style="font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select name="units" class="form-control" required>
                                                    <option value="" selected disabled>-- Select Units --</option>
                                                    @foreach ($all_SizeMaseurment as $size)
                                                    <option value="{{ $size->id }}">{{ $size->size }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cost & Currency -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Cost</label>
                                                <input id="cost" type="number" name="cost" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Currency</label>
                                                <select name="currency" class="form-control">
                                                    <option value="" selected disabled>-- Select Currency --</option>
                                                    <option>BDT</option>
                                                    <option>USD</option>
                                                    <option>RMB</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Total Amount -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Total Amount</label>
                                                <input id="total" type="text" readonly name="total" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Warranty & Durability -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Warranty</label>
                                                <input type="number" name="warrenty" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Durability</label>
                                                <select name="durablity" class="form-control">
                                                    <option value="" selected disabled>-- Select Durability --</option>
                                                    <option>Days</option>
                                                    <option>Week</option>
                                                    <option>Month</option>
                                                    <option>Year</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Purchase Date -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Purchase date</label>
                                                <input type="date" name="purchase_date" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Vendor & Company -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Vendor *</label>
                                                <select name="vendor" class="form-control select2" required>
                                                    <option value="" selected disabled>-- Select Vendor --</option>
                                                    @foreach ($all_supplier as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company</label>
                                                <select name="company" class="form-control" required>
                                                    <option value="" selected disabled>-- Select Company --</option>
                                                    @foreach ($all_company as $company)
                                                    <option value="{{ $company->id }}">{{ $company->company }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Challan Number -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Challan Number</label>
                                                <input type="text" name="challan_no" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Note -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Note</label>
                                                <input type="text" name="others" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary"><span class="fa fa-file-text"></span> Submit</button>
                                            <button type="reset" class="btn btn-secondary"><span class="fa fa-undo"></span> Reset</button>
                                            <a href="{{ route('productdetails') }}" class="btn btn-info"><span class="fa fa-step-backward"></span> Back</a>
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


@endsection

@push('script')

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "-- Select Item --",
            allowClear: true,
            width: '100%',
            minimumResultsForSearch: 0,
            dropdownParent: $('#addLocationModal')
        });
    });
</script>

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
@endpush