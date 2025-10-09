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
                <span class="">Maintenance List</span>
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
            </form>
        </div>

    </div>




    <!-- Statistics Cards -->
    <a href="{{ route('wastproduct') }}" class="btn btn-light btn-sm">
        <i class="fas fa-plus me-1"></i>Add Waste Product
    </a>
    <!-- Filters Section -->
    <div class="card filter-card mb-4">
        <div class="card-header bg-light">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="fas fa-filter me-2"></i>Advanced Filters
            </h6>
        </div>
        <div class="card-body">
            <form method="GET" id="filterForm">
                <div class="row g-3">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-semibold">Search</label>
                        <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                            placeholder="Asset tag, model, description...">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label fw-semibold">Asset Type</label>
                        <select class="form-select" name="asset_type">
                            <option value="">All Types</option>
                            @foreach($assetTypes as $type)
                            <option value="{{ $type }}" {{ request('asset_type') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label fw-semibold">Company</label>
                        <select class="form-select" name="company">
                            <option value="">All Companies</option>
                            @foreach($companies as $company)
                            <option value="{{ $company }}" {{ request('company') == $company ? 'selected' : '' }}>
                                {{ $company }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label fw-semibold">Waste Date From</label>
                        <input type="date" class="form-control" name="date_from" value="{{ request('date_from') }}">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label fw-semibold">Waste Date To</label>
                        <input type="date" class="form-control" name="date_to" value="{{ request('date_to') }}">
                    </div>
                    <div class="col-lg-1 col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-filter w-100">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label fw-semibold">Purchase Date From</label>
                        <input type="date" class="form-control" name="purchase_date_from" value="{{ request('purchase_date_from') }}">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label fw-semibold">Purchase Date To</label>
                        <input type="date" class="form-control" name="purchase_date_to" value="{{ request('purchase_date_to') }}">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label fw-semibold">Per Page</label>
                        <select class="form-select" name="per_page">
                            <option value="15" {{ request('per_page') == '15' ? 'selected' : '' }}>15</option>
                            <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100</option>
                        </select>
                    </div>
                    <div class="col-lg-6 d-flex align-items-end justify-content-end">
                        <a href="{{ route('wastproduct_list') }}" class="btn btn-reset me-2">
                            <i class="fas fa-times me-1"></i>Clear Filters
                        </a>

                        <!-- Export Section -->
                        <form action="{{ route('wastproduct_export') }}" method="GET" class="d-inline-flex align-items-end">
                            @foreach (request()->query() as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                            <select name="type" class="form-select me-2" style="width: auto;">
                                <option value="">Export As...</option>
                                <option value="xlsx">XLSX</option>
                                <option value="csv">CSV</option>
                                <option value="xls">XLS</option>
                            </select>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-download me-1"></i>Export
                            </button>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="smart-table">
                @if (session('delete_employee'))
                <div class="alert alert-success">{{ session('delete_employee') }}</div>
                @endif
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Asset Tag</th>
                                    <th>Asset Type</th>
                                    <th>Model</th>
                                    <th>Purchase Date</th>
                                    <th>Description</th>
                                    <th>Asset Sl No</th>
                                    <th>Issue Date</th>
                                    <th>Company</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody style="height: 5px !important; overflow: scroll;">
                                @forelse ($wastproduct as $key => $waste)
                                <tr>
                                    <td class="fw-semibold">{{ $wastproduct->firstItem() + $key }}</td>
                                    <td>{{ $waste->asset_tag }}</td>
                                    <td>{{ $waste->asset_type }}</td>
                                    <td>{{ $waste->model }}</td>
                                    <td>{{ $waste->purchase_date}}</td>
                                    <td>{{ $waste->description}}</td>
                                    <td>{{ $waste->asset_sl_no}}</td>
                                    <td>{{ $waste->date}}</td>
                                    <td>{{ $waste->others}}</td>

                                    <td>
                                        <a href="{{ route('wastproduct_edit', $waste->id) }}"
                                            class="btn btn-primary"
                                            title="Edit Waste Product">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('wastproduct_delete', $waste->id) }}"
                                            class="btn btn-danger"
                                            title="Delete Waste Product"
                                            onclick="return confirm('Are you sure you want to delete this waste product record?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card table-card">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="mb-0 fw-bold text-dark">
                        <i class="fas fa-list me-2"></i>Waste Product Records
                        <span class="badge bg-danger ms-2">{{ $wastproduct->total() }} Total</span>
                    </h6>
                </div>
                <div class="col-auto">
                    <small class="text-muted">
                        Showing {{ $wastproduct->firstItem() ?? 0 }} to {{ $wastproduct->lastItem() ?? 0 }}
                        of {{ $wastproduct->total() }} entries
                    </small>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>

                    </thead>

                </table>
            </div>
        </div>

        @if($wastproduct->hasPages())
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-center">
                {{ $wastproduct->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('filterForm');
        const inputs = form.querySelectorAll('input, select');

        inputs.forEach(input => {
            if (input.type === 'text') {
                let timeout;
                input.addEventListener('input', function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => {
                        if (this.value.length >= 2 || this.value.length === 0) {
                            form.submit();
                        }
                    }, 500);
                });
            } else {
                input.addEventListener('change', function() {
                    form.submit();
                });
            }
        });
    });
</script>
@endsection