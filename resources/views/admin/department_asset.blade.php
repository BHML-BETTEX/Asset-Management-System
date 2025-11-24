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
    <div class="page-title">
        <div class="row ">
            <div class="col-md-12">
                <div class="col-md-5 p-2">
                    <h5 class="text-white">Department Asset List</h5>
                </div>
                <div class="col-md-4 top_search">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" placeholder="Search for..."
                                value="">
                            <button class="btn btn-secondary" type="submit">Go!</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2 ">
                    <form action="" method="GET">
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

        
        <!--display form start-->
        <div class="row">
            <div class="col-lg-12">
                <div class="smart-table">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped table-bordered">
                                    <thead class="bg-info text-white">
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Employee Name</th>
                                            <th>Designation</th>
                                            <th>Department</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <!--<th>Company</th>-->
                                            <th>Asset</th>
                                            <th>Consumable</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($employees as $emp)
                                        <tr>
                                            <td>{{ $emp->emp_id }}</td>
                                            <td>{{ $emp->emp_name }}</td>
                                            <td>{{ $emp->designation_name ?? '-' }}</td>
                                            <td>{{ $emp->department_name ?? '-' }}</td>
                                            <td>{{ $emp->email ?? '-' }}</td>
                                            <td>{{ $emp->phone ?? '-' }}</td>
                                            <!--<td>{{ $emp->rel_to_Company->company ?? '-' }}</td>-->
                                            <td>{{ $emp->total_asset ?? 0 }}</td>
                                            <td>{{ $emp->total_consumable ?? 0 }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No employees found.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                {{-- Pagination Links --}}
                                <div>
                                    @if (!$showAll && method_exists($employees, 'links'))
                                    {{ $employees->links() }}
                                    @endif
                                </div>

                                {{-- Show All Link (inline with pagination) --}}
                                <div>
                                    @if (!$showAll)
                                    <a href="{{ request()->fullUrlWithQuery(['show_all' => 1]) }}" class="btn btn-sm btn-link text-danger">
                                        Show all
                                    </a>
                                    @else
                                    <a href="{{ request()->fullUrlWithQuery(['show_all' => 0]) }}" class="btn btn-sm btn-link text-secondary">
                                        Paginate
                                    </a>
                                    @endif
                                </div>
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