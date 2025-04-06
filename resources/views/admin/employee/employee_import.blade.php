@extends('master')

@section('content')

<div class="container">
    <div class="row ">
        <div class="col-lg-8 m-auto">
            @if(Session::has('import_data'))
            <p class="alert alert-success">{{ Session::get('import_data') }}</p>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3>Import Employee Data</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('employee_importexceldata') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Add Excel File</label>
                            <input class="form-control" type="file" name="import_file"></input>
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