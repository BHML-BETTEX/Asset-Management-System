@extends('master')

@section('content')

<style>
    /* Professional Employee Info Styling */
    .employee-profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 1rem;
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

    .info-card .card-body {
        padding: 1.5rem;
    }

    .info-row {
        display: flex;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f1f3f4;
        transition: all 0.3s ease;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-row:hover {
        background-color: #f8f9fa;
        margin: 0 -1.5rem;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        border-radius: 8px;
    }

    .info-label {
        font-weight: 600;
        color: #495057;
        min-width: 120px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }

    .info-value {
        color: #6c757d;
        font-size: 0.95rem;
    }

    .info-icon {
        width: 20px;
        margin-right: 8px;
        color: #6c757d;
    }

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

    .department-link,
    .company-link {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        padding: 0.25rem 0.5rem;
        border-radius: 5px;
    }

    .department-link:hover,
    .company-link:hover {
        background-color: #e3f2fd;
        color: #0056b3;
        text-decoration: none;
    }

    .action-sidebar {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        padding: 1.5rem;
    }

    .action-btn {
        width: 100%;
        margin-bottom: 0.75rem;
        border-radius: 10px;
        font-weight: 500;
        padding: 0.75rem 1rem;
        border: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }

    .action-btn i {
        margin-right: 0.5rem;
        width: 16px;
        text-align: center;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        text-decoration: none;
        color: white;
    }

    .btn-edit {
        background-color: #17a2b8;
        color: white;
    }

    .btn-edit:hover {
        background-color: #138496;
    }

    .btn-print {
        background-color: #6c757d;
        color: white;
    }

    .btn-print:hover {
        background-color: #545b62;
    }

    .btn-email {
        background-color: #007bff;
        color: white;
    }

    .btn-email:hover {
        background-color: #0056b3;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    .btn-clone {
        background-color: transparent;
        color: #6366f1;
        border: 2px solid #6366f1;
    }

    .btn-clone:hover {
        background-color: #6366f1;
        color: white;
    }

    .nav-tabs-custom {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        padding: 1rem 1.5rem 0;
        margin-bottom: 1rem;
    }

    .nav-tabs-custom .nav-link {
        border: none;
        border-radius: 10px 10px 0 0;
        color: #6c757d;
        font-weight: 500;
        padding: 0.75rem 1.25rem;
        margin-right: 0.5rem;
        transition: all 0.3s ease;
    }

    .nav-tabs-custom .nav-link:hover {
        background-color: #f8f9fa;
        color: #495057;
    }

    .nav-tabs-custom .nav-link.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
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

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .employee-profile-header {
            text-align: center;
            padding: 1.5rem;
        }

        .employee-avatar {
            width: 100px;
            height: 100px;
        }

        .info-label {
            min-width: 100px;
            font-size: 0.85rem;
        }

        .info-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .action-sidebar {
            margin-top: 2rem;
        }
    }
</style>

<div class="container">
    <!-- Professional Header Section -->
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

    <!-- Navigation Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs border-0" id="employeeTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="info-tab" data-bs-toggle="tab" href="#info" role="tab">
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
                <a class="nav-link" href="{{ route('employee_file', ['emp_id' => $employee->emp_id]) }}">
                    <i class="fa fa-folder"></i> Files
                </a>
            </li>
            <li class="nav-item ms-auto">
                <button class="nav-link border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#uploadsModal">
                    <i class="fa fa-upload"></i> Upload File
                </button>
            </li>
        </ul>
    </div>

    <!-- Alert Messages -->
    @if(session('successs'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa fa-check-circle me-2"></i>
        <strong>Success:</strong> {{ session('successs') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Main Content -->
    <div class="row">
        <!-- Employee Information -->
        <div class="col-lg-8">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="info" role="tabpanel">
                    <!-- Personal Information Card -->
                    <div class="info-card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fa fa-id-card me-2"></i>Personal Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="info-row">
                                <div class="info-label">
                                    <i class="fa fa-user info-icon"></i>Full Name
                                </div>
                                <div class="info-value">{{ $employee->emp_name }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">
                                    <i class="fa fa-id-badge info-icon"></i>Employee ID
                                </div>
                                <div class="info-value">{{ $employee->emp_id }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">
                                    <i class="fa fa-envelope info-icon"></i>Email
                                </div>
                                <div class="info-value">
                                    @if($employee->email)
                                    <a href="mailto:{{ $employee->email }}" class="text-primary"> {{ $employee-> email }}</a>
                                    @else
                                    <span class="text-muted">Not provided</span>
                                    @endif
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">
                                    <i class="fa fa-phone info-icon"></i>Phone
                                </div>
                                <div class="info-value">
                                    @if($employee->phone_number)
                                    <a href="tel:{{ $employee->phone_number }}" class="text-primary">{{ $employee->phone_number }}</a>
                                    @else
                                    <span class="text-muted">Not provided</span>
                                    @endif
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">
                                    <i class="fa fa-calendar info-icon"></i>Join Date
                                </div>
                                <div class="info-value">{{ \Carbon\Carbon::parse($employee->join_date)->format('F d, Y') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Work Information Card -->
                    <div class="info-card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fa fa-briefcase me-2"></i>Work Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="info-row">
                                <div class="info-label">
                                    <i class="fa fa-building info-icon"></i>Department
                                </div>
                                <div class="info-value">
                                    <a href="{{ route('departments_asset', $employee->department_id) }}" class="department-link">
                                        <i class="fa fa-external-link-square me-1"></i>{{ $employee->rel_to_departmet->department_name }}
                                    </a>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">
                                    <i class="fa fa-user-tie info-icon"></i>Designation
                                </div>
                                <div class="info-value">{{ $employee->rel_to_designation->designation_name ?? 'Not assigned' }}</div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">
                                    <i class="fa fa-industry info-icon"></i>Company
                                </div>
                                <div class="info-value">
                                    <a href="{{ route('store') }}" class="company-link">
                                        <i class="fa fa-external-link-square me-1"></i>{{ $employee->rel_to_companies->company }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information Card -->
                    @if($employee->others)
                    <div class="info-card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fa fa-info-circle me-2"></i>Additional Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $employee->others }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Action Sidebar -->
        <div class="col-lg-4">
            <div class="action-sidebar">
                <h6 class="mb-3 text-center text-muted font-weight-bold">Quick Actions</h6>

                <a href="{{ route('employee_edit', $employee->id) }}" class="action-btn btn-edit">
                    <i class="fa fa-edit"></i> Edit Profile
                </a>
                <button class="action-btn btn-clone" data-bs-toggle="modal" data-bs-target="#cloneEmployeeModal">
                    <i class="fa fa-copy"></i> Clone Employee
                </button>

                <button class="action-btn btn-print" onclick="window.print()">
                    <i class="fa fa-print"></i> Print Information
                </button>

                <button class="action-btn btn-email" onclick="emailAssignedAssets()">
                    <i class="fa fa-envelope"></i> Email Asset List
                </button>

                <button class="action-btn btn-print">
                    <i class="fa fa-file-pdf-o"></i> Generate Report
                </button>


                <div class="dropdown-divider my-3"></div>

                <button class="action-btn btn-delete" onclick="confirmDelete()">
                    <i class="fa fa-trash"></i> Delete Employee
                </button>
            </div>

            <!-- Quick Stats Card -->
            <div class="info-card mt-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fa fa-chart-bar me-2"></i>Quick Stats
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <h4 class="text-primary mb-0">{{ $totalIssues }}</h4>
                                <small class="text-muted">Assets</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-success mb-0">0</h4>
                            <small class="text-muted">Files</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div class="modal fade upload-modal" id="uploadsModal" tabindex="-1" aria-labelledby="uploadsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadsModalLabel">
                    <i class="fa fa-upload me-2"></i>Upload File for {{ $employee->emp_name }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
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
                    <i class="fa fa-times me-2"></i>Cancel
                </button>
                <button type="submit" class="btn btn-primary" form="fileUploadForm">
                    <i class="fa fa-upload me-2"></i>Upload File
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // File upload handling
        $('#fileInput').on('change', function() {
            const file = this.files[0];
            if (file) {
                const fileName = file.name;
                const fileSize = (file.size / 1024 / 1024).toFixed(2);
                $('.file-upload-area h6').html(`<i class="fa fa-check text-success me-2"></i>Selected: ${fileName} (${fileSize} MB)`);
            }
        });
    });

    function emailAssignedAssets() {
        alert('Email functionality will be implemented soon.');
    }

    function confirmDelete() {
        if (confirm('Are you sure you want to delete this employee? This will change their status to "Delete".')) {
            window.location.href = "{{ route('employee.delete', $employee->id) }}";
        }
    }
</script>

<!-- Clone Employee Modal -->
<div class="modal fade" id="cloneEmployeeModal" tabindex="-1" aria-labelledby="cloneEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h5 class="modal-title text-white" id="cloneEmployeeModalLabel">
                    <i class="fa fa-copy me-2"></i> Clone Employee
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <form action="{{ route('employee.clone', $employee->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Employee Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="emp_name" value="{{ $employee->emp_name }} (Copy)" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Employee ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="emp_id" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $employee->email }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" value="{{ $employee->phone_number }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Company <span class="text-danger">*</span></label>
                            <select class="form-control select2-modal" name="company" id="company_select" required>
                                @foreach ($companies as $comp)
                                <option value="{{ $comp->id }}" {{ $employee->company == $comp->id ? 'selected' : '' }}>
                                    {{ $comp->company }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Department <span class="text-danger">*</span></label>
                            <select class="form-control select2-modal" name="department_id" id="department_select" required>
                                @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->department_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Designation</label>
                            <select class="form-control select2-modal" name="designation_id" id="designation_select">
                                @foreach ($designation as $desig)
                                <option value="{{ $desig->id }}" {{ $employee->designation_id == $desig->id ? 'selected' : '' }}>
                                    {{ $desig->designation_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Join Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="join_date" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Additional Information</label>
                            <textarea class="form-control" name="others" rows="3">{{ $employee->others }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fa fa-times me-2"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-copy me-2"></i> Clone Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2 for clone modal
        $('#cloneEmployeeModal').on('shown.bs.modal', function() {
            // Initialize Select2 with Bootstrap 4 theme
            $('.select2-modal').select2({
                dropdownParent: $('#cloneEmployeeModal'),
                theme: 'bootstrap4',
                width: '100%'
            });

            // Generate new employee ID
            const prefix = "EMP";
            const timestamp = Date.now().toString().slice(-4);
            const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
            $('input[name="emp_id"]').val(`${prefix}${timestamp}${random}`);
        });

        // Initialize Select2 for clone modal
        $('#cloneEmployeeModal').on('shown.bs.modal', function() {
            console.log('Modal shown event fired');
            $('.select2-modal').select2({
                dropdownParent: $('#cloneEmployeeModal'),
                theme: 'bootstrap4',
                width: '100%'
            });

            // Generate new employee ID
            const prefix = "EMP";
            const timestamp = Date.now().toString().slice(-4);
            const random = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
            $('input[name="emp_id"]').val(`${prefix}${timestamp}${random}`);
        });
    });
</script>
@endpush

@endsection