@extends('master')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bolder">Asset Transfer</h4>
                        <p class="mb-0">Enter All information to Transfer Product</p>
                    </div>
                    <div class="card-body">
                            <form action="{{route('transfer.store')}}" method="POST" enctype="multipart/form-data"
                                class="form-card">

                        @csrf
                        <div class="input-group input-group-outline mb-3">
                            <select id="products_id" name="asset_tag" class="form-control">
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
                            <input type="text" id="company"  class="form-control " value="" name="oldcompany" readonly placeholder="Old Company">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">New Comapny</label>
                            <select id="id" name="company" class="form-control">
                                @foreach ($companys as $companys)
                                    <option value="{{ $companys->company }}" data-id="{{ $companys->id }}">{{ $companys->company }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="description"  class="form-control " value="" name="description" readonly placeholder="company details">
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="Note"  class="form-control " value="" name="note" placeholder="Note">
                        </div>
  
                        <div class="input-group input-group-outline mb-3">
                            
                            <input type="hidden" value="" name="transfer_date">
                            <input type="date" class="form-control" id="transfer_date" name="transfer_date" required
                                placeholder="Transfer Date">
                        </div>
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
                    $('#company').val(result.data.company);

                }
            });

        });
    });
</script>


@endpush
