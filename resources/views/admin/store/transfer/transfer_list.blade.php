@extends('master')
@section('content')
<style>
    .gradient-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    .stats-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border-left: 4px solid #667eea;
    }
    .stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .filter-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        border: none;
    }
    .table-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        border: none;
        overflow: hidden;
    }
    .custom-table {
        margin-bottom: 0;
    }
    .custom-table thead th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        font-weight: 600;
        padding: 15px 12px;
        font-size: 13px;
        letter-spacing: 0.5px;
    }
    .custom-table tbody td {
        padding: 12px;
        border-color: #f0f0f0;
        vertical-align: middle;
    }
    .custom-table tbody tr:hover {
        background-color: #f8f9ff;
    }
    .action-btn {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        margin: 2px;
    }
    .action-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .btn-edit {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    .badge-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    .status-transferred {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .status-returned {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }
    .filter-section {
        background: #f8f9ff;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .btn-filter {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-filter:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }
    .btn-reset {
        background: #6c757d;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        color: white;
        font-weight: 600;
    }
    .export-section {
        background: white;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
</style>

<div class="container-fluid">
    <!-- Header Section -->
    <div class="gradient-header mb-4 p-4">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h3 class="text-white mb-1 fw-bold">
                    <i class="fas fa-exchange-alt me-2"></i>Transfer Management
                </h3>
                <p class="text-white-50 mb-0">Manage and track asset transfers</p>
            </div>
            <div class="col-lg-6 text-end">
                <a href="{{ route('transfer') }}" class="btn btn-light btn-sm me-2">
                    <i class="fas fa-plus me-1"></i>New Transfer
                </a>
                <a href="{{ route('transfer_return') }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-undo me-1"></i>Return Asset
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-1">Total Transfers</h6>
                        <h4 class="mb-0 text-primary fw-bold">{{ $statistics['total'] ?? 0 }}</h4>
                    </div>
                    <div class="text-primary">
                        <i class="fas fa-exchange-alt fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-1">Active Transfers</h6>
                        <h4 class="mb-0 text-success fw-bold">{{ $statistics['transferred'] ?? 0 }}</h4>
                    </div>
                    <div class="text-success">
                        <i class="fas fa-arrow-right fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-1">Returned Assets</h6>
                        <h4 class="mb-0 text-info fw-bold">{{ $statistics['returned'] ?? 0 }}</h4>
                    </div>
                    <div class="text-info">
                        <i class="fas fa-arrow-left fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted mb-1">This Month</h6>
                        <h4 class="mb-0 text-warning fw-bold">{{ $statistics['this_month'] ?? 0 }}</h4>
                    </div>
                    <div class="text-warning">
                        <i class="fas fa-calendar fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        <label class="form-label fw-semibold">Date From</label>
                        <input type="date" class="form-control" name="date_from" value="{{ request('date_from') }}">
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <label class="form-label fw-semibold">Date To</label>
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
                        <label class="form-label fw-semibold">Status</label>
                        <select class="form-select" name="status">
                            <option value="">All Status</option>
                            <option value="transferred" {{ request('status') == 'transferred' ? 'selected' : '' }}>Transferred</option>
                            <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Returned</option>
                        </select>
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
                    <div class="col-lg-8 d-flex align-items-end justify-content-end">
                        <a href="{{ route('transfer_list') }}" class="btn btn-reset me-2">
                            <i class="fas fa-times me-1"></i>Clear Filters
                        </a>

                        <!-- Export Section -->
                        <form action="{{ route('transfer_export') }}" method="GET" class="d-inline-flex align-items-end">
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

    <!-- Data Table -->
    <div class="card table-card">
        <div class="card-header bg-white">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="mb-0 fw-bold text-dark">
                        <i class="fas fa-list me-2"></i>Transfer Records
                        <span class="badge bg-primary ms-2">{{ $transer_data->total() }} Total</span>
                    </h6>
                </div>
                <div class="col-auto">
                    <small class="text-muted">
                        Showing {{ $transer_data->firstItem() ?? 0 }} to {{ $transer_data->lastItem() ?? 0 }}
                        of {{ $transer_data->total() }} entries
                    </small>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
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
                            <th>Status</th>
                            <th style="width: 80px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transer_data as $key => $transfer)
                        <tr>
                            <td class="fw-semibold">{{ $transer_data->firstItem() + $key }}</td>
                            <td>
                                <span class="badge bg-light text-dark fw-semibold">{{ $transfer->asset_tag }}</span>
                            </td>
                            <td>{{ $transfer->asset_type }}</td>
                            <td>{{ $transfer->model }}</td>
                            <td>
                                <small class="text-muted">{{ $transfer->oldcompany }}</small>
                            </td>
                            <td>
                                <strong class="text-primary">{{ $transfer->company }}</strong>
                            </td>
                            <td>
                                <div style="max-width: 200px;">
                                    <small class="text-truncate d-block">{{ $transfer->description }}</small>
                                </div>
                            </td>
                            <td>
                                <small class="text-success fw-semibold">
                                    {{ $transfer->transfer_date ? date('M d, Y', strtotime($transfer->transfer_date)) : '-' }}
                                </small>
                            </td>
                            <td>
                                <small class="text-info fw-semibold">
                                    {{ $transfer->return_date ? date('M d, Y', strtotime($transfer->return_date)) : '-' }}
                                </small>
                            </td>
                            <td>
                                @if($transfer->return_date)
                                    <span class="badge status-returned">Returned</span>
                                @else
                                    <span class="badge status-transferred">Active</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('transfer_edit', $transfer->id) }}"
                                   class="action-btn btn-edit"
                                   title="Edit Transfer">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <h6>No transfer records found</h6>
                                    <p class="mb-0">Try adjusting your search criteria</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($transer_data->hasPages())
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-center">
                {{ $transer_data->appends(request()->query())->links() }}
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
        if(input.type === 'text') {
            let timeout;
            input.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    if(this.value.length >= 2 || this.value.length === 0) {
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