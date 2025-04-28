@extends('master')
@section('content')
<div class="container position-sticky z-index-sticky top-0">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-6 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">Asst Issue</h4>
                    <p class="mb-0">Enter All information to issue Product</p>
                </div>
                <div class="card-body">
                    @foreach ($stores as $key => $stores)
                    <?php
                    if ($stores->status == '1') { ?>
                        <form action="{{ route('issue.store') }}" method="POST" enctype="multipart/form-data"
                            class="form-card">
                        <?php } ?>
                        @endforeach
                        @csrf
                        <div class="input-group input-group-outline mb-3">
                            <select id="products_id" name="asset_tag" class="form-control select2">
                                <option value="">Select a Product</option>
                                @foreach ($issued_products as $issued_products)
                                <option value="{{ $issued_products->products_id }}" data-products_id="{{ $issued_products->id }}">{{ $issued_products->products_id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="asset_type" class="form-control " value="{{ $issued_products->asset_type }}" name="asset_type" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="model" class="form-control " value="{{ $issued_products->model }}" name="model" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="company" class="form-control " value="{{ $issued_products->company }}" name="others" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <select id="empl_id" name="emp_id" class="form-control select2">
                                @foreach ($employee as $employee)
                                <option value="{{ $employee->emp_id }}" data-emp_id="{{ $employee->id }}">{{ $employee->emp_id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="hidden" value="" name="emp_name">
                            <input type="text" id="emp_name" class="form-control" value="{{ $employee->emp_name }}"
                                id="emp_name" name="emp_name" placeholder="Employee Name" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="hidden" value="" name="designation_id">
                            <input type="text" class="form-control" value="" id="designation_id"
                                name="designation_id" placeholder="Designation" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="hidden" value="" name="department_id">
                            <input type="text" class="form-control" value="" id="department_id"
                                name="department_id" placeholder="Department" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="hidden" value="" name="phone_number">
                            <input type="number" class="form-control" value="" id="phone_number" name="phone_number"
                                placeholder="phone_number" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="hidden" value="" name="email">
                            <input type="text" class="form-control" value="" id="email" name="email"
                                placeholder="email" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="hidden" value="" name="issue_date">
                            <input type="date" class="form-control" id="issue_date" name="issue_date" required
                                placeholder="Issue Date">
                        </div>

                </div>
                <div class="d-flex flex-wrap gap-2 mt-4">
                    <button type="submit" class="btn btn-success btn-lg flex-fill"><span class="fa fa-file-text"> Submit</button>
                    <button type="reset" class="btn btn-secondary btn-lg "><span class="fa fa-undo"></span> Reset</button>
                    <a href="{{ route('store') }}" class="btn btn-info btn-lg text-white text-center"><span class="fa fa-step-backward"></span> Back</a>
                </div>

            </div>

            </form>

        </div>
    </div>
</div>
</div>
</div>
@endsection

@push('script')
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
    $(document).ready(function() {
        $('#products_id').on('change', function() {
            let products_id = $('#products_id option:selected').data("products_id")
            $.ajax({
                url: "{{ route('search.product', '') }}/" + products_id,
                success: function(result) {
                    //$("#div1").html(result);
                    //   console.log (result.data.products_id);
                    $('#asset_type').val(result.data.asset_type);
                    $('#model').val(result.data.model);
                    $('#company').val(result.data.company);
                }
            });

        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endpush