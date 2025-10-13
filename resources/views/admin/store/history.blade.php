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

    <!-- Filter Panel -->
    <div class="card mb-2" style="">
        <div class="card-header" style="background-color: #f8f9fa; border-radius: 12px 12px 0 0;">
            <h6 class="mb-0 text-dark">
                <span class="">History List</span>
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

    <div class="row mb-2 bg-white">
        <ul class="nav nav-tabs mb-3 w-100 d-flex align-items-center" id="employeeTab" role="tablist"
            style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">

            <!-- Info Tab -->
            <li class="nav-item">
                <a class="nav-link"
                    href="">
                    Info
                </a>
            </li>

            <!-- History Tab (current page) -->
            <li class="nav-item">
                <a class="nav-link active"
                    href="">
                    History
                </a>
            </li>

            <!-- Maintenance Tab -->
            <li class="nav-item">
                <a class="nav-link"
                    href="">
                    Maintenance
                </a>
            </li>

            <!-- Files Tab -->
            <li class="nav-item">
                <a class="nav-link" href="" >Files</a>
            </li>
        </ul>
    </div>

    <!--Asset Table-->
    <div class="row">
        <div class="col-lg-12">
            <div class="smart-table">
                @if (session('return_success'))
                <div class="alert alert-warning alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                    <span>{{ session('return_success') }}</span>
                    <button type="button" class="border-0 bg-warning text-white fw-bold px-2 rounded" data-bs-dismiss="alert" aria-label="Close">X</button>
                </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>ASSET TAG</th>
                                    <th>ASSET TYPE</th>
                                    <th>MODEL</th>
                                    <th>DESCRIPTION</th>
                                    <th>COMPANY</th>
                                    <th>EMP ID</th>
                                    <th>EMP NAME</th>
                                    <th>DESIGNATION</th>
                                    <th>DEPARTMENT</th>
                                    <th>PHONE NUMBER</th>
                                    <th>EMAIL</th>
                                    <th>NOTE</th>
                                    <th>ISSUE DATE</th>
                                    <th>RETURN DATE</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>

                            <tbody style="height: 5px !important; overflow: scroll;">
                                @foreach ($issue_info as $key => $issue_infos)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $issue_infos->asset_tag }}</td>
                                    <td>{{ $issue_infos->asset_type }}</td>
                                    <td>{{ $issue_infos->model }}</td>
                                    <td>{{ $issue_infos->description }}</td>
                                    <td>{{ $issue_infos->others }}</td>
                                    <td>{{ $issue_infos->emp_id }}</td>
                                    <td>{{ $issue_infos->emp_name }}</td>
                                    <td>{{ $issue_infos->designation_id }}</td>
                                    <td>{{ $issue_infos->department_id }}</td>
                                    <td>{{ $issue_infos->phone_number }}</td>
                                    <td>{{ $issue_infos->email }}</td>
                                    <td></td>
                                    <td>{{ $issue_infos->issue_date }}</td>
                                    <td>{{ $issue_infos->return_date }}</td>
                                    <td>
                                        @if (empty($issue_infos->return_date))
                                        <a href="{{ route('return.form', [
                                            'asset_tag' => $issue_infos->asset_tag,
                                            'asset_type' => $issue_infos->asset_type,
                                            'model' => $issue_infos->model,
                                            'emp_id' => $issue_infos->emp_id,
                                            'emp_name' => $issue_infos->emp_name,
                                            'issue_date' => $issue_infos->issue_date
                                            ]) }}"
                                            class="btn btn-sm btn-success"
                                            title="Return Asset">
                                            <i class="fa fa-undo"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            <!-- pagination start-->
                            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                                {{-- Showing rows info + dropdown in one line --}}
                                <div class="d-flex align-items-center mb-2">
                                    {{-- Showing count --}}
                                    @if ($issue_info instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                    <span class="me-2">
                                        Showing {{ $issue_info->firstItem() }} to {{ $issue_info->lastItem() }} of {{ $issue_info->total() }} rows
                                    </span>
                                    @else
                                    <span class="me-2">Showing all {{ $issue_info->count() }} rows</span>
                                    @endif

                                    {{-- Per page dropdown --}}
                                    <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-center">
                                        <select name="per_page" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                                            @php $options = [10, 25, 50, 100, 'all']; @endphp
                                            @foreach ($options as $option)
                                            <option value="{{ $option }}" {{ request('per_page', 10) == $option ? 'selected' : '' }}>
                                                {{ is_numeric($option) ? $option : 'All' }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <span class="ms-1">rows per page</span>

                                        {{-- Retain other filters --}}
                                        <input type="hidden" name="search" value="{{ request('search') }}">
                                    </form>
                                </div>

                                {{-- Pagination links --}}
                                <div class="mb-2">
                                    @if ($issue_info instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                    <div class="pagination-wrapper">
                                        {{ $issue_info->appends(request()->query())->links() }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!-- pagination End-->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection