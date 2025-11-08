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
    <!-- Filters Section -->
    <div class="card mb-2" style="">
        <div class="card-header" style="background-color: #f8f9fa; border-radius: 12px 12px 0 0;">
            <h6 class="mb-0 text-dark">
                <span class="">Transfer List</span>
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
                        <select name="asset_type" class="form-control form-control-sm select2-filter">
                            <option value="">All Types</option>
                            @foreach ($assetTypes as $type)
                            <option value="{{ $type }}" {{ request('asset_type') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">From Company</label>
                        <select class="form-control" name="from_company">
                            <option value="">All</option>
                            @foreach($fromCompanies as $from)
                            <option value="{{ $from->id }}" {{ request('from_company') == $from->id ? 'selected' : '' }}>
                                {{ $from->company }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="fa fa-search"></i> Apply Filters
                        </button>
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn btn-success btn-sm w-100">
                            <a href="{{ route('transfer') }}" class="text-white">
                                <i class="fa fa-plus me-1"></i> New Transfer
                            </a>
                        </button>
                    </div>

                    <!-- <div class="filter-actions">
                        <button type="submit" class="btn btn-warning btn-sm w-100">
                            <a href="{{ route('transfer_return') }}" class="text-white">
                                <i class="fa fa-plus me-1"></i> Return Asset
                            </a>
                        </button>
                    </div> -->
                </div>
            </form>
        </div>

    </div>

    <!-- Data Table -->
    <div class="card table-card">
        <div class="smart-table">
            <div class="card-body">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Asset Tag</th>
                            <th>Asset Type</th>
                            <th>Model</th>
                            <th>From Company</th>
                            <th>To Company</th>
                            <th>Description</th>
                            <th>Transfer Date</th>
                            <th>Return Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody style="height: 5px !important; overflow: scroll;">
                        @forelse ($transer_data as $key => $transfer)
                        <tr>
                            <td data-column="">{{ $transer_data->firstItem() + $key }}</td>
                            <td data-column="">{{ $transfer->asset_tag }}</td>
                            <td data-column="">{{ $transfer->asset_type }}</td>
                            <td data-column="">{{ $transfer->model }}</td>
                            <td data-column="">{{ $transfer->Fromcompany->company }}</td>
                            <td data-column="">{{ $transfer->Tocompany->company }}</td>
                            <td data-column="">{{ $transfer->description }}</td>
                            <td data-column="">{{ $transfer->transfer_date ? date('M d, Y', strtotime($transfer->transfer_date)) : '-' }}</td>
                            <td data-column="">
                                @if($transfer->return_date)
                                <span class="badge status-returned bg-warning">Returned</span>
                                @else
                                <span class="badge status-transferred bg-success text-white">Active</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('transfer_edit', $transfer->id) }}"
                                    class="action-btn btn-edit"
                                    title="Edit Transfer">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!--Pagination Start-->
        <div class="d-flex justify-content-between align-items-center p-3 border-top">
            <div class="d-flex align-items-center">
                @if ($transer_data instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <span class="text-muted me-3">
                    Showing {{ $transer_data->firstItem() }} to {{ $transer_data->lastItem() }} of {{ $transer_data->total() }} assets
                </span>
                @else
                <span class="text-muted me-3">Showing all {{ $transer_data->count() }} assets</span>
                @endif

                <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-center">
                    <select name="per_page" class="form-select form-select-sm" onchange="this.form.submit()" style="width: auto;">
                        @php $options = [10, 25, 50, 100, 'all']; @endphp
                        @foreach ($options as $option)
                        <option value="{{ $option }}" {{ request('per_page', 10) == $option ? 'selected' : '' }}>
                            {{ is_numeric($option) ? $option : 'All' }}
                        </option>
                        @endforeach
                    </select>
                    <span class="text-muted ms-2">per page</span>

                    <!-- Preserve all filters -->
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="product_search" value="{{ request('product_search') }}">
                    <input type="hidden" name="status_filter" value="{{ request('status_filter') }}">
                    <input type="hidden" name="company_filter" value="{{ request('company_filter') }}">
                    <input type="hidden" name="date_from" value="{{ request('date_from') }}">
                    <input type="hidden" name="date_to" value="{{ request('date_to') }}">
                    <input type="hidden" name="cost_min" value="{{ request('cost_min') }}">
                    <input type="hidden" name="cost_max" value="{{ request('cost_max') }}">
                </form>
            </div>

            @if ($transer_data instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="pagination-wrapper">
                {{ $transer_data->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
        <!--Pagination end-->
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