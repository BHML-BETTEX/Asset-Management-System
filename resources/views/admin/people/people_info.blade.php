@extends('master')

@section('content')
<div class="container">
    <!-- Page Title -->
    <div class="row mb-3">
        <ul class="nav nav-tabs mb-3 bg-white" id="employeeTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="info-tab" data-bs-toggle="tab" href="#info" role="tab">Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " id="assets-tab" data-bs-toggle="tab" href="#assets" role="tab">Assets</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="history-tab" data-bs-toggle="tab" href="#history" role="tab">History</a>
            </li>
        </ul>
    </div>

    <!-- Top Navbar -->

    <!-- Tab Content -->
    <div class="tab-content">
        <div class="row">
            <div class="col-lg-8">
                <div class="tab-pane fade show active" id="info" role="tabpanel">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="mb-0">{{ $employee->emp_name }} - Profile</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $employee->emp_name }}</td>
                                </tr>
                                <tr>
                                    <th>Employee ID</th>
                                    <td>{{ $employee->emp_id }}</td>
                                </tr>
                                <tr>
                                    <th>Department</th>
                                    <td>{{ $employee->rel_to_departmet->department_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Designation</th>
                                    <td>{{ $employee->rel_to_designation->designation_name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Company</th>
                                    <td>{{ $employee->company }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $employee->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $employee->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th>Join Date</th>
                                    <td>{{ $employee->join_date }}</td>
                                </tr>
                                <tr>
                                    <th>Photo</th>
                                    <td>
                                        <img src="{{ asset('uploads/employees/'.$employee->picture) }}"
                                            alt="Employee Photo" width="100" class="rounded shadow-sm">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="info-stack-container">
                        <div class="col-md-3 col-xs-12 col-lg-12 col-sm-push-9 info-stack">
                            <div class="col-lg-12">
                                <img src="https://bxasset.bettex.com/public/uploads/avatars/setting-default_avatar-1-7tjaWAl05r.png" class=" img-thumbnail hidden-print" style="margin-bottom: 20px;" alt="Nadia Shahrin Chandni">
                            </div>
                            <div class="col-lg-12" style="padding-top: 5px;">
                                <a href="" class="btn btn-block btn-sm btn-info btn-social hidden-print">
                                    <i class="fa fa-edit me-1"></i> Edit User
                                </a>
                            </div>
                            <div class="col-lg-12" style="padding-top: 5px;">
                                <a href="" class="btn btn-block btn-sm btn-secondary btn-social hidden-print">
                                    <i class="fa fa-print me-1"></i> Print All Assigned
                                </a>
                            </div>
                            <div class="col-lg-12" style="padding-top: 5px;">
                                <a href="" class="btn btn-block btn-sm btn-primary btn-social hidden-print">
                                    <i class="fa fa-mail me-1"></i> Email List of All Assigned
                                </a>
                            </div>
                            <div class="col-lg-12" style="padding-top: 5px;">
                                <a href="" class="btn btn-block btn-sm btn-danger btn-social hidden-print" onclick="return confirm('Are you sure you want to delete this user?')">
                                    <i class="fa fa-delete me-1"></i> Delete
                                </a>
                            </div>
                            <div class="col-lg-12" style="padding-top: 5px;">
                                <a href="" class="btn btn-block btn-sm btn-danger btn-social hidden-print">
                                    <i class="fas fa-edit me-1"></i> Checkin All / Delete User
                                </a>
                            </div>
                        </div>
                    </div>


                </div>

            </div>

        </div>
        <!-- Info Tab -->


        <!-- Assets Tab -->
        <div class="tab-pane fade" id="assets" role="tabpanel">
            <div class="card card-body">
                <p>No assets assigned.</p>
            </div>
        </div>

        <!-- History Tab -->
        <div class="tab-pane fade" id="history" role="tabpanel">
            <div class="card card-body">
                <p>No history available.</p>
            </div>
        </div>
    </div>
</div>
@endsection