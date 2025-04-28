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
                            <select id="asset_tag" name="asset_tag" class="form-control select2">
                                <option value="">Select a Product</option>
                                @foreach ($return_products as $return_products)
                                <option value="{{ $return_products->asset_tag }} " data-asset_tag="{{ $return_products->id }}">{{ $return_products->asset_tag }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="hidden" value="" name="asset_type">
                            <input type="text" id="asset_type" name="asset_type" class="form-control" value=""
                                placeholder="Asset Type" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="hidden" value="" name="model">
                            <input type="text" id="model" name="model" class="form-control" value=""
                                placeholder="Model" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="hidden" value="" name="">
                            <input type="text" id="emp_id" name="emp_id" class="form-control" value="" placeholder="Employee ID"
                                readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="hidden" value="" name="">
                            <input type="text" id="emp_name" name="emp_name" class="form-control" value="" placeholder="Employee Name"
                                readonly>
                        </div>

                        <div class="form-group mb-3">
                            <input type="hidden" value="" name="return_date">
                            <input type="date" id="issue_date" name="issue_date" class="form-control" name="return_date" value=""
                                readonly>
                        </div>


                        <div class="form-group mb-3">
                            <label class="form-label">Return Date</label>
                            <input type="hidden" value="" name="return_date">
                            <input type="date" class="form-control" name="return_date" value=""
                                placeholder="Return Date">
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <button type="submit" class="btn btn-success btn-lg flex-fill">Submit</button>
                            <button type="reset" class="btn btn-secondary btn-lg ">Reset</button>
                            <a href="{{ route('store') }}" class="btn btn-info btn-lg text-white text-center">Back</a>
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
        $('#asset_tag').on('change', function() {

            let asset_tag = $('#asset_tag option:selected').data("asset_tag")

            $.ajax({
                url: "{{ route('return.search.product', '') }}/" + asset_tag,
                success: function(result) {
                    //$("#div1").html(result);
                    console.log(result.data.asset_tag);
                    $('#asset_type').val(result.data.asset_type);
                    $('#model').val(result.data.model);
                    $('#emp_id').val(result.data.emp_id);
                    $('#emp_name').val(result.data.emp_name);
                    $('#issue_date').val(result.data.issue_date);


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