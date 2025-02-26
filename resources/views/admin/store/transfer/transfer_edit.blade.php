@extends('master')

@section('content')
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="font-weight-bolder">Edit Transfer Data</h4>
                        <p class="mb-0">Enter All information to Transfer Product</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transfer_update') }}" method="POST" enctype="multipart/form-data"
                            class="form-card">

                            @csrf
                            <div class="form-group">
                                <label for="" class="form-label">Asset Tag</label>
                                <input type="hidden" value="{{ $transfer_data->id }}" name="id">
                                <input type="text" class="form-control" name="asset_tag"
                                    value="{{ $transfer_data->asset_tag }}" readonly></input>
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label">Asset Type</label>
                                <input type="hidden" value="{{ $transfer_data->id }}" name="asset_type">
                                <input type="text" class="form-control" name="asset_type"
                                    value="{{ $transfer_data->asset_type }}" readonly></input>
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label">Model</label>
                                <input type="hidden" value="{{ $transfer_data->id }}" name="model">
                                <input type="text" class="form-control" name="model"
                                    value="{{ $transfer_data->model }}" readonly></input>
                            </div>

                            <div class="form-group">
                                <label for="" class="form-label">Company</label>
                                <select id="id" name="company" class="form-control">
                                    @foreach ($companys as $companys)
                                        <option value="{{ $companys->company }}" data-id="{{ $companys->id }}">{{ $companys->company }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="from-group mb-3">
                                <label for="" class="form-label">Description</label>
                                <input type="hidden" value="{{ $transfer_data->id }}" name="description">
                                <input type="text" class="form-control" name="description"
                                    value="{{ $transfer_data->description }}" readonly></input>
                            </div>

                            <div class="from-group mb-3">
                                <label for="" class="form-label">Note</label>
                                <input type="hidden" value="{{ $transfer_data->id }}" name="note">
                                <input type="text" class="form-control" name="note"
                                    value="{{ $transfer_data->note }}"></input>
                            </div>

                            <div class="from-group mb-3">
                                <label for="" class="form-label">Transfer Date</label>
                                <input type="hidden" value="{{ $transfer_data->id }}" name="transfer_date">
                                <input type="date" class="form-control" name="transfer_date"
                                    value="{{ $transfer_data->transfer_date }}"></input>
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
    {{-- <script>
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
                }
            });

        });
    });
</script> --}}
@endpush
