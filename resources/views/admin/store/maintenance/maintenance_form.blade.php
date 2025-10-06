@extends('master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-7 col-md-8 col-sm-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-success text-white rounded-top-4">
                    <h4 class="font-weight-bolder mb-1">Maintenance Info</h4>
                    <p class="mb-0 text-light small">Enter or update maintenance details for the asset</p>
                </div>

                <div class="card-body">
                    <form action="{{ route('maintenance_store') }}" method="POST" enctype="multipart/form-data" class="form-card">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Asset Tag</label>
                                <input type="text" class="form-control" name="asset_tag" value="{{ $maintenance_data->asset_tag ?? '' }}" readonly>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Asset Type</label>
                                <input type="text" class="form-control" name="asset_type" value="{{ $maintenance_data->rel_to_ProductType->product ?? '' }}" readonly>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Model</label>
                                <input type="text" class="form-control" name="model" value="{{ $maintenance_data->model ?? '' }}" readonly>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Purchase Date</label>
                                <input type="text" class="form-control" name="purchase_date" value="{{ $maintenance_data->purchase_date ?? '' }}" readonly>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <input type="text" class="form-control" name="description" value="{{ $maintenance_data->description ?? '' }}" readonly>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Start Date</label>
                                <input type="date" class="form-control" name="strat_date" value="{{ $maintenance_data->strat_date ?? '' }}" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Note</label>
                                <input type="text" class="form-control" name="note" value="{{ $maintenance_data->note ?? '' }}">
                            </div>
                        </div>

                        <!-- Back and Submit buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('maintenance_list', ['store_id' => $stores->id]) }}" class="btn btn-secondary btn-lg fw-bold">
                                <i class="fa fa-arrow-left me-2"></i> Back
                            </a>
                            <button class="btn btn-success btn-lg fw-bold shadow-sm" type="submit">
                                <i class="fa fa-save me-2"></i> Submit
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection