@extends('master')
@section('content')
<div class="container position-sticky z-index-sticky top-0">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-6 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">Asset Issue</h4>
                    <p class="mb-0">Enter all information to issue a product</p>
                </div>
                <div class="card-body">

                    {{-- Ensure you are sending a single store object --}}
                    @if(isset($store))
                    <form action="{{ route('issue.store') }}" method="POST" enctype="multipart/form-data" class="form-card">
                        @csrf

                        {{-- Hidden Store ID --}}
                        <input type="hidden" name="store_id" value="{{ $store->id }}">

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="asset_tag" class="form-control" name="asset_tag"
                                value="{{ $store->asset_tag }}" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="asset_type" class="form-control" name="asset_type"
                                value="{{ $store->rel_to_ProductType->product ?? '' }}" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="model" class="form-control" name="model"
                                value="{{ $store->model }}" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="company" class="form-control" name="others"
                                value="{{ $store->rel_to_Company->company ?? '' }}" readonly>
                        </div>

                        {{-- Employee Dropdown --}}
                        <div class="input-group input-group-outline mb-3">
                            <select id="empl_id" name="emp_id" class="form-control select2" required>
                                <option value="">Select Employee</option>
                                @foreach ($employee as $emp)
                                    <option value="{{ $emp->emp_id }}" data-emp_id="{{ $emp->id }}">
                                        {{ $emp->emp_id }} || {{ $emp->emp_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Employee Info Fields --}}
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="emp_name" class="form-control" name="emp_name" placeholder="Employee Name" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" id="designation_id" name="designation_id" placeholder="Designation" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" id="department_id" name="department_id" placeholder="Department" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="date" class="form-control" id="issue_date" name="issue_date" placeholder="Issue Date" required>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <button type="submit" class="btn btn-success btn-lg flex-fill">
                                <i class="fa fa-file-text"></i> Submit
                            </button>
                            <button type="reset" class="btn btn-secondary btn-lg">
                                <i class="fa fa-undo"></i> Reset
                            </button>
                            <a href="{{ route('store') }}" class="btn btn-info btn-lg text-white text-center">
                                <i class="fa fa-step-backward"></i> Back
                            </a>
                        </div>
                    </form>
                    @else
                        <p class="text-danger text-center mt-3">No store information available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        // Employee selection - load employee info
        $('#empl_id').on('change', function() {
            let empl_id = $('#empl_id option:selected').data("emp_id");
            if (!empl_id) return;
            $.ajax({
                url: "{{ route('search.empl', '') }}/" + empl_id,
                success: function(result) {
                    if (result.data) {
                        $('#emp_name').val(result.data.emp_name);
                        $('#designation_id').val(result.data.designation_id);
                        $('#department_id').val(result.data.department_id);
                        $('#phone_number').val(result.data.phone_number);
                        $('#email').val(result.data.email);
                    }
                }
            });
        });

        // Initialize select2
        $('.select2').select2();
    });
</script>

@endpush
