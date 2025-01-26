@extends('master')

@section('content')


<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Product List</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>SL</th>
                        <th>product</th>
                        <th>Action</th>
                    </tr>

                    
                @if (session ('delete_producttype'))
                    <div class="alert alert-success">{{ session('delete_producttype') }}</div>
                @endif

                    @foreach($all_producttypes as $key=>$ProductType)

                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$ProductType->product}}</td>
                            <td><a href="{{ route ('product.delete', $ProductType->id)}}" class="text-danger"><i class="fa fa-trash"></i></a>

                            </td>
                        </tr>

                    @endforeach
                    
                    <tr>

                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add product</h3>
            </div>
            
            <div class="card-body">
                <form action="{{route ('product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Product</label>
                        <input type="text" class="form-control" name="product">
                        
                        <!-- @error('designation_name')
                                <strong>{{$message}}</strong>

                        @enderror -->
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