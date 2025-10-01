@extends('master')

@section('content')
<div class="container position-sticky z-index-sticky top-0">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-6 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">Maintenance</h4>
                    <p class="mb-0">Enter all information for Maintenance Product</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('maintenance_store') }}" method="POST" enctype="multipart/form-data" class="form-card">
                        @csrf
                        <!-- Asset Tag -->
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="asset_tag" class="form-control"
                                value="{{ $store->asset_tag }}"
                                name="asset_tag" readonly placeholder="Asset Tag">
                        </div>

                        <!-- Asset Type -->
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="asset_type" class="form-control"
                                value="{{ $store->rel_to_ProductType->product_type_name ?? '' }}"
                                name="asset_type" readonly placeholder="Asset Type">
                        </div>

                        <!-- Model -->
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="model" class="form-control"
                                value="{{ $store->model ?? '' }}"
                                name="model" readonly placeholder="Model">
                        </div>

                        <!-- Purchase Date -->
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="purchase_date" class="form-control"
                                value="{{ $store->purchase_date ?? '' }}"
                                name="purchase_date" readonly placeholder="Purchase Date">
                        </div>

                        <!-- Company -->
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="company" class="form-control"
                                value="{{ $store->rel_to_Company->company_name ?? '' }}"
                                name="others" readonly placeholder="Company">
                        </div>

                        <!-- Note -->
                        <div class="input-group input-group-outline mb-3">
                            <textarea class="form-control" rows="3" id="note"
                                name="note" placeholder="Note">{{ $maintenance_data->note ?? '' }}</textarea>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <textarea class="form-control" rows="3" id="description"
                                name="description" placeholder="Type Reason...">{{ $maintenance_data->description ?? '' }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label>Start Date</label>
                            <input type="date" class="form-control" id="start_date"
                                name="strat_date" required
                                value="{{ $maintenance_data->strat_date ?? '' }}"
                                placeholder="Start Date">
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <textarea class="form-control" rows="3" id="note"
                                name="note" placeholder="Note">{{ $maintenance_data->note ?? '' }}</textarea>
                        </div>

                        <button class="btn btn-lg btn-success w-100 mt-4 mb-0">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection