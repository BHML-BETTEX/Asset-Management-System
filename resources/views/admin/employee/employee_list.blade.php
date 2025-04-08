@extends('master')

@section('content')
<div class="container">
    <div class="page-title">
        <div class="row ">
            <div class="col-md-12">
                <div class="col-md-5 p-2">
                    <h5 class="text-white">Employee List</h5>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"
                        data-whatever="@mdo"><span class="fa fa-plus"> Add</span></button>
                </div>

                <div class="col-md-4 top_search">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" placeholder="Search for..."
                                value="{{ $search }}">
                            <button class="btn btn-secondary" type="submit">Go!</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 ">
                    <form action="{{route('export')}}" method="GET">
                        <div class="input-group">
                            <select name="type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="xlsx">XLSX</option>
                                <option value="csv">CSV</option>
                                <option value="xls">XLS</option>
                            </select>
                            <button type="submit" class="btn btn-success">Export</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <!--Modal Start-->



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employee.store') }}" Method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="message-text" class="col-form-label" >Employee id *</label>
                            <input class="form-control" name="emp_id" required></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Employee Name</label>
                            <input class="form-control" name="emp_name"></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text">Department</label>
                            <select class="form-control" id="sel1" name="department_id">
                                @foreach ($departments as $departments)
                                    <option class="" value="{{ $departments->id }}">
                                        {{ $departments->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text">Designation</label>
                            <select class="form-control" id="sel1" name="designation_id">
                                @foreach ($designation as $designation)
                                    <option class="" value="{{ $designation->id }}">
                                        {{ $designation->designation_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Joining Date</label>
                            <input class="form-control" type="date" name="join_date"></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Phone Number</label>
                            <input class="form-control" type="number" name="phone_number"></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Email</label>
                            <input class="form-control" type="email" name="email"></input>
                        </div>

                        <div class="form-group">
                            <label for="message-text">Company *</label>
                            <select class="form-control" id="sel1" name="company" required>
                                @foreach ($company as $companys)
                                    <option class="" value="{{ $companys->company }}">
                                        {{ $companys->company }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Oters info</label>
                            <input class="form-control" type="text" name="text"></input>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Picture</label>
                            <input class="form-control" type="file" name="picture"></input>
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal end-->

    <!--display form start-->


    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                @if (session('delete_employee'))
                    <div class="alert alert-success">{{ session('delete_employee') }}</div>
                @endif
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped table-bordered ">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">EMPLOYEE ID</th>
                                    <th scope="col">EMPLOYEE NAME</th>
                                    <th scope="col">DEPARTMENT</th>
                                    <th scope="col">DESIGNATION</th>
                                    <th scope="col">JOINING DATE</th>
                                    <th scope="col">PHONE NUMBER</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">PICTURE</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>

                            <thead>
                                @foreach ($employees as $key => $employee)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $employee->emp_id }}</td>
                                        <td>{{ $employee->emp_name }}</td>
                                        <td>{{ $employee->rel_to_departmet->department_name}}</td> <!-- Assuming the column is 'name' -->
                                        <td>{{ $employee->rel_to_designation->designation_name}}</td>
                                        <td>{{ $employee->join_date }}</td>
                                        <td>{{ $employee->phone_number }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->company}}</td>
                                        <td><img width="50"
                                                src="{{ asset('uploads/employees') }}/{{ $employee->picture }}"
                                                alt=""></td>
                                        <td>
                                            <button class="border-0 bg-white"><a class="text-primary"
                                                    href="{{ route('employee_edit', $employee->id) }}"><i
                                                        class="fa fa-edit " style="font-size:20px;"></a></i></button>
                                            <!-- <button class="border-0  bg-white"><a class="text-danger"
                                                    href="{{ route('employee.delete', $employee->id) }}"><i
                                                        class="fa fa-trash " style="font-size:20px;"></a></i></button> -->
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </thead>
                        </table>
                            {{$employees->links()}}
                        <div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

    <!-- Ajax code -->







    <!--display form end-->
@endsection
