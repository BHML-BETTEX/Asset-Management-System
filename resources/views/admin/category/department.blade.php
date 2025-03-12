@extends('master')
@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card p-1">
            <div class="card">
                <div class="card-header">
                    <h3>Department List</h3>
                </div>
        <div class="card-body">
          <table class="table table-bordered">          
            <tr>
                <th>SL</th>
                <th>Department</th>
                <th>Action</th>
            </tr>

            @if (session ('delete_department'))
                    <div class="alert alert-success">{{ session('delete_department') }}</div>
                @endif           
            @foreach($all_departments as $key=>$department)
               <tr class="" style="height: 25px;">
                    <td>{{$key+1}}</td>
                    <td>{{$department->department_name}}</td>
                    <td>
                    <button class="border-0 bg-white"><a class="text-primary" href="{{route('department_edit',$department->id)}}"><i class="fa fa-edit " style="font-size:20px;"></a></i></button>
                   <!-- <button class="border-0  bg-white"><a class="text-danger" href="{{route('department.delete',$department->id)}}"><i class="fa fa-trash " style="font-size:20px;"></a></i></button>-->
                    </td>
                </tr>
            @endforeach
        </table>

        {{$all_departments->links()}}
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card p-1" >
            <div class="card-header " style="background-color: #0cb0b7;">
                <h3 class="text-white">Add Department</h3>
            </div>
            <div class="card-body">
                <form action="{{route ('department.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Department_name</label>
                            <input type="text" class="form-control" name="department_name" placeholder="Enter email">
                                @error('department_name')
                                <strong>{{$message}}</strong>
                                @enderror
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

