@extends('master')

@section('content')
<style>
    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    .status-pending { background-color: #fef3c7; color: #92400e; }
    .status-approved { background-color: #d1fae5; color: #065f46; }
    .status-rejected { background-color: #fee2e2; color: #991b1b; }
    .transfer-type-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.7rem;
        font-weight: 500;
    }
    .type-transfer { background-color: #dbeafe; color: #1e40af; }
    .type-borrowed { background-color: #fef3c7; color: #92400e; }
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="card mb-4" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
        <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px 12px 0 0;">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white">
                    <i class="fa fa-exchange me-2"></i>Transfer Requests Management
                </h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('pending_transfer_requests') }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-clock me-1"></i>Pending Requests
                    </a>
                    <a href="{{ route('borrowed_items') }}" class="btn btn-info btn-sm">
                        <i class="fa fa-handshake me-1"></i>Borrowed Items
                    </a>
                    <a href="{{ route('transfer') }}" class="btn btn-success btn-sm">
                        <i class="fa fa-plus me-1"></i>New Transfer Request
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('transfer_requests') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Search</label>
                        <input type="text" class="form-control" name="search" 
                               placeholder="Asset tag, type, model..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-2">
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
                        <a href="{{ route('transfer_requests') }}" class="btn btn-secondary">
                            <i class="fa fa-refresh me-1"></i>Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Transfer Requests Table -->
    <div class="card">
        <div class="card-header">
            <h6 class="mb-0">Transfer Requests ({{ $transferRequests->total() }} total)</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Request Date</th>
                            <th>Asset Tag</th>
                            <th>Asset Type</th>
                            <th>Model</th>
                            <th>From Company</th>
                            <th>To Company</th>
                            <th>Transfer Type</th>
                            <th>Status</th>
                            <th>Requested By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transferRequests as $request)
                        <tr>
                            <td>{{ $request->created_at->format('M d, Y') }}</td>
                            <td><strong>{{ $request->asset_tag }}</strong></td>
                            <td>{{ $request->asset_type }}</td>
                            <td>{{ $request->model ?? 'N/A' }}</td>
                            <td>{{ $request->from_company }}</td>
                            <td>{{ $request->to_company }}</td>
                            <td>
                                <span class="transfer-type-badge type-{{ $request->item_status }}">
                                    {{ ucfirst($request->item_status) }}
                                </span>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $request->status }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td>{{ $request->requested_by ?? 'N/A' }}</td>
                            <td>
                                @if($request->status === 'pending')
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" 
                                            data-bs-target="#approveModal{{ $request->id }}">
                                        <i class="fa fa-check"></i> Approve
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" 
                                            data-bs-target="#rejectModal{{ $request->id }}">
                                        <i class="fa fa-times"></i> Reject
                                    </button>
                                @else
                                    <small class="text-muted">
                                        {{ $request->status === 'approved' ? 'Approved' : 'Rejected' }} by: {{ $request->approved_by }}<br>
                                        on {{ $request->approved_at ? $request->approved_at->format('M d, Y') : 'N/A' }}
                                    </small>
                                @endif
                            </td>
                        </tr>

                        <!-- Approve Modal -->
                        <div class="modal fade" id="approveModal{{ $request->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #28a745; color: white;">
                                        <h5 class="modal-title">Approve Transfer Request</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form method="POST" action="{{ route('approve_transfer_request', $request->id) }}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <strong>Asset:</strong> {{ $request->asset_tag }} ({{ $request->asset_type }})
                                            </div>
                                            <div class="mb-3">
                                                <strong>Transfer:</strong> {{ $request->from_company }} → {{ $request->to_company }}
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Transfer Type</label>
                                                <select name="item_status" class="form-control">
                                                    <option value="transfer" {{ $request->item_status === 'transfer' ? 'selected' : '' }}>
                                                        Permanent Transfer
                                                    </option>
                                                    <option value="borrowed" {{ $request->item_status === 'borrowed' ? 'selected' : '' }}>
                                                        Borrowed Item
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Approval Notes</label>
                                                <textarea name="approval_notes" class="form-control" rows="3" 
                                                          placeholder="Optional notes about the approval..."></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success">Approve Transfer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Reject Modal -->
                        <div class="modal fade" id="rejectModal{{ $request->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #dc3545; color: white;">
                                        <h5 class="modal-title">Reject Transfer Request</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form method="POST" action="{{ route('reject_transfer_request', $request->id) }}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <strong>Asset:</strong> {{ $request->asset_tag }} ({{ $request->asset_type }})
                                            </div>
                                            <div class="mb-3">
                                                <strong>Transfer:</strong> {{ $request->from_company }} → {{ $request->to_company }}
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Rejection Reason <span class="text-danger">*</span></label>
                                                <textarea name="rejection_reason" class="form-control" rows="3" 
                                                          placeholder="Please provide a reason for rejection..." required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Reject Transfer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                <i class="fa fa-exchange fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No transfer requests found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>
                    Showing {{ $transferRequests->firstItem() ?? 0 }} to {{ $transferRequests->lastItem() ?? 0 }} 
                    of {{ $transferRequests->total() }} results
                </div>
                <div>
                    {{ $transferRequests->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection