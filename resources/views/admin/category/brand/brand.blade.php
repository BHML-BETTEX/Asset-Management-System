@extends('master')
@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card p-1">
            <div class="card">
                <div class="card-header text-white" style="background-color: #0cb0b7;">
                    <h3>Brand List</h3>
                </div>
             
        <div class="card-body">
          <table class="table table-bordered">          
            <tr>
                <th>SL</th>
                <th>Brand</th>
                <th>Others</th>
                <th>Action</th>
            </tr>

            @if (session ('brand_delete'))
                    <div class="alert alert-success">{{ session('brand_delete') }}</div>
                @endif    

            @foreach($all_brand as $key=>$brand)        
               <tr class="" style="height: 25px;">
                    <td>{{$key+1}}</td>
                    <td>{{$brand->brand_name}}</td>
                    <td></td>
                    <td>
                    <button class="border-0 bg-white"><a class="text-primary" href=""><i class="fa fa-edit " style="font-size:20px;"></a></i></button>
                    <button class="border-0  bg-white"><a class="text-danger" href="{{route('brand.delete',$brand->id )}}"><i class="fa fa-trash " style="font-size:20px;"></a></i></button>
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
                <h3 class="text-white">Add Brand</h3>
            </div>
            @if (session ('brand_add'))
                    <div class="alert alert-success">{{ session('brand_add') }}</div>
                @endif   
            <div class="card-body">
                <form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Brand_name</label>
                            <input type="text" class="form-control" name="brand_name" placeholder="brand_name">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Note</label>
                            <input type="text" class="form-control" name="others" placeholder="note">
                    </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn text-white" style="background-color: #0cb0b7;">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

