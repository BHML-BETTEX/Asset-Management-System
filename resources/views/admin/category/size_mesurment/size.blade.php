@extends('master')
@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card p-1">
            <div class="card">
                <div class="card-header text-white" style="background-color: #0cb0b7;">
                    <h3>Size & mesurment List</h3>
                </div>
             
        <div class="card-body">
          <table class="table table-bordered">          
            <tr>
                <th>SL</th>
                <th>Size</th>
                <th>Description</th>
                <th>Action</th>
            </tr>

            @if (session ('size_delete'))
                    <div class="alert alert-success">{{ session('size_delete') }}</div>
                @endif    

            @foreach($all_SizeMaseurment as $key=>$SizeMaseurment)                                
               <tr class="" style="height: 25px;">
                    <td>{{$key+1}}</td>
                    <td>{{$SizeMaseurment->size}}</td>
                    <td>{{$SizeMaseurment->description}}</td>
                    <td>
                    <button class="border-0 bg-white"><a class="text-primary" href=""><i class="fa fa-edit " style="font-size:20px;"></a></i></button>
                    <button class="border-0  bg-white"><a class="text-danger" href="{{route('size.delete', $SizeMaseurment->id)}}"><i class="fa fa-trash " style="font-size:20px;"></a></i></button>
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
                <h3 class="text-white">Add Size</h3>
            </div>  
            <div class="card-body">
            @if (session ('size_added'))
                <div class="alert alert-success">{{ session('size_added') }}</div>
            @endif 
                <form action="{{route('size.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Size</label>
                            <input type="text" class="form-control" name="size" placeholder="size_mesurment">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" placeholder="description">
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

