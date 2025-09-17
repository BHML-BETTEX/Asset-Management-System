@extends('master')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="container">
    <div class="page-title">
        <div class="row ">
            <div class="col-md-12 col-xl-12 col-lg-12">
                <div class="col-md-3 col-lg-3 col-sm-3 p-2">
                    <h5 class="text-white">Product Issue List</h5>
                </div>

                <div class="col-md-3 col-lg-3 d-flex flex-wrap gap-1">
                    <a href="" class="btn btn-info text-white" data-toggle="modal" data-target="#addissueModal"><i class="fa fa-plus"></i> Add</a>
                </div>
                <div class="col-md-4 top_search">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" placeholder="Search for..."
                                value="{{ $search }}">
                            <button class="btn btn-secondary" type="submit">Go!</button>
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
                                        <th>Issue Date</th>
                                        <th>Issue Qty</th>
                                        <th>Units</th>
                                        <th>Emp ID</th>
                                        <th>Employee Name</th>
                                        <th>Department</th>
                                        <th>Company</th>
                                        <th>Note</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody style="height: 3px !important; overflow: scroll; ">
                                    @foreach($issue_details as $key => $issue_detail)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$issue_detail->product_type}}</td>
                                        <td>{{$issue_detail->model_id}}</td>
                                        <td>{{$issue_detail->issue_date}}</td>
                                        <td>{{$issue_detail->issue_qty}}</td>
                                        <td>{{$issue_detail->rel_to_SizeMaseurment->size}}</td>
                                        <td>{{$issue_detail->emp_id}}</td>
                                        <td>{{$issue_detail->emp_name}}</td>
                                        <td>{{$issue_detail->rel_to_Department->department_name}}</td>
                                        <td>{{$issue_detail->rel_to_Company->company}}</td>
                                        <td>{{$issue_detail->others}}</td>
                                        <td>
                                            <button class="border-0 bg-white"><a class="text-primary"
                                                    href=""><i
                                                        class="fa fa-edit "
                                                        style="font-size:20px;"></a></i></button>

                                            <button class="border-0 bg-white"><a class="text-danger"
                                                    href="{{route('consumableIssue_delete', $issue_detail->id)}}"><i
                                                        class="fa fa-trash "
                                                        style="font-size:20px;"></a></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{$issue_details->Links()}}
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
                        <div class="card-header" style="background-color: #0cb0b7;">
                            <h5 class="text-white">Consumable Issuesss</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('consumableIssue_store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="controls">
                                    <!-- Issue Date -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="issue_date">Issue date</label>
                                                <input id="issue_date" type="date" name="issue_date" class="form-control">
                                            </div>
                                        </div>

                                        <!-- Product Type -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="product_type">Product Name *</label>
                                                <select id="product_type" name="product_type" class="form-control select2" required>
                                                    <option value="" selected disabled>-- Select Asset Type --</option>
                                                    @foreach ($productdetails as $productdetail)
                                                    <option value="{{ $productdetail->asset_type }}">
                                                        {{ $productdetail->rel_to_ProductType->product }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Model & Stock Qty -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="model_id">
                                                    Model *
                                                    <span class="text-success" data-toggle="modal" data-target="#addBrandModal">
                                                        <i class="fa fa-plus" style="font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select id="model_id" name="model_id" class="form-control select2" required>
                                                    <option value="" selected disabled>-- Select Model --</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="qty">Stock Qty <span class="text-danger">*</span></label>
                                                <input id="qty" type="number" name="qty" class="form-control" value="" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Issue Qty & Units -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="issue_qty">Issue Qty <span class="text-danger">*</span></label>
                                                <input id="issue_qty" type="number" name="issue_qty" class="form-control" value="1">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="units_id">Units <span class="text-danger">*</span></label>
                                                <select id="units_id" name="units_id" class="form-control select2" required>
                                                    <option value="" selected disabled>-- Select Units --</option>
                                                    @foreach ($all_SizeMaseurment as $all_SizeMaseurment)
                                                    <option value="{{ $all_SizeMaseurment->id }}">
                                                        {{ $all_SizeMaseurment->size }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Employee & Department -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emp_name">Employee Name <span class="text-danger">*</span></label>
                                                <select id="emp_name" name="emp_name" class="form-control select2" required>
                                                    <option value="" selected disabled>-- Select Employee --</option>
                                                    @foreach ($employee as $employees)
                                                    <option value="{{ $employees->emp_name }}" data-emp-id="{{ $employees->emp_id }}">
                                                        {{ $employees->emp_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emp_id">Employee ID</label>
                                                <input id="emp_id" type="text" name="emp_id" class="form-control" value="" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Company -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="department_id">Department <span class="text-danger">*</span></label>
                                                <select id="department_id" name="department_id" class="form-control select2" required>
                                                    <option value="" selected disabled>-- Select Department --</option>
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
                                                <label for="company">Company <span class="text-danger">*</span></label>
                                                <select id="company" name="company" class="form-control select2" required>
                                                    <option value="" selected disabled>-- Select Company --</option>
                                                    @foreach ($all_company as $all_companys)
                                                    <option value="{{ $all_companys->id }}">
                                                        {{ $all_companys->company }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Note -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="form_message">Note</label>
                                                <textarea id="form_message" name="others" class="form-control" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">
                                                <span class="fa fa-file-text"></span> Submit
                                            </button>
                                            <button type="reset" class="btn btn-secondary">
                                                <span class="fa fa-undo"></span> Reset
                                            </button>
                                            <a href="{{ route('consumableIssue') }}" class="btn btn-info">
                                                <span class="fa fa-step-backward"></span> Back
                                            </a>
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

<!-- 

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 -->
@if(session('issued_success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session("issued_success") }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('product_delete'))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session("item_delete") }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif

<script>
    $(document).ready(function() {
        $('#emp_name').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var empId = selectedOption.data('emp-id');
            console.log("Selected Emp ID:", empId);
            $('#emp_id').val(empId || '');
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Initialize Select2 when modal is shown
        $('#addissueModal').on('shown.bs.modal', function() {
            $('.select2').select2({
                placeholder: "-- Select Asset Type --",
                allowClear: true,
                width: '100%',
                minimumResultsForSearch: 0,
                dropdownParent: $('#addissueModal') // Attach dropdown to modal
            });
        });
    });
</script>
@endpush
