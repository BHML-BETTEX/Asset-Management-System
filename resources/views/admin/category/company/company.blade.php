@extends('master')
@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card p-1">
            <div class="card">
                <div class="card-header text-white" style="background-color: #0cb0b7;">
                    <h3>Company List</h3>
                </div>
             
        <div class="card-body">
          <table class="table table-bordered">          
            <tr>
                <th>SL</th>
                <th>Company Name</th>
                <th>Description</th>
                <th>Location</th>
                <th>Action</th>
            </tr>

            @if (session ('comapny_delete'))
                    <div class="alert alert-danger">{{ session('comapny_delete') }}</div>
                @endif    

            @foreach($all_company as $key=>$company)                             
               <tr class="" style="height: 25px;">
                    <td>{{$key+1}}</td>
                    <td>{{$company->company}}</td>
                    <td>{{$company->description}}</td>
                    <td>{{$company->location}}</td>
                    <td>
                    <button class="border-0 bg-white"><a class="text-primary" href=""><i class="fa fa-edit " style="font-size:20px;"></a></i></button>
                    <button class="border-0  bg-white"><a class="text-danger" href="{{route('company.delete',$company->id)}}"><i class="fa fa-trash " style="font-size:20px;"></a></i></button>
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
                <h3 class="text-white">Add Company</h3>
            </div> 
            <div class="card-body">
            @if (session ('company_added'))
                <div class="alert alert-success">{{ session('company_added') }}</div>
            @endif  
                <form action="{{route('company.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Compane name</label>
                            <input type="text" class="form-control" name="company" placeholder="company_name">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" placeholder="description">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" placeholder="location">
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

