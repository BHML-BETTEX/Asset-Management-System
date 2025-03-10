@extends('master')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bolder">Maintenance Product Return</h4>
                        <p class="mb-0">Enter All information to Maintenance Product</p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('ma_return_update')}}" method="POST" enctype="multipart/form-data" class="form-card">
                            @csrf

                            <div class="input-group input-group-outline mb-3">
                                <select id="asset_tag" name="asset_tag" class="form-control select2">
                                <option value="">Select a Product</option>
                                    @foreach ($issued_products as $issued_products)
                                        <option value="{{ $issued_products->asset_tag }}"
                                            data-asset_tag="{{ $issued_products->id }}">
                                            {{ $issued_products->asset_tag }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <input type="text" id="asset_type" class="form-control " value="" name="asset_type"
                                    readonly placeholder="Asset Type">
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <input type="text" id="model" class="form-control " value="" name="model"
                                    readonly placeholder="Model">
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <input type="text" id="purchase_date" class="form-control " value=""
                                    name="purchase_date" readonly placeholder="purchase_date">
                            </div>

                            <div class="form-group mb-3">
                                <label>Return Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required
                                    placeholder="End Date">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_label">Cost</label>
                                        <input id="" type="number" name="amount" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_label">Currency </span><a class="text-success" href=""><i
                                                    class="fa fa-plus" style="font-size:10px;"></a></i></label>
                                        <select id="form_need" name="currency" class="form-control"
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
                               
                                <div class="form-group">
                                    <label>Vendor</label>
                                    <select id="vendor" name="vendor" class="form-control">
                                        <option value="">Select Item</option>
                                        @foreach ($all_supplier as $supplier)
                                            <option value="{{ $supplier->supplier_name }}" {{ old('vendor') == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->supplier_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button class="btn btn-lg btn-success btn-lg w-100 mt-4 mb-0">Submit</button>
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
            $('#asset_tag').on('change', function() {
                let asset_tag = $('#asset_tag option:selected').data("asset_tag")
                $.ajax({
                    url: "{{ route('maintenance_search_id', '') }}/" + asset_tag,
                    success: function(result) {
                        //$("#div1").html(result);
                        
                        $('#asset_type').val(result.data.asset_type);
                        $('#model').val(result.data.model);
                        $('#purchase_date').val(result.data.purchase_date);
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

