@extends('master')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header" style="background-color: #0cb0b7; color:white;">
                    <h3>Designation List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Designation</th>
                            <th>Action</th>
                        </tr>

                        @if (session('delete_designation'))
                            <div class="alert alert-success">{{ session('delete_designation') }}</div>
                        @endif

                        @foreach ($all_designations as $key => $designation)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $designation->designation_name }}</td>
                                <td>
                                    <button class="border-0 bg-white"><a class="text-primary" href="{{ route('designation.edit', $designation->id) }}"><i
                                                class="fa fa-edit " style="font-size:20px;"></a></i></button>
                                    <!--<button class="border-0 bg-white"><a class="text-danger"
                                            href="{{ route('designation.delete', $designation->id) }}"><i
                                                class="fa fa-trash " style="font-size:20px;"></a></i></button>-->
                                </td>
                            </tr>
                        @endforeach
                        <tr>

                        </tr>
                    </table>
                    {{ $all_designations->links() }}
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header" style="background-color: #0cb0b7; color:white;">
                    <h3>Add Designation</h3>
                </div>

                <div class="card-body ">
                    <form action="{{ route('designation.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Designation</label>
                            <input type="text" class="form-control" name="designation_name">

                            @error('designation_name')
                                <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">submit</button>
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
