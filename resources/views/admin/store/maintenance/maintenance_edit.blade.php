@extends('master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-8 col-sm-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="font-weight-bolder mb-1">Edit Maintenance</h4>
                    <p class="mb-0 text-light small">Update maintenance details for the asset</p>
                </div>

                <div class="card-body">
                    <form action="{{ route('maintenance_update', $maintenance_data->id) }}" method="POST" class="form-card">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Asset Tag</label>
                            <input type="text" class="form-control" value="{{ $maintenance_data->asset_tag }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Asset Type</label>
                            <input type="text" class="form-control" value="{{ $maintenance_data->asset_type }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Model</label>
                            <input type="text" class="form-control" value="{{ $maintenance_data->model }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <input type="text" class="form-control" name="description" value="{{ $maintenance_data->description }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Start Date</label>
                            <input type="date" class="form-control" name="strat_date" value="{{ $maintenance_data->strat_date }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">End Date</label>
                            <input type="date" class="form-control" name="end_date" value="{{ $maintenance_data->end_date }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Note</label>
                            <input type="text" class="form-control" name="note" value="{{ $maintenance_data->note }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Amount</label>
                            <input type="number" class="form-control" name="amount" value="{{ $maintenance_data->amount }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Currency</label>
                            <input type="text" class="form-control" name="currency" value="{{ $maintenance_data->currency }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Vendor</label>
                            <input type="text" class="form-control" name="vendor" value="{{ $maintenance_data->vendor }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Others</label>
                            <input type="text" class="form-control" name="others" value="{{ $maintenance_data->others }}">
                        </div>

                        <!-- Back and Update Buttons -->
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('maintenance_list', ['store_id' => $store->id]) }}" class="btn btn-secondary btn-lg fw-bold">
                                <i class="fa fa-arrow-left me-2"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">
                                <i class="fa fa-save me-2"></i> Update
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection