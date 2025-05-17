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
                <div class="col-md-5 col-lg-4 top_search">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" placeholder="Search for text...." value="{{ request('search') }}">

                            <select id="product_search" name="product_search" class="form-control select2" data-error="Please specify your need.">
                                <option value="">--Product Type--</option>
                                @foreach ($all_product_types as $all_product)
                                <option value="{{ $all_product->id }}" {{ request('product_search') == $all_product->id ? 'selected' : '' }}>
                                    {{ $all_product->product }}
                                </option>
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
                                        <th>STATUS</th>
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
                                        <td id="action-btn-{{ $store->id }}">
                                            @if($store->checkstatus === 'INSTOCK')
                                            <button class="btn btn-outline-success btn-sm">
                                                <a href="#"
                                                    class="issue-btn text-success"
                                                    data-toggle="modal"
                                                    data-target="#issueModal"
                                                    data-id="{{ $store->id }}"
                                                    data-asset-tag="{{ $store->products_id }}"
                                                    data-asset-type="{{ $store->rel_to_ProductType->product }}"
                                                    data-model="{{ $store->model }}"
                                                    data-company="{{ $store->rel_to_Company->company }}">
                                                    INSTOCK
                                                </a>
                                            </button>
                                            @else
                                            <button class="btn btn-outline-primary btn-sm">
                                                <a href="#"
                                                    class="return-btn text-primary"
                                                    data-toggle="modal"
                                                    data-target="#returnModal"
                                                    data-id="{{ $store->id }}"
                                                    data-asset-tag="{{ $store->products_id }}"
                                                    data-asset-type="{{ $store->rel_to_ProductType->product}}"
                                                    data-model="{{ $store->model }}">
                                                    ISSUED
                                                </a>
                                            </button>
                                            @endif
                                        </td>
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

<!-- Issue Modal -->

<div class="modal fade" id="issueModal" tabindex="-1" role="dialog" aria-labelledby="issueModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Issue Asset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('issue.store') }}" method="POST" enctype="multipart/form-data" class="form-card">
                    @csrf
                    <input type="hidden" id="issue_id" name="store_id" value="">

                    <div class="input-group input-group-outline mb-3">
                        <input type="text" id="asset_tag" class="form-control" name="asset_tag" readonly>
                    </div>

                    <div class="input-group input-group-outline mb-3">
                        <input type="text" id="asset_type" class="form-control" name="asset_type" readonly>
                    </div>

                    <div class="input-group input-group-outline mb-3">
                        <input type="text" id="model" class="form-control" name="model" readonly>
                    </div>

                    <div class="input-group input-group-outline mb-3">
                        <input type="text" id="company" class="form-control" name="others" readonly>
                    </div>

                    <!-- example employee selector -->
                    <div class="input-group input-group-outline mb-3">
                        <select id="empl_id" name="emp_id" class="form-control select2">
                            @foreach ($employee as $employee)
                            <option value="{{ $employee->emp_id }}" data-emp_id="{{ $employee->id }}">{{ $employee->emp_id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- other read-only fields -->
                    <div class="input-group input-group-outline mb-3">
                        <input type="text" id="emp_name" class="form-control" name="emp_name" placeholder="Employee Name" readonly>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <input type="text" id="designation_id" class="form-control" name="designation_id" placeholder="Designation" readonly>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <input type="text" id="department_id" class="form-control" name="department_id" placeholder="Department" readonly>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <input type="number" id="phone_number" class="form-control" name="phone_number" placeholder="Phone Number" readonly>
                    </div>
                    <div class="input-group input-group-outline mb-3">
                        <input type="email" id="email" class="form-control" name="email" placeholder="Email" readonly>
                    </div>

                    <div class="input-group input-group-outline mb-3">
                        <input type="date" id="issue_date" class="form-control" name="issue_date" required>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-success btn-lg flex-fill">
                            <span class="fa fa-file-text"></span> Submit
                        </button>
                        <button type="reset" class="btn btn-secondary btn-lg">
                            <span class="fa fa-undo"></span> Reset
                        </button>
                        <a href="{{ route('store') }}" class="btn btn-info btn-lg text-white">
                            <span class="fa fa-step-backward"></span> Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Return Asset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('return_update')}}" method="POST" enctype="multipart/form-data"
                    class="form-card">
                    @csrf

                    <div class="input-group input-group-outline mb-3">
                        <input type="hidden" value="" name="asset_tag">
                        <input type="text" id="asset_tag" name="asset_tag" class="form-control" value=""
                            placeholder="Asset Tag" readonly>

                    </div>

                    <div class="input-group input-group-outline mb-3">
                        <input type="hidden" value="" name="asset_type">
                        <input type="text" id="asset_type" name="asset_type" class="form-control" value=""
                            placeholder="Asset Type" readonly>
                    </div>

                    <div class="input-group input-group-outline mb-3">
                        <input type="hidden" value="" name="model">
                        <input type="text" id="model" name="model" class="form-control" value=""
                            placeholder="Model" readonly>
                    </div>

                    <div class="input-group input-group-outline mb-3">
                        <input type="hidden" value="" name="">
                        <input type="text" id="emp_id" name="emp_id" class="form-control" value="" placeholder="Employee ID"
                            readonly>
                    </div>

                    <div class="input-group input-group-outline mb-3">
                        <input type="hidden" value="" name="">
                        <input type="text" id="emp_name" name="emp_name" class="form-control" value="" placeholder="Employee Name"
                            readonly>
                    </div>

                    <div class="form-group mb-3">
                        <input type="hidden" value="" name="return_date">
                        <input type="date" id="issue_date" name="issue_date" class="form-control" name="return_date" value=""
                            readonly>
                    </div>


                    <div class="form-group mb-3">
                        <label class="form-label">Return Date</label>
                        <input type="hidden" value="" name="return_date" required>
                        <input type="date" class="form-control" name="return_date" value=""
                            placeholder="Return Date" required>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-success btn-lg flex-fill"><span class="fa fa-file-text"> Submit</button>
                        <button type="reset" class="btn btn-secondary btn-lg "><span class="fa fa-undo"></span> Reset</button>
                        <a href="{{ route('store') }}" class="btn btn-info btn-lg text-white text-center"><span class="fa fa-step-backward"></span> Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.issue-btn').forEach(button => {
            button.addEventListener('click', function() {
                const ds = this.dataset;

                document.getElementById('issue_id').value = ds.id;
                document.getElementById('asset_tag').value = ds.assetTag;
                document.getElementById('asset_type').value = ds.assetType;
                document.getElementById('model').value = ds.model;
                document.getElementById('company').value = ds.company;
                // if you're using select2 or bootstrap-select:
                $('.select2').trigger('change');
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#empl_id').on('change', function() {
            let empl_id = $('#empl_id option:selected').data("emp_id")
            $.ajax({
                url: "{{ route('search.empl', '') }}/" + empl_id,
                success: function(result) {
                    // $("#div1").html(result);
                    $('#emp_name').val(result.data.emp_name);
                    $('#designation_id').val(result.data.designation_id);
                    $('#department_id').val(result.data.department_id);
                    $('#phone_number').val(result.data.phone_number);
                    $('#email').val(result.data.email);
                }
            });

        });
    });
</script>

<script>
    document.querySelectorAll('.return-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const ds = this.dataset;
            $('#returnModal #return_id').val(ds.id);
            $('#returnModal #asset_tag').val(ds.assetTag);
            $('#returnModal #asset_type').val(ds.assetType);
            $('#returnModal #model').val(ds.model);
            $('#returnModal #company').val(ds.company);
        });
    });
</script>


@endpush