@extends('master')

@section('content')

<!--desktop table start-->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h1>Desktops Listsss</h1>
            </div>

            <div class="card-body">
            <table class="table table-striped table table-bordered ">
                <thead class="text-white" style="background-color: #06C7CD;">
                    <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Asset Tag</th>
                    <th scope="col">Model No</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Issue Date</th>
                    <th scope="col">Return Date</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Others</th>
                    <th scope="col">aaa</th>
                    </tr>
                </thead>

                <thead>
                @foreach ($desktops as $key=>$desktops)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$desktops->products_id}}</td>
                        <td>{{$desktops->model_no}}</td>
                        <td>{{$desktops->emp_name}}</td>
                        <td>{{$desktops->issue_date}}</td>
                        <td>{{$desktops->Retrurn_date}}</td>
                        <td>{{$desktops->phone_number}}</td>
                        <td><img width="50" src="{{asset('uploads/desktop')}}/{{$desktops->picture}}" alt=""></td>
                        <td>{{$desktops->others}}</td>
                        <td>
                            <a href="{{route('desktop.view', $desktops->id)}}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-eye"></i></a>
                        </td>
                        
                    </tr>

                @endforeach
                </thead>

                </table>
            </div>
        </div>
    </div>
</div>


@endsection
