@extends('master')

@section('content')
<style>
    .gradient-header {
        background: linear-gradient(to right, #003366 0%, #006666 100%);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }


    /* Filter Panel Styling */
    .filter-panel {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .filter-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.2rem;
        margin-bottom: 1rem;
        align-items: end;
    }

    .filter-row label {
        font-weight: 600;
        margin-bottom: 0.3rem;
        font-size: 0.85rem;
        color: #495057;
    }

    .filter-actions {
        display: flex;
        align-items: end;
    }

    .filter-actions button {
        width: 100%;
    }

    .form-control-sm,
    .form-select-sm {
        border-radius: 8px;
        border: 1px solid #e1e5e9;
        transition: all 0.3s ease;
        height: 36px;
        line-height: 36px;
    }

    .form-control-sm:focus,
    .form-select-sm:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .nav-tabs {
        background: white;
    }

    /* Table Styling */
    .smart-table {
        background: white;
        overflow: hidden;
    }

    .smart-table .table {
        margin-bottom: 0;
    }

    .smart-table .table thead th {
        background-color: #495057;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        border: none;
        padding: 1rem 0.75rem;
        font-size: 0.8rem;
        white-space: nowrap;
    }

    .smart-table .table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f1f3f4;
    }

    .smart-table .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .smart-table .table tbody td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
        border: none;
        font-size: 0.85rem;
    }

    .table-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.375rem 0.75rem;
        border: none;
        background: none;
        cursor: pointer;
    }

    .table-action-btn:hover {
        background-color: #f8f9fa;
        transform: translateY(-1px);
    }

    /* Buttons */
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

    /* Column Selector Styles */
    #columnDropdownMenu {
        min-width: 280px;
        max-height: 400px;
        overflow-y: auto;
        padding: 0.5rem;
        pointer-events: auto;
    }

    .column-checkbox-item {
        display: flex;
        align-items: center;
        padding: 0.5rem;
        border-radius: 0.25rem;
        transition: background-color 0.2s ease;
        cursor: pointer;
        margin-bottom: 0.25rem;
    }

    .column-checkbox-item:hover {
        background-color: #f8f9fa;
    }

    .column-checkbox-item label {
        margin-bottom: 0;
        font-size: 0.875rem;
        flex: 1;
    }

    .column-checkbox-item.essential label {
        font-weight: 600;
        color: #007bff;
    }

    .column-checkbox-item.essential {
        background-color: #f0f8ff;
        border-left: 3px solid #007bff;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .filter-row {
            grid-template-columns: 1fr;
        }

        .smart-table {
            font-size: 0.75rem;
            overflow-x: auto;
        }

        .smart-table .table {
            min-width: 1200px;
        }
    }
</style>


<div class="container">
    <div class="card mb-2" style="">
        <div class="card-header" style="background-color: #f8f9fa; border-radius: 12px 12px 0 0;">
            <h6 class="mb-0 text-dark">
                <span class="">Asset file List</span>
            </h6>
        </div>
        <div class="card-body">
            <form action="" method="GET" id="filterForm">
                <!-- Action Buttons -->
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Search Assets</label>
                        <input type="search" class="form-control form-control-sm" name="search"
                            placeholder="Search by asset tag, model, brand..."
                            value="{{ request('search') }}">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Asset Type</label>
                        <select name="product_search" class="form-control form-control-sm select2-filter">
                            <option value="">All Types</option>

                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Company</label>
                        <select name="company_filter" class="form-control form-control-sm select2-filter">
                            <option value="">All Companies</option>

                        </select>
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="fa fa-search"></i> Apply Filters
                        </button>
                    </div>

                    <div class="filter-actions">
                        <button type="button" class="btn btn-warning btn-sm w-100" onclick="clearFilters()">
                            <i class="fa fa-refresh"></i> Clear All
                        </button>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="columnDropdown" id="columnDropdownMenu">
                        <!-- Column checkboxes will be generated by JavaScript -->
                    </div>
                </div>
        </div>
        </form>
    </div>


    <!-- Page Title -->
    <div class="row mb-2 bg-white">
        <ul class="nav nav-tabs mb-3 w-100 d-flex align-items-center" id="employeeTab" role="tablist">
            <!-- Left-aligned tabs -->
            <li class="nav-item">
                <a class="nav-link " href="{{ route('store_info', $store->id) }}" role="tab">Info</a>
            </li>
            <li class="nav-item">

                <a class="nav-link" href="{{ route('history', $store->id) }}">History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('maintenance_list', $store->id) }}">Maintenance</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="" role="tab">Files</a>
            </li>
            <!-- Uploads tab -->
            <li class="nav-item">
                <a class="nav-link" id="uploads-tab" href="#history" role="tab" data-toggle="modal" data-target="#uploadsModal">
                    <i class="fa fa-paperclip"></i> Uploads
                </a>
            </li>


        </ul>
    </div>

    <div class="modal fade" id="uploadsModal" tabindex="-1" aria-labelledby="uploadsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(to bottom, #33cccc 0%, #ffffff 52%);">
                    <h5 class="modal-title" id="uploadsModalLabel">File Upload</h5>
                    <button type="button" class="close btn border-0 bg-transparent" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="fileUploadForm"
                        action="{{ route('store_file_save') }}"
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Hidden field to carry store_id -->
                        <input type="hidden" name="store_id" value="{{ $store->id }}">

                        <!-- File Upload -->
                        <div class="mb-3">
                            <label class="btn btn-outline-secondary w-100">
                                Select File...
                                <input type="file" class="js-uploadFile d-none" name="file" required>
                            </label>
                        </div>

                        <p class="help-block" id="uploadFile-status">
                            Allowed filetypes: .doc, .docx, .pdf, .jpg, .png, .xls, .xlsx, etc.
                            Max upload size: 2MB.
                        </p>

                        <!-- Note Textarea -->
                        <div class="mb-3">
                            <textarea class="form-control" name="note" rows="3" placeholder="Enter a note (optional)"></textarea>
                        </div>
                    </form>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white" style="background-color: #2B7093;" form="fileUploadForm">
                        Upload
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Top Navbar -->

    <!-- Tab Content -->
    <div class="row">
        <div class="col-lg-12">
            <div class="smart-table">
                @if (session('delete_success'))
                <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    <span>{{ session('delete_success') }}</span>
                    <button type="button" class="border-0 bg-danger text-white fw-bold px-2 rounded" data-bs-dismiss="alert" aria-label="Close">X</button>
                </div>
                @endif
                @if (session('save_success'))
                <div class="alert alert-warning alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    <span>{{ session('save_success') }}</span>
                    <button type="button" class="border-0 bg-warning text-white fw-bold px-2 rounded" data-bs-dismiss="alert" aria-label="Close">X</button>
                </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>FILE NAME</th>
                                    <th>NOTE</th>
                                    <th>DOWNLOAD</th>
                                    <th>CREATED BY</th>
                                    <th>CREATED AT</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>

                            <tbody style="height: 5px !important; overflow: scroll;">
                                @foreach ( $file_info as $info)
                                <tr>
                                    <td>{{$info->file}}</td>
                                    <td>{{$info->note}}</td>
                                    <td><a href="{{ asset('uploads/store_files/' . $info->file) }}" class="btn" download>
                                            <i class="fa fa-download text-primary"></i>
                                        </a></td>
                                    <td>{{$info->created_by}}</td>
                                    <td>{{$info->created_at}}</td>
                                    <td>
                                        <button class="border-0 bg-white">
                                            <a class="text-danger"
                                                href="{{ route('store_file_delete', $info->id) }}"
                                                onclick="return confirm('Are you sure you want to delete this file?')">
                                                <i class="fa fa-trash fa-2x"></i>
                                            </a>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection