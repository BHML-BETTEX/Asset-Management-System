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
                            <form action="{{route('transfer_return_update')}}" method="POST" enctype="multipart/form-data"
                                class="form-card">

                        @csrf
                        <div class="input-group input-group-outline mb-3">
                            <select id="asset_tag" name="asset_tag" class="form-control">
                                @foreach ($transfer_return as $transfer_return)
                                    <option  value="{{ $transfer_return->asset_tag }}" data-asset_tag="{{ $transfer_return->id }}" >{{ $transfer_return->asset_tag }}</option>
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

                        <div class="input-group input-group-outline mb-3">
                            <input type="date" id="company"  class="form-control " value="" name="return_date" >
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
        $('#asset_tag').on('change', function() {   
            let asset_tag = $('#asset_tag option:selected').data("asset_tag")
            $.ajax({
                url: "{{ route('transfer_return_search_id', '') }}/" + asset_tag,
                success: function(result) {
                     //$("#div1").html(result);
                       console.log (result.data.asset_tag);
                   //$('#asset_type').val(result.data.asset_type);
                    // $('#model').val(result.data.model);
                    // $('#company').val(result.data.company);

                }
            });

        });
    });
</script>


@endpush
