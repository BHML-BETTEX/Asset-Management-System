@extends('master')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bolder">Wast Product</h4>
                        <p class="mb-0">Enter All information to Waste Product</p>
                    </div>
                    <div class="card-body">
                            <form action="{{route('wastproduct_store')}}" method="POST" enctype="multipart/form-data"
                                class="form-card">

                        @csrf
                        <div class="input-group input-group-outline mb-3">
                            <select id="products_id" name="asset_tag" class="form-control" required>
                                @foreach ($issued_products as $issued_products)
                                    <option  value="{{ $issued_products->products_id }}" data-products_id="{{ $issued_products->id }}" >{{ $issued_products->products_id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="asset_type"  class="form-control " value="" name="asset_type" readonly placeholder="Asset Type">
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="model"  class="form-control " value="" name="model" readonly placeholder="Model">
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="purchase_date"  class="form-control " value="" name="purchase_date" readonly placeholder="purchase_date">
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input class="form-control" rows="3" id="asset_sl_no" name="asset_sl_no" placeholder="Serial No" required readonly></input>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="company"  class="form-control " value="" name="others" readonly placeholder="Comapny">
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <textarea class="form-control" rows="3" id="description" name="description" placeholder="Type Reason..." required></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label>Date</label>
                            <input type="date" class="form-control" id="date" name="date" required
                                placeholder="Date">
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <textarea class="form-control" rows="3" id="note" name="note" placeholder="Note"></textarea>
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
        $('#products_id').on('change', function() {   
            let products_id = $('#products_id option:selected').data("products_id")
            $.ajax({
                url: "{{ route('search.product', '') }}/" + products_id,
                success: function(result) {
                     //$("#div1").html(result);
                       //console.log (result.data.products_id);
                    $('#asset_type').val(result.data.asset_type);
                    $('#model').val(result.data.model);
                    $('#purchase_date').val(result.data.purchase_date);
                    $('#asset_sl_no').val(result.data.asset_sl_no);
                    $('#company').val(result.data.company);


                }
            });

        });
    });
</script>


@endpush
