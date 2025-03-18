@extends('master')
@section('content')
<div class="row ">
    <div class="col-lg-10 mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light">
            <div class="card-body bg-light ">
                <div class="container">
                    <form action="{{ route('store.store') }}" Method="POST"
                        enctype="multipart/form-data">
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
                                            class="form-control select2" required>
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
                                        <textarea id="form_message" name="description" class="form-control" rows="4"></textarea>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_label">Quantity <span
                                                class="text-danger">*</span></label>
                                        <input id="" type="number" name="qty"
                                            required="required" class="form-control" value="1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_label">Units
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_label">Location
                                            <span class="text-success" data-toggle="modal" data-target="#addLocationModal"><i
                                                    class="fa fa-plus"
                                                    style="font-size:10px;"></i></span>
                                        </label>
                                        <select id="location" name="location"
                                            class="form-control select2" required="required"
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
                                        <label for="form_label">Stauts
                                            <span class="text-success" data-toggle="modal" data-target="#addStatusModal"><i
                                                    class="fa fa-plus"
                                                    style="font-size:10px;"></i></span>
                                        </label>
                                        <select id="form_need" name="status"
                                            class="form-control" data-error="status" required>
                                            <option value="" selected disabled>--Select
                                                Your
                                                Issue--</option>
                                            @foreach ($all_status as $all_status)
                                            <option value="{{ $all_status->id }}">
                                                {{ $all_status->status_name }}
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

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="form_label">Picture</label>
                                        <input id="form_email" type="file" name="picture" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 ">
                                    <button type="submit"
                                        class="btn btn-primary">Submit</button>
                                    <button type="reset"
                                        class="btn btn-secondary">Reset</button>
                                        <a href="{{route('store')}}" class="btn btn-info">Back</a>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- brand -->

    <div class="modal fade bd-example-modal-lg" id="addBrandModal" tabindex="-1" role="dialog"
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
                                <h5 class="text-white">Add Brand</h5>
                            </div>
                            @if (session ('brand_add'))
                            <div class="alert alert-success">{{ session('brand_add') }}</div>
                            @endif
                            <div class="card-body">
                                <form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="" class="form-label">Brand_name</label>
                                        <input type="text" class="form-control" name="brand_name" placeholder="brand_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Note</label>
                                        <input type="text" class="form-control" name="others" placeholder="note">
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

    <!-- unit -->
    <div class="modal fade bd-example-modal-lg" id="addUnitModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card p-1">
                            <div class="card-header " style="background-color: #0cb0b7;">
                                <h3 class="text-white">Add Size</h3>
                            </div>
                            @if (session ('size_added'))
                            <div class="alert alert-success">{{ session('size_added') }}</div>
                            @endif
                            <div class="card-body">
                                <form action="{{route('size.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="" class="form-label">Size</label>
                                        <input type="text" class="form-control" name="size" placeholder="size_mesurment">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Description</label>
                                        <input type="text" class="form-control" name="description" placeholder="description">
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

    <!-- asset -->
    <div class="container">
        <div class="modal fade bd-example-modal-lg" id="addAssetModal" tabindex="-1" role="dialog"
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
                                    <h5 class="text-white">Add Product</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{route ('product.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="" class="form-label">Product</label>
                                            <input type="text" class="form-control" name="product">
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary" type="submit">submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor -->
    <div class="modal fade bd-example-modal-lg" id="addVendorModal" tabindex="-1" role="dialog"
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
                                <h5 class="text-white">Add Vendor</h5>
                            </div>
                            @error('suppler_add')
                            <strong>{{$message}}</strong>
                            @enderror
                            <div class="card-body">
                                <form action="{{route('supplier.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="" class="form-label">Supplier Name</label>
                                        <input type="text" class="form-control" name="supplier_name" placeholder="supplier name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" placeholder="Address">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Phone</label>
                                        <input type="number" class="form-control" name="phone" placeholder="phone">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Web</label>
                                        <input type="text" class="form-control" name="web" placeholder="web">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Others1</label>
                                        <input type="text" class="form-control" name="others1" placeholder="others1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Others2</label>
                                        <input type="text" class="form-control" name="others2" placeholder="others2">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Company -->

    <div class="modal fade bd-example-modal-lg" id="addCompanyModal" tabindex="-1" role="dialog"
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
                                <h5 class="text-white">Add Company</h5>
                            </div>
                            <div class="card-body">
                                @if (session ('company_added'))
                                <div class="alert alert-success">{{ session('company_added') }}</div>
                                @endif
                                <form action="{{route('company.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="" class="form-label">Compane name</label>
                                        <input type="text" class="form-control" name="company" placeholder="company_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Description</label>
                                        <input type="text" class="form-control" name="description" placeholder="description">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Location</label>
                                        <input type="text" class="form-control" name="location" placeholder="location">
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

    <!-- Location -->
    <div class="modal fade bd-example-modal-lg" id="addLocationModal" tabindex="-1" role="dialog"
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
                                <h5 class="text-white">Add Location</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{route ('department.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="" class="form-label">Department_name</label>
                                        <input type="text" class="form-control" name="department_name" placeholder="Department Name">
                                        @error('department_name')
                                        <strong>{{$message}}</strong>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- status -->
    <div class="container">
        <div class="modal fade bd-example-modal-lg " id="addStatusModal" tabindex="-1" role="dialog"
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
                                    <h5 class="text-white">Add Status</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{route('status.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="" class="form-label">Status</label>
                                            <input type="text" class="form-control" name="status_name" placeholder="status_name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Description</label>
                                            <input type="text" class="form-control" name="description" placeholder="description" required>
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
    </div>


    <!-- /.8 -->
</div>@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('.select2').select2(); // Initialize Select2 for dropdowns
    });
</script>
@endpush