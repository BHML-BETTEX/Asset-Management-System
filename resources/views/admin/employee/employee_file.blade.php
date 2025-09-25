@extends('master')

@section('content')
<style>
    /* Professional Employee Info Styling */
    .employee-profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 0.5rem;
        color: white;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .employee-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .employee-avatar:hover {
        transform: scale(1.05);
        border-color: rgba(255, 255, 255, 0.6);
    }

    .upload-modal .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px 15px 0 0;
    }

    .file-upload-area {
        border: 2px dashed #dee2e6;
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        background-color: #f8f9fa;
    }

    .file-upload-area:hover {
        border-color: #007bff;
        background-color: #e3f2fd;
    }

    .nav-tabs-custom {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 1rem;
        padding: 1rem;
    }

    .nav-tabs-custom .nav-tabs {
        border: none;
        margin: 0;
    }

    .nav-tabs-custom .nav-link {
        color: #6c757d;
        font-weight: 500;
        padding: 0.75rem 1.25rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        margin-right: 0.5rem;
        border: none;
        display: flex;
        align-items: center;
    }

    .nav-tabs-custom .nav-link:hover {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
    }

    .nav-tabs-custom .nav-link.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        position: relative;
    }

    .nav-tabs-custom .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
        height: 2px;
        background: inherit;
    }

    .nav-tabs-custom .nav-link i {
        margin-right: 0.5rem;
        font-size: 1rem;
    }

    .nav-tabs-custom .nav-item {
        margin: 0;
    }

    .btn-group {
        flex-direction: column;
        width: 100%;
    }

    .btn-group .btn {
        margin-bottom: 5px;
    }

    .info-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        border: none;
        transition: all 0.3s ease;
        margin-bottom: 1rem;
    }

    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .info-card .card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 1px solid #dee2e6;
        border-radius: 15px 15px 0 0;
        padding: 1.25rem 1.5rem;
    }

    .nav-tabs-custom {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .custom-table {
        margin: 0;
    }

    .custom-table thead th {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: none;
        padding: 15px;
        font-weight: 600;
        color: #495057;
    }

    .custom-table tbody td {
        padding: 15px;
        vertical-align: middle;
        border-color: #f1f3f4;
    }

    .custom-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    .badge.bg-success {
        background-color: #d4edda !important;
        color: #155724 !important;
    }

    .badge.bg-warning {
        background-color: #fff3cd !important;
        color: #856404 !important;
    }

    /* Removing search-export-container as it's integrated into nav-tabs */

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-active {
        background-color: #d4edda;
        color: #155724;
    }

    .search-box {
        width: 260px;
        position: relative;
    }

    .search-box .form-control {
        height: 32px;
        padding-left: 32px;
        padding-right: 12px;
        font-size: 0.875rem;
        border: 1px solid #e0e6ed;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .search-box .form-control:focus {
        background: #fff;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .search-box .search-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 0.875rem;
        z-index: 10;
    }

    .export-btn {
        height: 32px;
        padding: 0 0.75rem;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: white;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .export-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(102, 126, 234, 0.2);
    }

    .export-btn i {
        font-size: 0.875rem;
    }

    .export-select {
        height: 32px;
        font-size: 0.875rem;
        padding: 0 0.5rem;
        border-radius: 6px;
        width: 80px !important;
        margin-right: 0.5rem;
    }
</style>

<div class="container">
    <!-- Employee Profile Header -->
    <div class="employee-profile-header">
        <div class="row align-items-center">
            <div class="col-md-2 text-center">
                @if($employee->picture && $employee->picture !== 'default.png')
                <img src="{{ asset('uploads/employees/' . $employee->picture) }}"
                    class="employee-avatar"
                    alt="{{ $employee->emp_name }}">
                @else
                <div class="employee-avatar d-flex align-items-center justify-content-center bg-light">
                    <i class="fa fa-user fa-3x text-muted"></i>
                </div>
                @endif
            </div>
            <div class="col-md-6">
                <h2 class="mb-1 font-weight-bold">{{ $employee->emp_name }}</h2>
                <p class="mb-1 h5 font-weight-light">{{ $employee->rel_to_designation->designation_name ?? 'No Designation' }}</p>
                <p class="mb-0 text-light">{{ $employee->rel_to_departmet->department_name }} • {{ $employee->rel_to_companies->company }}</p>
            </div>
            <div class="col-md-4 text-md-right">
                <span class="status-badge status-active">
                    <i class="fa fa-check-circle"></i> Active Employee
                </span>
                <div class="mt-2">
                    <small class="text-light">Employee ID: <strong>{{ $employee->emp_id }}</strong></small>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs with Search and Export -->
    <div class="nav-tabs-custom">
        <div class="d-flex justify-content-between align-items-center">
            <ul class="nav nav-tabs border-0" id="employeeTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employee_info', $employee->id) }}">
                        <i class="fa fa-user"></i> Personal Info
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employee_assets', ['emp_id' => $employee->emp_id]) }}">
                        <i class="fa fa-laptop"></i> Assets
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employee_consumable', ['emp_id' => $employee->emp_id]) }}">
                        <i class="fa fa-shopping-cart"></i> Consumables
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('employee_file', ['emp_id' => $employee->emp_id]) }}">
                        <i class="fa fa-folder"></i> Files
                    </a>
                </li>
                <li class="nav-item ms-auto">
                    <button class="nav-link border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#uploadsModal">
                        <i class="fa fa-upload"></i> Upload File
                    </button>
                </li>
            </ul>

            <!-- Right-aligned Search and Export -->
            <div class="d-flex align-items-center gap-3">
                <div class="search-box">
                    <form method="GET" action="{{ route('employee_consumable', ['emp_id' => $employee->emp_id]) }}" class="mb-0">
                        <i class="fa fa-search search-icon"></i>
                        <input type="search" class="form-control rounded-pill" name="search"
                            placeholder="Search consumables..." value="{{ request('search') }}">
                    </form>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm rounded-pill dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
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
                </li>

                </ul>
            </div>
        </div>

        <!-- Assets Content -->
        <div class="info-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fa fa-laptop me-2"></i> Assigned Assets
                </h5>
                <span class="badge bg-primary rounded-pill text-white">Items</span>
            </div>
            <div class="table-responsive">
                <table class="table custom-table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>File name</th>
                            <th>Notes</th>
                            <th>Download</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employee_file as $files)
                        <tr>
                            <td>{{$files->file}}</td>
                            <td>{{$files->note}}</td>
                            <td>
                                <a href="{{ asset('uploads/employees/others/' . $files->file) }}" class="btn" download>
                                    <i class="fa fa-download"></i>
                                </a>
                            </td>
                            <td>{{$files->created_by}}</td>
                            <td>{{$files->created_at}}</td>
                            <td>
                                <button class="border-0 bg-white">
                                    <a class="text-danger" href="{{ route('employee_file_delete', $files->id) }}" onclick="return confirm('Are you sure you want to delete this file?')">
                                        <i class="fa fa-trash fa-2x"></i>
                                    </a>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<!-- Uploads Modal -->
<div class="modal fade upload-modal" id="uploadsModal" tabindex="-1" aria-labelledby="uploadsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadsModalLabel">
                    <i class="fa fa-upload me-2"></i>Upload File for {{ $employee->emp_name }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="fileUploadForm" action="{{ route('employee.storeOtherFile', ['id' => $employee->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="file-upload-area mb-4">
                        <i class="fa fa-cloud-upload fa-3x text-muted mb-3"></i>
                        <h6 class="text-muted mb-2">Drag & Drop files here or click to browse</h6>
                        <input type="file" class="form-control d-none" name="file" id="fileInput" required>
                        <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('fileInput').click()">
                            <i class="fa fa-folder-open me-2"></i>Choose File
                        </button>
                        <div class="mt-2">
                            <small class="text-muted">Maximum file size: 8MB</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Notes (Optional)</label>
                        <textarea class="form-control" name="note" rows="3" placeholder="Add a note about this file..."></textarea>
                    </div>

                    <div class="alert alert-info">
                        <strong>Allowed file types:</strong>
                        <small class="d-block mt-1">PDF, DOC, DOCX, XLS, XLSX, PNG, JPG, JPEG, GIF, ZIP, and more</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times me-2"></i> Cancel
                </button>
                <button type="submit" class="btn btn-primary" form="fileUploadForm">
                    <i class="fa fa-upload me-2"></i> Upload File
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')




@endpush