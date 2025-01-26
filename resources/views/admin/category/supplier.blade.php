@extends('master')
@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card p-1">
            <div class="card">
                <div class="card-header" style="background-color: #0cb0b7; color:white;">
                    <h3>Supplier List</h3>
                </div>
        <div class="card-body">
          <table class="table table-bordered">          
            <tr>
                <th>SL</th>
                <th>supplier_name</th>
                <th>address</th>
                <th>phone</th>
                <th>email</th>
                <th>web</th>
            </tr>
            @foreach($all_supplier as $key=>$supplier)           
               <tr class="" style="height: 25px;">
                    <td>{{$key+1}}</td>
                    <td>{{$supplier->supplier_name}}</td>
                    <td>{{$supplier->address}}</td>
                    <td>{{$supplier->phone}}</td>
                    <td>{{$supplier->email}}</td>
                    <td>{{$supplier->web}}</td>
                    <td>
                    <button class="border-0 bg-white"><a class="text-primary" href=""><i class="fa fa-edit " style="font-size:20px;"></a></i></button>
                    <button class="border-0  bg-white"><a class="text-danger" href="{{route('supplier.delete', $supplier->id)}}"><i class="fa fa-trash " style="font-size:20px;"></a></i></button>
                    </td>
                </tr>
            @endforeach
        </table>
            </div>
          </div>
        </div>
       
    </div>
    <div class="col-lg-4">
        <div class="card p-1" >
            <div class="card-header " style="background-color: #0cb0b7;">
                <h3 class="text-white">Add Supplier</h3>
            </div>
            @error('suppler_add')
                <strong>{{$message}}</strong>
            @enderror   
            <div class="card-body">
                <form action="{{route('supplier.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Supplier Name</label>
                            <input type="text" class="form-control" name="supplier_name" placeholder="supplier name"> 
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Address">  
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Phone</label>
                            <input type="number" class="form-control" name="phone" placeholder="phone">  
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="email">  
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Web</label>
                            <input type="text" class="form-control" name="web" placeholder="web">  
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Others1</label>
                            <input type="text" class="form-control" name="others1" placeholder="others1">  
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Others2</label>
                            <input type="text" class="form-control" name="others2" placeholder="others2">  
                    </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

