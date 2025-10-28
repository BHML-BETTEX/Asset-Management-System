@extends('master')

@section('content')
<div class="container position-sticky z-index-sticky top-0">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-6 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">Asset Transfer Request</h4>
                    <p class="mb-0">Submit a transfer request. The receiving company will be notified to approve this transfer.</p>
                </div>
                <div class="card-body">
                    <form action="{{route('transfer.store')}}" method="POST" enctype="multipart/form-data"
                        class="form-card">
                        @csrf
                        {{-- Product Dropdown --}}
                        <div class="input-group input-group-outline mb-3">
                            <select id="products_id" name="asset_tag" class="form-control select2">
                                <option value="">Select a Product</option>
                                @foreach ($issued_products as $product)
                                <option value="{{ $product->asset_tag }}" data-products_id="{{ $product->id }}">
                                    {{ $product->asset_tag }} | {{ $product->rel_to_ProductType->product }} | {{ $product->model }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="asset_type" class="form-control " value="" name="asset_type" readonly placeholder="Asset Type">
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="model" class="form-control " value="" name="model" readonly placeholder="Model">
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="company" class="form-control " value="" name="oldcompany" readonly placeholder="Old Company">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">New Company</label>
                            <select id="id" name="company" class="form-control">
                                @foreach ($companies as $companys)
                                <option value="{{ $companys->id }}" data-id="{{ $companys->id }}">{{ $companys->company }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Transfer Type</label>
                            <select name="item_status" class="form-control" id="transferType">
                                <option value="transfer">Permanent Transfer</option>
                                <option value="borrowed">Borrowed Item</option>
                            </select>
                            <small class="form-text text-muted">
                                • Permanent Transfer: Asset ownership changes to new company<br>
                                • Borrowed Item: Asset remains owned by original company but used by new company
                            </small>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="description" class="form-control " value="" name="description" readonly placeholder="company details">
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="Note" class="form-control " value="" name="note" placeholder="Note">
                        </div>

                        <div class="input-group input-group-outline mb-3">

                            <input type="hidden" value="" name="transfer_date">
                            <input type="date" class="form-control" id="transfer_date" name="transfer_date" required
                                placeholder="Transfer Date">
                        </div>
                </div>
                <div class="d-flex flex-wrap gap-2 mt-4">
                    <button class="btn btn-success btn-lg flex-fill"><span class="fa fa-file-text"> Submit</span></button>
                    <button type="reset" class="btn btn-secondary btn-lg "><span class="fa fa-undo"></span> Reset</button>
                    <a href="{{ route('store') }}" class="btn btn-info btn-lg text-white text-center"><span class="fa fa-step-backward"></span> Back</a>
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
        $('#id').on('change', function() {
            let id = $('#id option:selected').data("id")
            $.ajax({
                url: "{{ route('search.company', '') }}/" + id,
                success: function(result) {
                    //$("#div1").html(result);
                    //console.log (result.data.company);
                    $('#description').val(result.data.description);
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
                    //console.log (result.data.products_id);
                    $('#asset_type').val(result.data.asset_type);
                    $('#model').val(result.data.model);
                    $('#company').val(result.data.company_id);

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