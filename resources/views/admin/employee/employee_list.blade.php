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
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered"> <!--  modal-lg makes it medium/large -->
                <div class="modal-content">
                    <div class="modal-header" style="    background: linear-gradient(to bottom, #33cccc 0%, #ffffff 52%);">
                        <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
                        <button type="button" class="close btn border-0 bg-transparent" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!--  Row with 2 input fields side by side -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Employee ID <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="emp_id" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Employee Name</label>
                                    <input type="text" class="form-control" name="emp_name">
                                </div>
                            </div>

                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label class="form-label">Department <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="department_id" required>
                                        <option value="">-- Select Department --</option>
                                        @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Designation</label>
                                    <select class="form-control" name="designation_id">
                                        @foreach ($designation as $desig)
                                        <option value="{{ $desig->id }}">{{ $desig->designation_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label class="form-label">Joining Date</label>
                                    <input type="date" class="form-control" name="join_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="number" class="form-control" name="phone_number">
                                </div>
                            </div>

                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Company <span class="text-danger">*</span></label>
                                    <select class="form-control" name="company" required>
                                        @foreach ($company as $companys)
                                        <option value="{{ $companys->id }}">{{ $companys->company }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mt-2">
                                <label class="form-label">Other Info</label>
                                <input type="text" class="form-control" name="text">
                            </div>

                            <div class="mt-2">
                                <label class="form-label">Picture</label>
                                <input type="file" class="form-control" name="picture">
                            </div>
                            <div class="modal-footer d-flex justify-content-between" style="">
                                <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn" style="background-color: #2B7093; color:white">Submit</button>
                            </div>
                        </form>
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

                                <tbody style="height: 5px !important; overflow: scroll;">
                                    @foreach ($employees as $key => $employee)
                                    <tr style="cursor: default;">
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <a href="{{ route('employee_info', $employee->id) }}">
                                                {{ $employee->emp_id }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('employee_info', $employee->id) }}">
                                                {{ $employee->emp_name }}
                                            </a>
                                        </td>
                                        <td>{{ $employee->rel_to_departmet->department_name }}</td>
                                        <td>{{ $employee->rel_to_designation->designation_name }}</td>
                                        <td>{{ $employee->join_date }}</td>
                                        <td>{{ $employee->phone_number }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->rel_to_companies->company }}</td>
                                        <td>
                                            <img width="40" height="30"
                                                src="{{ asset('uploads/employees/' . $employee->picture) }}"
                                                alt="">
                                        </td>
                                        <td>
                                            <button class="border-0 bg-white">
                                                <a class="text-primary" href="{{ route('employee_edit', $employee->id) }}">
                                                    <i class="fa fa-edit" style="font-size:20px;"></i>
                                                </a>
                                            </button>
                                            {{-- Uncomment this if delete is needed --}}
                                            {{-- <button class="border-0 bg-white">
                <a class="text-danger" href="{{ route('employee.delete', $employee->id) }}">
                                            <i class="fa fa-trash" style="font-size:20px;"></i>
                                            </a>
                                            </button> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

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

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2 only when modal is shown
        $('#exampleModal').on('shown.bs.modal', function() {
            $('.select2').select2({
                dropdownParent: $('#exampleModal'), // Fixes dropdown z-index inside modal
                placeholder: "Please select an option",
                allowClear: true
            });
        });

        // Optional: Destroy Select2 when modal hides to avoid duplicates
        $('#exampleModal').on('hidden.bs.modal', function() {
            $('.select2').select2('destroy');
        });
    });
</script>
@endpush