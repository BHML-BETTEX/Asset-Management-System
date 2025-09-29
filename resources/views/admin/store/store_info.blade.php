@extends('master')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <div class="asset-icon me-3">
                                    <i class="fa fa-desktop fa-3x opacity-75"></i>
                                </div>
                                <div>
                                    <h2 class="mb-1 fw-bold">{{ $stores->products_id }}</h2>
                                    <p class="mb-1 opacity-90">{{ $stores->rel_to_ProductType->product ?? 'N/A' }} - {{ $stores->model ?? 'No Model' }}</p>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-light text-dark me-2 px-3 py-2">
                                            <i class="fa fa-tag me-1"></i>{{ $stores->rel_to_Status->status_name ?? 'Unknown' }}
                                        </span>
                                        <span class="badge bg-{{ $stores->checkstatus == 'INSTOCK' ? 'success' : ($stores->checkstatus == 'MAINTENANCE' ? 'warning' : 'info') }} me-2 px-3 py-2">
                                            <i class="fa fa-circle me-1"></i>{{ $stores->checkstatus ?? 'Unknown' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="btn-group">
                                <a href="{{ route('store.edit', $stores->id) }}" class="btn btn-light">
                                    <i class="fa fa-edit me-1"></i>Edit
                                </a>
                                <a href="{{ route('store.clone', $stores->id) }}" class="btn btn-light">
                                    <i class="fa fa-copy me-1"></i>Clone
                                </a>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="fa fa-cog me-1"></i>Actions
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="{{ route('qr_code', $stores->id) }}"><i class="fa fa-qrcode me-2"></i>QR Code</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="printAsset()"><i class="fa fa-print me-2"></i>Print Label</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#" onclick="deleteAsset()"><i class="fa fa-trash me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success') || session('successs'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle me-2"></i>
            <strong>Success:</strong> {{ session('success') ?? session('successs') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Main Content -->
    <div class="row">
        <!-- Left Column - Asset Details -->
        <div class="col-lg-8">
            <!-- Basic Information -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 text-primary">
                        <i class="fa fa-info-circle me-2"></i>Asset Information
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="p-4 border-end">
                                <div class="info-item mb-3">
                                    <label class="text-muted small text-uppercase fw-semibold">Asset Tag</label>
                                    <div class="fw-bold text-primary fs-5">{{ $stores->products_id }}</div>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="text-muted small text-uppercase fw-semibold">Asset Type</label>
                                    <div>{{ $stores->rel_to_ProductType->product ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="text-muted small text-uppercase fw-semibold">Brand</label>
                                    <div>{{ $stores->rel_to_brand->brand_name ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="text-muted small text-uppercase fw-semibold">Model</label>
                                    <div>{{ $stores->model ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item">
                                    <label class="text-muted small text-uppercase fw-semibold">Serial Number</label>
                                    <div>{{ $stores->asset_sl_no ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4">
                                <div class="info-item mb-3">
                                    <label class="text-muted small text-uppercase fw-semibold">Status</label>
                                    <div>
                                        <span class="badge bg-{{ $stores->checkstatus == 'INSTOCK' ? 'success' : ($stores->checkstatus == 'MAINTENANCE' ? 'warning' : 'info') }}">
                                            {{ $stores->checkstatus ?? 'Unknown' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="text-muted small text-uppercase fw-semibold">Company</label>
                                    <div>{{ $stores->rel_to_Company->company ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="text-muted small text-uppercase fw-semibold">Supplier</label>
                                    <div>{{ $stores->rel_to_Supplier->supplier_name ?? 'N/A' }}</div>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="text-muted small text-uppercase fw-semibold">Purchase Date</label>
                                    <div>{{ $stores->purchase_date ? \Carbon\Carbon::parse($stores->purchase_date)->format('M d, Y') : 'N/A' }}</div>
                                </div>
                                <div class="info-item">
                                    <label class="text-muted small text-uppercase fw-semibold">Cost</label>
                                    <div class="fw-semibold text-success">
                                        {{ $stores->currency ?? '$' }} {{ number_format($stores->cost ?? 0, 2) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Technical Specifications -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 text-primary">
                        <i class="fa fa-cogs me-2"></i>Technical Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="info-item mb-3">
                                <label class="text-muted small text-uppercase fw-semibold">Quantity</label>
                                <div>{{ $stores->qty ?? 1 }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item mb-3">
                                <label class="text-muted small text-uppercase fw-semibold">Units</label>
                                <div>{{ $stores->rel_to_SizeMaseurment->size ?? 'N/A' }}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item mb-3">
                                <label class="text-muted small text-uppercase fw-semibold">Warranty</label>
                                <div>{{ $stores->warrenty ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </div>
                    @if($stores->description)
                    <div class="info-item">
                        <label class="text-muted small text-uppercase fw-semibold">Description</label>
                        <div class="mt-1">{{ $stores->description }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Asset History -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">
                        <i class="fa fa-history me-2"></i>Asset History
                    </h5>
                    <a href="{{ route('history', $stores->products_id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-external-link me-1"></i>View Full History
                    </a>
                </div>
                <div class="card-body">
                    @if($issues && $issues->count() > 0)
                        <div class="timeline">
                            @foreach($issues->take(3) as $issue)
                            <div class="timeline-item">
                                <div class="timeline-marker bg-primary"></div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">{{ $issue->action ?? 'Asset Activity' }}</h6>
                                            <p class="text-muted mb-1">{{ $issue->details ?? 'No details available' }}</p>
                                            <small class="text-muted">
                                                <i class="fa fa-calendar me-1"></i>
                                                {{ $issue->created_at ? $issue->created_at->format('M d, Y H:i') : 'Unknown date' }}
                                            </small>
                                        </div>
                                        <span class="badge bg-info">{{ $issue->type ?? 'Activity' }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if($issues->count() > 3)
                        <div class="text-center mt-3">
                            <small class="text-muted">Showing 3 of {{ $issues->count() }} activities</small>
                        </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="fa fa-clock-o fa-2x text-muted mb-2"></i>
                            <p class="text-muted">No history records found for this asset.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column - Asset Image & Quick Actions -->
        <div class="col-lg-4">
            <!-- Asset Image -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 text-primary">
                        <i class="fa fa-image me-2"></i>Asset Photo
                    </h5>
                </div>
                <div class="card-body text-center">
                    @if($stores->picture && $stores->picture !== 'default.png')
                        <img src="{{ asset('/uploads/store/' . $stores->picture) }}"
                             alt="Asset Photo"
                             class="img-fluid rounded shadow-sm mb-3"
                             style="max-height: 300px;">
                        <div>
                            <button class="btn btn-sm btn-outline-primary" onclick="viewFullImage()">
                                <i class="fa fa-expand me-1"></i>View Full Size
                            </button>
                        </div>
                    @else
                        <div class="py-5">
                            <i class="fa fa-image fa-4x text-muted mb-3"></i>
                            <p class="text-muted">No image available</p>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-upload me-1"></i>Upload Photo
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 text-primary">
                        <i class="fa fa-bolt me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('store.edit', $stores->id) }}" class="btn btn-outline-primary">
                            <i class="fa fa-edit me-2"></i>Edit Asset
                        </a>
                        <a href="{{ route('store.clone', $stores->id) }}" class="btn btn-outline-info">
                            <i class="fa fa-copy me-2"></i>Clone Asset
                        </a>
                        <a href="{{ route('qr_code', $stores->id) }}" class="btn btn-outline-secondary">
                            <i class="fa fa-qrcode me-2"></i>Generate QR Code
                        </a>
                        <button class="btn btn-outline-warning" onclick="changeStatus()">
                            <i class="fa fa-exchange me-2"></i>Change Status
                        </button>
                        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#uploadsModal">
                            <i class="fa fa-paperclip me-2"></i>Upload Files
                        </button>
                    </div>
                </div>
            </div>

            <!-- Asset Stats -->
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 text-primary">
                        <i class="fa fa-chart-bar me-2"></i>Asset Statistics
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border-end">
                                <div class="h4 text-primary mb-1">{{ $issues ? $issues->count() : 0 }}</div>
                                <small class="text-muted">History Records</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="h4 text-success mb-1">
                                {{ $stores->created_at ? $stores->created_at->diffInDays(now()) : 0 }}
                            </div>
                            <small class="text-muted">Days Old</small>
                        </div>
                    </div>
                    <hr>
                    <div class="small text-muted">
                        <div class="d-flex justify-content-between">
                            <span>Created:</span>
                            <span>{{ $stores->created_at ? $stores->created_at->format('M d, Y') : 'Unknown' }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Last Updated:</span>
                            <span>{{ $stores->updated_at ? $stores->updated_at->format('M d, Y') : 'Unknown' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- File Upload Modal -->
<div class="modal fade" id="uploadsModal" tabindex="-1" aria-labelledby="uploadsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h5 class="modal-title text-white" id="uploadsModalLabel">
                    <i class="fa fa-paperclip me-2"></i>Upload Files for {{ $stores->products_id }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="fileUploadForm" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="asset_id" value="{{ $stores->id }}">

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Select Files</label>
                        <div class="border border-dashed border-2 rounded p-4 text-center">
                            <i class="fa fa-cloud-upload fa-3x text-muted mb-3"></i>
                            <p class="mb-2">Drag and drop files here or click to browse</p>
                            <input type="file" class="form-control" name="files[]" multiple id="fileInput" style="display: none;">
                            <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('fileInput').click()">
                                <i class="fa fa-folder-open me-1"></i>Choose Files
                            </button>
                        </div>
                        <small class="text-muted mt-2">
                            Supported formats: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG, ZIP, etc. Max size: 8MB per file
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Notes (Optional)</label>
                        <textarea class="form-control" name="notes" rows="3" placeholder="Add any notes about these files..."></textarea>
                    </div>

                    <div id="selectedFiles" class="mb-3" style="display: none;">
                        <label class="form-label fw-semibold">Selected Files:</label>
                        <div id="filesList"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="fileUploadForm" class="btn btn-primary">
                    <i class="fa fa-upload me-1"></i>Upload Files
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Asset Photo - {{ $stores->products_id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('/uploads/store/' . $stores->picture) }}" alt="Asset Photo" class="img-fluid">
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 2px #007bff;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -31px;
    top: 17px;
    width: 2px;
    height: calc(100% + 10px);
    background: #e9ecef;
}

.info-item label {
    display: block;
    margin-bottom: 2px;
    font-size: 11px;
    letter-spacing: 0.5px;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 25px rgba(0,0,0,0.1) !important;
}

.asset-icon {
    opacity: 0.8;
}

.btn-group .btn {
    border-color: rgba(255,255,255,0.3);
}
</style>

<script>
$(document).ready(function() {
    // File upload handling
    $('#fileInput').change(function() {
        const files = this.files;
        if (files.length > 0) {
            $('#selectedFiles').show();
            let filesList = '';
            for (let i = 0; i < files.length; i++) {
                filesList += `<div class="badge bg-light text-dark me-1 mb-1">${files[i].name}</div>`;
            }
            $('#filesList').html(filesList);
        } else {
            $('#selectedFiles').hide();
        }
    });
});

function viewFullImage() {
    $('#imageModal').modal('show');
}

function printAsset() {
    window.open('{{ route("qr_code", $stores->id) }}', '_blank');
}

function deleteAsset() {
    if (confirm('Are you sure you want to delete this asset? This action cannot be undone.')) {
        window.location.href = '{{ route("store.delete", $stores->id) }}';
    }
}

function changeStatus() {
    // Implementation for status change
    alert('Status change functionality to be implemented');
}
</script>
@endpush