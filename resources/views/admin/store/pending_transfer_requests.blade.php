@extends('master')

@section('content')
<style>
    .request-card {
        border-left: 4px solid #fbbf24;
        transition: all 0.3s ease;
    }
    .request-card:hover {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    .transfer-type-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.7rem;
        font-weight: 500;
    }
    .type-transfer { background-color: #dbeafe; color: #1e40af; }
    .type-borrowed { background-color: #fef3c7; color: #92400e; }
    .notification-pulse {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
</style>

<div class="container">
    <!-- Page Header -->
    <div class="card mb-4" style=" background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
        <div class="card-header" style="">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white">
                    <i class="fa fa-clock me-2"></i>Pending Transfer Requests
                    @if($pendingRequests->count() > 0)
                        <span class="badge bg-light text-dark ms-2 notification-pulse">{{ $pendingRequests->count() }}</span>
                    @endif
                </h5>
                <div class="d-flex gap-2">
                    <a href="{{ route('transfer_requests') }}" class="btn btn-light btn-sm">
                        <i class="fa fa-list me-1"></i> All Requests
                    </a>
                    <a href="{{ route('borrowed_items') }}" class="btn btn-info btn-sm">
                        <i class="fa fa-handshake me-1"></i> Borrowed Items
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if(session('transfer_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle me-2"></i>{{ session('transfer_success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert">X</button>
        </div>
    @endif

    <!-- Pending Requests -->
    @if($pendingRequests->count() > 0)
        <div class="row">
            @foreach($pendingRequests as $request)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card request-card h-100">
                    <div class="card-header bg-warning text-dark">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                <i class="fa fa-tag me-1"></i>{{ $request->asset_tag }}
                            </h6>
                            <small>{{ $request->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <strong>Asset Type:</strong> {{ $request->asset_type }}
                        </div>
                        @if($request->model)
                        <div class="mb-2">
                            <strong>Model:</strong> {{ $request->model }}
                        </div>
                        @endif
                        <div class="mb-2">
                            <strong>From:</strong> <span class="text-primary">{{ $request->from_company }}</span>
                        </div>
                        <div class="mb-2">
                            <strong>To:</strong> <span class="text-success">{{ $request->to_company }}</span>
                        </div>
                        <div class="mb-2">
                            <strong>Transfer Date:</strong> {{ $request->transfer_date->format('M d, Y') }}
                        </div>
                        <div class="mb-2">
                            <strong>Type:</strong> 
                            <span class="transfer-type-badge type-{{ $request->item_status }}">
                                {{ ucfirst($request->item_status) }}
                            </span>
                        </div>
                        @if($request->note)
                        <div class="mb-3">
                            <strong>Note:</strong>
                            <p class="text-muted small mb-0">{{ $request->note }}</p>
                        </div>
                        @endif
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fa fa-user me-1"></i>Requested by: {{ $request->requested_by ?? 'N/A' }}
                            </small>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex gap-2">
                            <button class="btn btn-success btn-sm flex-fill" data-bs-toggle="modal" 
                                    data-bs-target="#quickApproveModal{{ $request->id }}">
                                <i class="fa fa-check me-1"></i>Approve
                            </button>
                            <button class="btn btn-danger btn-sm flex-fill" data-bs-toggle="modal" 
                                    data-bs-target="#quickRejectModal{{ $request->id }}">
                                <i class="fa fa-times me-1"></i>Reject
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Quick Approve Modal -->
                <div class="modal fade" id="quickApproveModal{{ $request->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #28a745; color: white;">
                                <h5 class="modal-title">
                                    <i class="fa fa-check me-2"></i>Approve Transfer Request
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form method="POST" action="{{ route('approve_transfer_request', $request->id) }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="alert alert-info">
                                        <strong>Asset:</strong> {{ $request->asset_tag }} ({{ $request->asset_type }})<br>
                                        <strong>Transfer:</strong> {{ $request->from_company }} → {{ $request->to_company }}
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Transfer Type</label>
                                        <select name="item_status" class="form-control" required>
                                            <option value="transfer" {{ $request->item_status === 'transfer' ? 'selected' : '' }}>
                                                Permanent Transfer - Ownership changes to receiving company
                                            </option>
                                            <option value="borrowed" {{ $request->item_status === 'borrowed' ? 'selected' : '' }}>
                                                Borrowed Item - Original company retains ownership
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
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check me-1"></i>Approve Transfer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Quick Reject Modal -->
                <div class="modal fade" id="quickRejectModal{{ $request->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #dc3545; color: white;">
                                <h5 class="modal-title">
                                    <i class="fa fa-times me-2"></i>Reject Transfer Request
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form method="POST" action="{{ route('reject_transfer_request', $request->id) }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="alert alert-warning">
                                        <strong>Asset:</strong> {{ $request->asset_tag }} ({{ $request->asset_type }})<br>
                                        <strong>Transfer:</strong> {{ $request->from_company }} → {{ $request->to_company }}
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Rejection Reason <span class="text-danger">*</span></label>
                                        <textarea name="rejection_reason" class="form-control" rows="4" 
                                                  placeholder="Please provide a clear reason for rejecting this transfer request..." required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-times me-1"></i>Reject Transfer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <div class="mb-4">
                    <i class="fa fa-check-circle fa-5x text-success"></i>
                </div>
                <h4 class="text-muted">No Pending Transfer Requests</h4>
                <p class="text-muted">All transfer requests have been processed or there are no new requests waiting for approval.</p>
                <a href="{{ route('transfer_requests') }}" class="btn btn-primary">
                    <i class="fa fa-list me-1"></i> View All Requests
                </a>
            </div>
        </div>
    @endif
</div>

@push('script')
<script>
$(document).ready(function() {
    // Auto-refresh page every 30 seconds if there are pending requests
    @if($pendingRequests->count() > 0)
    setTimeout(function() {
        location.reload();
    }, 30000);
    @endif
});
</script>
@endpush
@endsection