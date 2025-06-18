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
                                                <label for="form_label">Product Name * <span class="text-success" data-toggle="modal" data-target="#addBrandModal"></span>
                                                </label>
                                                <select id="product_type" name="product_type"
                                                    class="form-control " required>
                                                    <option value="" selected disabled>-- Select Asset Type --</option>
                                                    @foreach ($productdetails as $productdetail)
                                                    <option value="{{ $productdetail->asset_type }}">
                                                        {{$productdetail->rel_to_ProductType->product}}
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
                                                    @foreach ($employee as $employees)
                                                    <option value="{{ $employees->emp_name}}">
                                                        {{ $employees->emp_name }}
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
                                                <label for="form_label">Company<span
                                                        class="text-danger">*</span></label>
                                                <span class="text-success" data-toggle="modal" data-target="#addUnitModal"></span>
                                                </label>

                                                <select id="form_label" name="company"
                                                    class="form-control" required="required">
                                                    <option value="" selected disabled>--Select
                                                        Your
                                                        Issue--</option>
                                                    @foreach ($all_company as $all_companys)
                                                    <option value="{{ $all_companys->id }}">
                                                        {{ $all_companys->company }}
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
@endpush