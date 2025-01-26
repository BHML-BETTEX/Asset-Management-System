@extends('master')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bolder">Asst Return</h4>
                        <p class="mb-0">Enter All information to return Product</p>
                    </div>
                    <div class="card-body">
                        <form action="{{route("return_update")}}" method="POST" enctype="multipart/form-data"
                            class="form-card">
                            @csrf

                            <div class="input-group input-group-outline mb-3">
                                <select id="asset_tag" name="asset_tag" class="form-control">
                                    @foreach ($return_products as $return_products)
                                        <option value="{{ $return_products->products_id }}">{{ $return_products->products_id }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <input type="hidden" value="" name="asset_type">
                                <input type="text" id="asset_type" name="asset_type" class="form-control" value=""
                                    placeholder= "Asset Type" readonly>
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <input type="hidden" value="" name="model">
                                <input type="text" id="model" name="model" class="form-control" value=""
                                    placeholder= "Model" readonly>
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <input type="hidden" value="" name="">
                                <input type="text" class="form-control" value="" placeholder= "Employee ID"
                                    readonly>
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <input type="hidden" value="" name="">
                                <input type="text" class="form-control" value="" placeholder= "Employee Name"
                                    readonly>
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <input type="hidden" value="" name="">
                                <input type="text" class="form-control" value="" placeholder= "issue Date"
                                    readonly>
                            </div>

                            <div class="input-group input-group-outline mb-3">
                                <input type="hidden" value="" name="return_date">
                                <input type="date" class="form-control" name="return_date" value=""
                                    placeholder= "Return Date">
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
                let asset_tag = $('#asset_tag').val()

                $.ajax({
                    url: "{{ route('return.search.product', '') }}/" + asset_tag,
                    success: function(result) {
                        //$("#div1").html(result);
                        //  console.log (result.data.products_id);
                        $('#asset_type').val(result.data.asset_type);
                        $('#model').val(result.data.model);
                    }
                });

            });
        });
    </script>
@endpush
