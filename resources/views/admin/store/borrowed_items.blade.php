@extends('master')

@section('content')
<style>
    .borrowed-item-card {
        border-left: 4px solid #f59e0b;
        transition: all 0.3s ease;
    }
    .borrowed-item-card:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    .owner-badge {
        background-color: #e0f2fe;
        color: #0277bd;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        font-weight: 500;
    }
    .borrowed-badge {
        background-color: #fff3cd;
        color: #856404;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        font-weight: 500;
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="card mb-4" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
        <div class="card-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 12px 12px 0 0;">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white">
                    <i class="fa fa-handshake me-2"></i>Borrowed Items
                    @if($borrowedItems->count() > 0)
                        <span class="badge bg-light text-dark ms-2">{{ $borrowedItems->total() }}</span>
                    @endif
                </h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('transfer_requests') }}" class="btn btn-light btn-sm">
                        <i class="fa fa-list me-1"></i>All Requests
                    </a>
                    <a href="{{ route('pending_transfer_requests') }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-clock me-1"></i>Pending Requests
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('borrowed_items') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Search</label>
                        <input type="text" class="form-control" name="search" 
                               placeholder="Asset tag, type, model..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Company</label>
                        <select class="form-control" name="company">
                            <option value="">All Companies</option>
                            @foreach($companies as $comp)
                                <option value="{{ $comp->company }}" {{ request('company') == $comp->company ? 'selected' : '' }}>
                                    {{ $comp->company }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Per Page</label>
                        <select class="form-control" name="per_page">
                            <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search me-1"></i>Search
                        </button>
                        <a href="{{ route('borrowed_items') }}" class="btn btn-secondary">
                            <i class="fa fa-refresh me-1"></i>Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Borrowed Items -->
    @if($borrowedItems->count() > 0)
        <div class="row">
            @foreach($borrowedItems as $item)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card borrowed-item-card h-100">
                    <div class="card-header bg-warning text-dark">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                <i class="fa fa-tag me-1"></i>{{ $item->asset_tag }}
                            </h6>
                            <span class="borrowed-badge">BORROWED</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <strong>Asset Type:</strong> {{ $item->asset_type }}
                        </div>
                        @if($item->model)
                        <div class="mb-2">
                            <strong>Model:</strong> {{ $item->model }}
                        </div>
                        @endif
                        <div class="mb-2">
                            <strong>Original Owner:</strong> 
                            <span class="owner-badge">{{ $item->from_company }}</span>
                        </div>
                        <div class="mb-2">
                            <strong>Currently With:</strong> 
                            <span class="text-success">{{ $item->to_company }}</span>
                        </div>
                        <div class="mb-2">
                            <strong>Transfer Date:</strong> {{ $item->transfer_date->format('M d, Y') }}
                        </div>
                        <div class="mb-2">
                            <strong>Approved:</strong> {{ $item->approved_at ? $item->approved_at->format('M d, Y') : 'N/A' }}
                        </div>
                        @if($item->note)
                        <div class="mb-3">
                            <strong>Note:</strong>
                            <p class="text-muted small mb-0">{{ $item->note }}</p>
                        </div>
                        @endif
                        @if($item->approval_notes)
                        <div class="mb-3">
                            <strong>Approval Notes:</strong>
                            <p class="text-muted small mb-0">{{ $item->approval_notes }}</p>
                        </div>
                        @endif
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fa fa-user me-1"></i>Approved by: {{ $item->approved_by ?? 'N/A' }}
                            </small>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="row text-center">
                            <div class="col-6">
                                <small class="text-muted d-block">Days Borrowed</small>
                                <strong class="text-primary">
                                    {{ $item->approved_at ? $item->approved_at->diffInDays(now()) : 0 }}
                                </strong>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Status</small>
                                <span class="badge bg-warning">Active</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                Showing {{ $borrowedItems->firstItem() ?? 0 }} to {{ $borrowedItems->lastItem() ?? 0 }} 
                of {{ $borrowedItems->total() }} borrowed items
            </div>
            <div>
                {{ $borrowedItems->links() }}
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="fa fa-handshake fa-5x text-muted"></i>
                </div>
                <h4 class="text-muted">No Borrowed Items</h4>
                <p class="text-muted">
                    @if(request('search') || request('company'))
                        No borrowed items match your search criteria.
                    @else
                        There are no borrowed items currently. Items will appear here when transfer requests are approved as "borrowed" rather than permanent transfers.
                    @endif
                </p>
                <div class="mt-3">
                    @if(request('search') || request('company'))
                        <a href="{{ route('borrowed_items') }}" class="btn btn-primary">
                            <i class="fa fa-refresh me-1"></i>Clear Filters
                        </a>
                    @endif
                    <a href="{{ route('transfer_requests') }}" class="btn btn-outline-primary">
                        <i class="fa fa-list me-1"></i>View All Transfer Requests
                    </a>
                </div>
            </div>
        </div>
    @endif

    <!-- Summary Card -->
    @if($borrowedItems->count() > 0)
    <div class="card mt-4">
        <div class="card-header">
            <h6 class="mb-0">Borrowed Items Summary</h6>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col-md-3">
                    <div class="border-end">
                        <h4 class="text-primary mb-1">{{ $borrowedItems->total() }}</h4>
                        <small class="text-muted">Total Borrowed</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border-end">
                        <h4 class="text-success mb-1">
                            {{ $borrowedItems->where('approved_at', '>=', now()->subDays(30))->count() }}
                        </h4>
                        <small class="text-muted">Last 30 Days</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border-end">
                        <h4 class="text-warning mb-1">
                            {{ $borrowedItems->where('approved_at', '<=', now()->subDays(90))->count() }}
                        </h4>
                        <small class="text-muted">Long-term (90+ days)</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <h4 class="text-info mb-1">
                        {{ $borrowedItems->unique('to_company')->count() }}
                    </h4>
                    <small class="text-muted">Companies Involved</small>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection