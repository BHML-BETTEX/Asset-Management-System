@extends('master')
@section('content')

<style>
    .pagination-wrapper nav {
        margin-bottom: 0;
    }

    .form-select-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        height: auto;
    }

    /* Select2 Custom Styling */
    .select2-container--bootstrap4 {
        width: 100% !important;
    }

    .select2-container--bootstrap4 .select2-selection {
        height: 38px !important;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }

    .select2-container--bootstrap4 .select2-selection--single {
        padding: 0.375rem 0.75rem;
        line-height: 1.5;
    }

    .select2-container--bootstrap4 .select2-selection__rendered {
        color: #495057;
    }

    .select2-container--bootstrap4 .select2-dropdown {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .select2-container--bootstrap4 .select2-results__option--highlighted[aria-selected] {
        background-color: #2B7093 !important;
    }

    /* Modal Styling */
    .modal-content {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        border-bottom: none;
        padding: 1.5rem;
    }

    .form-floating {
        position: relative;
        margin-bottom: 1rem;
    }

    .form-floating>.form-control,
    .form-floating>.form-select {
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
    }

    .form-floating>label {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        padding: 1rem 0.75rem;
        pointer-events: none;
        border: 1px solid transparent;
        transform-origin: 0 0;
        transition: opacity .1s ease-in-out, transform .1s ease-in-out;
    }

    .custom-file-upload {
        border: 2px dashed #ddd;
        border-radius: 10px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .custom-file-upload:hover {
        border-color: #2B7093;
        background-color: rgba(43, 112, 147, 0.05);
    }

    /* Select2 Filter Styling */
    .select2-container--bootstrap4.select2-container--focus .select2-selection {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .select2-container--bootstrap4 .select2-selection--single {
        height: calc(1.5em + 0.5rem + 2px) !important;
    }

    .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
        line-height: calc(1.5em + 0.5rem);
    }

    .select2-container--bootstrap4 .select2-selection--single .select2-selection__placeholder {
        color: #6c757d;
    }

    .select2-container--bootstrap4 .select2-results__option--highlighted[aria-selected] {
        background-color: #007bff !important;
    }

    /* Smart Table Styling */
    .smart-table {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        background: white;
    }

    .smart-table .table {
        margin-bottom: 0;
        border-radius: 12px;
    }

    .smart-table .table thead th {
        background: #495057;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        padding: 1rem 0.75rem;
        font-size: 0.85rem;
    }

    .smart-table .table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f1f3f4;
    }

    .smart-table .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .smart-table .table tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
        border: none;
        font-size: 0.9rem;
    }

    .smart-table .table tbody tr:last-child {
        border-bottom: none;
    }

    /* Employee Picture Styling */
    .employee-picture {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .employee-picture:hover {
        border-color: #007bff;
        transform: scale(1.1);
    }

    /* Action Buttons */
    .action-btn {
        background: none;
        border: none;
        padding: 8px;
        border-radius: 8px;
        transition: all 0.3s ease;
        margin: 0 2px;
    }

    .action-btn:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
    }

    .action-btn i {
        font-size: 16px;
    }

    /* Employee Links */
    .employee-link {
        color: #495057;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .employee-link:hover {
        color: #007bff;
        text-decoration: none;
    }

    /* Filter Section Styling */
    .filter-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .form-control-sm {
        border-radius: 8px;
        border: 1px solid #e1e5e9;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        height: 31px;
    }

    /* Filter Row Styling */
    .select2-container--bootstrap4.select2-container--focus .select2-selection {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .select2-container--bootstrap4 .select2-selection--single {
        height: 31px !important;
    }

    .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
        line-height: 31px;
        padding-left: 8px;
    }

    .btn-primary.btn-sm {
        height: 31px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .form-control-sm:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
    }

    .btn-outline-secondary {
        border-color: #6c757d;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        transform: translateY(-2px);
    }

    /* Department Badge Styling */
    .department-badge {
        background-color: #6c757d;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .designation-badge {
        background-color: #17a2b8;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    /* Card Header */
    .page-title {
        background-color: #343a40;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    /* Import styling */
    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
        color: #212529;
    }

    .file-upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .file-upload-area:hover {
        border-color: #ffc107;
        background-color: #fff3cd;
    }

    .file-upload-area.dragover {
        border-color: #ffc107;
        background-color: #fff3cd;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {

        .smart-table .table thead th,
        .smart-table .table tbody td {
            padding: 0.5rem 0.25rem;
            font-size: 0.8rem;
        }

        .employee-picture {
            width: 35px;
            height: 35px;
        }

        .btn-group {
            flex-direction: column;
            width: 100%;
        }

        .btn-group .btn {
            margin-bottom: 5px;
        }
    }

    /* Filter Panel Button Styling */
    .btn-group .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem 0.75rem;
        height: 31px;
    }

    .btn-group .btn i {
        font-size: 0.875rem;
    }

    /* Export Dropdown Styling */
    .dropdown-menu {
        padding: 0.5rem 0;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border: none;
        border-radius: 0.5rem;
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        color: #495057;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #2B7093;
    }

    .dropdown-item i {
        font-size: 1rem;
        width: 1.5rem;
        text-align: center;
    }

    .btn-group .dropdown-toggle::after {
        margin-left: 0.5rem;
    }

    /* Export Form Styling */
    .input-group-sm {
        height: 31px;
    }

    .input-group-sm .form-control,
    .input-group-sm .btn {
        height: 31px;
        line-height: 1;
        padding-top: 0;
        padding-bottom: 0;
        display: inline-flex;
        align-items: center;
    }

    .input-group-sm .select2-container .select2-selection--single {
        height: 31px !important;
    }

    .input-group-sm .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
        line-height: 31px;
        padding-left: 8px;
    }

    .input-group .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
</style>

<div class="container">
    <!-- Filter Panel -->
    <div class="card mb-4" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
        <div class="card-header" style="background-color: #f8f9fa; border-radius: 12px 12px 0 0;">
            <h6 class="mb-0 text-dark">
                <span class="">Active Employee List</span>
            </h6>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center gap-3">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"
                        data-whatever="@mdo">
                        <i class="fa fa-plus"></i> Add Employee
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#importModal">
                        <i class="fa fa-upload"></i> Import Excel
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-download"></i> Export
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('export', ['type' => 'xlsx']) }}">
                                    <i class="fa fa-file-excel-o text-success me-2"></i> Excel (XLSX)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('export', ['type' => 'csv']) }}">
                                    <i class="fa fa-file-text-o text-info me-2"></i> CSV File
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('export', ['type' => 'xls']) }}">
                                    <i class="fa fa-file-excel-o text-success me-2"></i> Excel 97-2003
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <form action="" method="GET" id="filterForm">
                <!-- Advanced Filters -->
                <div class="collapse" id="advancedFilters">
                    <div class="row g-3 mb-3 p-3 bg-light rounded">
                        <div class="col-md-3">
                            <label class="form-label">Joining Date From</label>
                            <input type="date" class="form-control form-control-sm" name="join_date_from"
                                value="{{ request('join_date_from') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Joining Date To</label>
                            <input type="date" class="form-control form-control-sm" name="join_date_to"
                                value="{{ request('join_date_to') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Picture Status</label>
                            <select name="has_picture" class="form-control form-control-sm">
                                <option value="">All Employees</option>
                                <option value="yes" {{ request('has_picture') == 'yes' ? 'selected' : '' }}>With Picture</option>
                                <option value="no" {{ request('has_picture') == 'no' ? 'selected' : '' }}>Without Picture</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Sort By</label>
                            <select name="sort_by" class="form-control form-control-sm">
                                <option value="emp_id" {{ request('sort_by') == 'emp_id' ? 'selected' : '' }}>Employee ID</option>
                                <option value="emp_name" {{ request('sort_by') == 'emp_name' ? 'selected' : '' }}>Name</option>
                                <option value="join_date" {{ request('sort_by') == 'join_date' ? 'selected' : '' }}>Joining Date</option>
                                <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Recently Added</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Search</label>
                        <input type="search" class="form-control form-control-sm" name="search"
                            placeholder="Search..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Department</label>
                        <select name="department_filter" class="form-control form-control-sm select2-filter">
                            <option value="">All Departments</option>
                            @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}" {{ request('department_filter') == $dept->id ? 'selected' : '' }}>
                                {{ $dept->department_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Designation</label>
                        <select name="designation_filter" class="form-control form-control-sm select2-filter">
                            <option value="">All Designations</option>
                            @foreach ($designation as $desig)
                            <option value="{{ $desig->id }}" {{ request('designation_filter') == $desig->id ? 'selected' : '' }}>
                                {{ $desig->designation_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Company</label>
                        <select name="company_filter" class="form-control form-control-sm select2-filter">
                            <option value="">All Companies</option>
                            @foreach ($company as $comp)
                            <option value="{{ $comp->id }}" {{ request('company_filter') == $comp->id ? 'selected' : '' }}>
                                {{ $comp->company }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="fa fa-search me-1"></i> Apply Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--Modal Start-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(135deg, #33cccc 0%, #2B7093 100%);">
                    <h5 class="modal-title text-white" id="exampleModalLabel">
                        <i class="fa fa-user-plus me-2"></i> Add Employee
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                </div>
                <div class="modal-body" style="background: #f8f9fa;">
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
                                <select class="form-control select2-modal" name="department_id" id="department_select" required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" data-icon="building">
                                        {{ $department->department_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Designation</label>
                                <select class="form-control select2-modal" name="designation_id" id="designation_select">
                                    <option value="">Select Designation</option>
                                    @foreach ($designation as $desig)
                                    <option value="{{ $desig->id }}" data-icon="id-badge">
                                        {{ $desig->designation_name }}
                                    </option>
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
                                <select class="form-control select2-modal" name="company" id="company_select" required>
                                    <option value="">Select Company</option>
                                    @foreach ($company as $companys)
                                    <option value="{{ $companys->id }}" data-icon="building">
                                        {{ $companys->company }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mt-2">
                            <div class="col-md-6">
                                <label class="form-label">Other Info</label>
                                <input type="text" class="form-control" name="others">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select class="form-control" name="status" id="">
                                    <option value="active" data-icon="check-circle">Active</option>
                                    <option value="active" data-icon="check-circle">In Active</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-3">
                            <div class="custom-file-upload">
                                <label for="picture" class="form-label">
                                    <i class="fa fa-cloud-upload me-2"></i>Employee Picture
                                </label>
                                <input type="file" class="form-control" name="picture" id="picture"
                                    accept="image/*" onchange="previewImage(this);">
                                <div id="imagePreview" class="mt-2 text-center d-none">
                                    <img src="" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">
                                <i class="fa fa-times me-2"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check me-2"></i> Save Employee
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!--Modal end-->

    <!-- Import Modal Start -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #f8f9fa;">
                    <h5 class="modal-title" id="importModalLabel">
                        <i class="fa fa-upload"></i> Import Employee Data
                    </h5>
                    <button type="button" class="close btn border-0 bg-transparent" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    @if(Session::has('import_data'))
                    <div class="alert alert-success">{{ Session::get('import_data') }}</div>
                    @endif

                    <form action="{{ route('employee_importexceldata') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="import_file" class="form-label">
                                <i class="fa fa-file-excel-o"></i> Select Excel File
                            </label>
                            <input type="file" class="form-control" name="import_file" id="import_file"
                                accept=".xlsx,.xls,.csv" required>
                            <div class="form-text">
                                Supported formats: .xlsx, .xls, .csv
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <strong><i class="fa fa-info-circle"></i> Instructions:</strong>
                            <ul class="mb-0 mt-2">
                                <li>Make sure your Excel file has the correct column headers</li>
                                <li>Required fields: Employee ID, Employee Name, Department, Company</li>
                                <li>Optional fields: Designation, Phone, Email, Joining Date</li>
                            </ul>
                            <div class="mt-2">
                                <a href="{{ route('export', ['type' => 'xlsx']) }}" class="btn btn-outline-info btn-sm">
                                    <i class="fa fa-download"></i> Download Template
                                </a>
                                <small class="text-muted ms-2">Download current data as template</small>
                            </div>
                        </div>

                        <div class="modal-footer d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fa fa-times"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-warning">
                                <i class="fa fa-upload"></i> Import Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Import Modal End -->
    <!--display form start-->
    <div class="row">
        <div class="col-lg-12">
            <div class="smart-table">
                @if (session('employee_update'))
                <div class="alert alert-warning alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    <span>{{ session('employee_update') }}</span>
                    <button type="button" class="border-0 bg-warning text-white fw-bold px-2 rounded" data-bs-dismiss="alert" aria-label="Close">X</button>
                </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>EMP ID</th>
                                    <th>EMPLOYEE NAME</th>
                                    <th>DEPARTMENT</th>
                                    <th>DESIGNATION</th>
                                    <th>JOIN DATE</th>
                                    <th>PHONE</th>
                                    <th>EMAIL</th>
                                    <th>COMPANY</th>
                                    <th>PICTURE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>

                            <tbody style="height: 5px !important; overflow: scroll;">
                                @foreach ($employees_active as $key => $employee)
                                <tr style="cursor: default;">
                                    <td><span class="fw-bold text-muted">{{ $key + 1 }}</span></td>
                                    <td>
                                        <a href="{{ route('employee_info', $employee->id) }}" class="employee-link fw-bold">
                                            {{ $employee->emp_id }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('employee_info', $employee->id) }}" class="employee-link">
                                            {{ $employee->emp_name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('departments_asset', $employee->department_id) }}"><span class="department-badge">{{ $employee?->rel_to_departmet?->department_name }}</span></a>
                                    </td>
                                    <td>
                                        <span class="designation-badge">{{ $employee?->rel_to_designation?->designation_name }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ \Carbon\Carbon::parse($employee->join_date)->format('M d, Y') }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $employee->phone_number ?: 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $employee->email ?: 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="text-dark fw-medium">{{ $employee->rel_to_companies->company }}</span>
                                    </td>
                                    <td>
                                        @if($employee->picture && $employee->picture !== 'default.png')
                                        <img class="employee-picture"
                                            src="{{ asset('uploads/employees/' . $employee->picture) }}"
                                            alt="{{ $employee->emp_name }}"
                                            title="{{ $employee->emp_name }}">
                                        @else
                                        <div class="employee-picture d-flex align-items-center justify-content-center bg-light">
                                            <i class="fa fa-user text-muted"></i>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="action-btn" title="Edit Employee">
                                            <a class="text-primary" href="{{ route('employee_edit', $employee->id) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </button>

                                        <button class="action-btn" title="Deactivate Employee">
                                            <a class="text-danger" href="{{ route('employee.delete', $employee->id) }}"
                                                onclick="return confirm('Are you sure you want to deactivate this employee?')">
                                                <i class="fa fa-ban"></i>
                                            </a>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            <!--Pagination Start-->
                            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                                {{-- Left: Showing X to Y of Z --}}
                                <div class="d-flex align-items-center mb-2">
                                    @if ($employees_active instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                    <span class="me-2">
                                        Showing {{ $employees_active ->firstItem() }} to {{ $employees_active ->lastItem() }} of {{ $employees_active ->total() }} rows
                                    </span>
                                    @else
                                    <span class="me-2">Showing all {{ $employees_active ->count() }} rows</span>
                                    @endif

                                    {{-- Dropdown --}}
                                    <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-center">
                                        <select name="per_page" class="form-select form-select-sm w-auto me-1" onchange="this.form.submit()">
                                            @php $options = [10, 25, 50, 100, 'all']; @endphp
                                            @foreach ($options as $option)
                                            <option value="{{ $option }}" {{ request('per_page', 13) == $option ? 'selected' : '' }}>
                                                {{ is_numeric($option) ? $option : 'All' }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <span>rows per page</span>

                                        {{-- Keep filters --}}
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                        <input type="hidden" name="department_filter" value="{{ request('department_filter') }}">
                                        <input type="hidden" name="designation_filter" value="{{ request('designation_filter') }}">
                                        <input type="hidden" name="company_filter" value="{{ request('company_filter') }}">
                                        <input type="hidden" name="join_date_from" value="{{ request('join_date_from') }}">
                                        <input type="hidden" name="join_date_to" value="{{ request('join_date_to') }}">
                                        <input type="hidden" name="has_picture" value="{{ request('has_picture') }}">
                                        <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                                    </form>
                                </div>

                                {{-- Right: Pagination links --}}
                                <div class="mb-2">
                                    @if ($employees_active instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                    <div class="pagination-wrapper">
                                        {{ $employees_active ->appends(request()->query())->links() }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!--Pagination end-->
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
<style>
    .select2-container--bootstrap4 {
        width: 100% !important;
    }

    .select2-container--bootstrap4 .select2-selection--single {
        padding-top: 2px;
    }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.min.css" rel="stylesheet" />



<script>
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const previewImg = preview.querySelector('img');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('d-none');
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        // Initialize Select2 with custom styling
        $('#exampleModal').on('shown.bs.modal', function() {
            $('.select2').select2({
                dropdownParent: $('#exampleModal'),
                placeholder: "Please select an option",
                allowClear: true,
                theme: 'bootstrap4',
                width: '100%'
            });
        });

        // Optional: Destroy Select2 when modal hides to avoid duplicates
        $('#exampleModal').on('hidden.bs.modal', function() {
            $('.select2').select2('destroy');
        });
    });

    // Clear filters function
    function clearFilters() {
        // Reset all form fields
        document.getElementById('filterForm').reset();

        // Clear URL parameters and redirect to clean page
        window.location.href = window.location.pathname;
    }

    // Auto-submit on filter change (optional)
    $(document).ready(function() {
        $('.form-control-sm[name="department_filter"], .form-control-sm[name="designation_filter"], .form-control-sm[name="company_filter"]').on('change', function() {
            $('#filterForm').submit();
        });
    });

    // Import file validation
    $(document).ready(function() {
        $('#import_file').on('change', function() {
            const file = this.files[0];
            if (file) {
                const fileName = file.name;
                const fileSize = (file.size / 1024 / 1024).toFixed(2); // Convert to MB
                const allowedExtensions = ['xlsx', 'xls', 'csv'];
                const fileExtension = fileName.split('.').pop().toLowerCase();

                // Check file extension
                if (!allowedExtensions.includes(fileExtension)) {
                    alert('Invalid file type! Please select an Excel file (.xlsx, .xls) or CSV file (.csv)');
                    this.value = '';
                    return;
                }

                // Check file size (max 10MB)
                if (file.size > 10 * 1024 * 1024) {
                    alert('File size too large! Maximum size allowed is 10MB');
                    this.value = '';
                    return;
                }

                // Display file info
                const fileInfo = `Selected: ${fileName} (${fileSize} MB)`;
                $(this).next('.form-text').html(`<i class="fa fa-check text-success"></i> ${fileInfo}`);
            }
        });

        // Add drag and drop functionality (optional enhancement)
        const fileUpload = $('#import_file')[0];
        const fileUploadArea = $('.file-upload-area');

        if (fileUploadArea.length && fileUpload) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                fileUploadArea[0].addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                fileUploadArea[0].addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                fileUploadArea[0].addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                fileUploadArea.addClass('dragover');
            }

            function unhighlight(e) {
                fileUploadArea.removeClass('dragover');
            }

            fileUploadArea[0].addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                if (files.length > 0) {
                    fileUpload.files = files;
                    $(fileUpload).trigger('change');
                }
            }
        }
    });
</script>
@endpush