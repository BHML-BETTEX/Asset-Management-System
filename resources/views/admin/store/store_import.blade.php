@extends('master')

@section('content')

<div class="container">
    <div class="row ">
        <div class="col-lg-8 m-auto">
            @if(Session::has('asset_data'))
            <p class="alert alert-success">{{ Session::get('asset_data') }}</p>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Import Assets Data</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('store_importexceldata')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Add Excel File</label>
                            <input class="form-control" type="file" name="asset_import"></input>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection