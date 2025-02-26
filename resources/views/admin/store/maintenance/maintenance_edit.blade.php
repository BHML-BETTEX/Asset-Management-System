@extends('master')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bolder">Maintenance info Edit</h4>
                        <p class="mb-0">Enter All information to Maintenance Product</p>
                    </div>
                    <div class="card-body">
                            <form action="{{route('maintenance_update')}}" method="POST" enctype="multipart/form-data"
                                class="form-card">

                        @csrf
                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="asset_tag"  class="form-control " value="{{$maintenance_data->asset_tag}}" name="asset_tag" readonly >
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="asset_type"  class="form-control " value="{{$maintenance_data->asset_type}}" name="asset_type" readonly >
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="model"  class="form-control " value="{{$maintenance_data->model}}" name="model" readonly >
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input type="text" id="purchase_date"  class="form-control " value="{{$maintenance_data->purchase_date}}" name="purchase_date" readonly>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input class="form-control" rows="3" id="description" value="{{$maintenance_data->description}}" name="description" placeholder="Type Reason..."></input>
                        </div>

                        <div class="form-group mb-3">
                            <label>Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="strat_date" 
                                value="{{$maintenance_data->strat_date}}">
                                
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <input class="form-control" rows="3" id="note" name="note" placeholder="Note" value="{{$maintenance_data->note}}">
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
   


{{-- <script>
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
                }
            });

        });
    });
</script> --}}


@endpush
