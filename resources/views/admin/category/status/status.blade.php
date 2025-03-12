@extends('master')
@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card p-1">
            <div class="card">
                <div class="card-header text-white" style="background-color: #0cb0b7;">
                    <h3>Status List</h3>
                </div>
             
        <div class="card-body">
          <table class="table table-bordered">          
            <tr>
                <th>SL</th>
                <th>Status</th>
                <th>Description</th>
                <th>Action</th>
            </tr>

            @if (session ('status_delete'))
                    <div class="alert alert-success">{{ session('status_delete') }}</div>
                @endif    

            @foreach($all_status as $key=>$status)                   
               <tr class="" style="height: 25px;">
                    <td>{{$key+1}}</td>
                    <td>{{$status->status_name}}</td>
                    <td>{{$status->description}}</td>
                    <td>
                    <button class="border-0 bg-white"><a class="text-primary" href=""><i class="fa fa-edit " style="font-size:20px;"></a></i></button>
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
                <h3 class="text-white">Add Status</h3>
            </div>
            @if (session ('status_add'))
                    <div class="alert alert-success">{{ session('status_add') }}</div>
                @endif   
            <div class="card-body">
                <form action="{{route('status.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Status</label>
                            <input type="text" class="form-control" name="status_name" placeholder="status_name" >
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" placeholder="description" required>
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

