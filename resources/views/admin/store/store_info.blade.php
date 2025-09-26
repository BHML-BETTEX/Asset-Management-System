@extends('master')

@section('content')

<style>
    .asset-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .asset-header h1 {
        margin: 0;
        font-size: 2rem;
        font-weight: 600;
    }

    .asset-header .asset-tag {
        font-size: 1.2rem;
        background: rgba(255, 255, 255, 0.2);
        padding: 0.5rem 1rem;
        border-radius: 25px;
        display: inline-block;
        margin-top: 0.5rem;
    }

    .nav-tabs-custom {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        padding: 1rem;
        margin-bottom: 2rem;
    }

    .nav-tabs-custom .nav-link {
        border: none;
        background: transparent;
        color: #6c757d;
        font-weight: 500;
        padding: 0.8rem 1.5rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .nav-tabs-custom .nav-link.active {
        background: #667eea;
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .nav-tabs-custom .nav-link:hover {
        background: #f8f9fa;
        color: #495057;
    }

    .info-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
        overflow: hidden;
        border: none;
    }

    .info-card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1.5rem;
        border-bottom: 1px solid #dee2e6;
    }

    .info-card-header h5 {
        margin: 0;
        color: #495057;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .info-section {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .info-section-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1rem 1.5rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-section-body {
        padding: 1.5rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.8rem 0;
        border-bottom: 1px solid #f1f3f4;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #495057;
        min-width: 120px;
    }

    .info-value {
        color: #6c757d;
        text-align: right;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-instock {
        background: #d4edda;
        color: #155724;
    }

    .status-issued {
        background: #cce5ff;
        color: #004085;
    }

    .status-maintenance {
        background: #fff3cd;
        color: #856404;
    }

    .asset-image {
        width: 100%;
        max-width: 300px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .action-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem;
        border: none;
        border-radius: 10px;
        color: white;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        justify-content: center;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        color: white;
        text-decoration: none;
    }

    .btn-edit { background: linear-gradient(135deg, #17a2b8, #138496); }
    .btn-print { background: linear-gradient(135deg, #28a745, #20c997); }
    .btn-email { background: linear-gradient(135deg, #6f42c1, #e83e8c); }
    .btn-delete { background: linear-gradient(135deg, #dc3545, #c82333); }

    .depreciation-info {
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        border-radius: 10px;
        padding: 1rem;
        margin-top: 1rem;
    }

    .financial-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
    }

    .financial-item {
        text-align: center;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .financial-value {
        font-size: 1.5rem;
        font-weight: bold;
        color: #495057;
    }

    .financial-label {
        font-size: 0.9rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    @media (max-width: 768px) {
        .asset-header {
            padding: 1.5rem;
            text-align: center;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .quick-actions {
            grid-template-columns: 1fr;
        }

        .financial-summary {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<div class="container-fluid">

    <!-- Asset Header -->
    <div class="asset-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1>{{ $stores->model }} - {{ $stores->rel_to_brand->brand_name }}</h1>
                <p class="mb-2">{{ $stores->rel_to_ProductType->product }}</p>
                <span class="asset-tag">{{ $stores->products_id }}</span>
            </div>
            <div class="col-md-4 text-end">
                <div class="status-badge status-{{ strtolower($stores->checkstatus) }}">
                    {{ $stores->checkstatus }}
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs w-100 d-flex align-items-center" id="assetTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="info-tab" data-bs-toggle="tab" href="#info" role="tab">
                    <i class="fa fa-info-circle"></i> Asset Details
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('history', $stores->products_id) }}">
                    <i class="fa fa-history"></i> History
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="maintenance-tab" data-bs-toggle="tab" href="#maintenance" role="tab">
                    <i class="fa fa-wrench"></i> Maintenance
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="files-tab" data-bs-toggle="tab" href="#files" role="tab">
                    <i class="fa fa-file"></i> Files
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="uploads-tab" href="#" role="tab" data-toggle="modal" data-target="#uploadsModal">
                    <i class="fa fa-paperclip"></i> Upload
                </a>
            </li>
            <li class="nav-item dropdown ms-auto">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                    <i class="fa fa-gear"></i> Actions
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('store.edit', $stores->id) }}"><i class="fa fa-edit"></i> Edit Asset</a></li>
                    <li><a class="dropdown-item" href="{{ route('qr_code', $stores->id) }}"><i class="fa fa-qrcode"></i> Generate QR</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete Asset</a></li>
                </ul>
            </li>
        </ul>
    </div>
    {{-- ✅ Alert Message Section --}}
    @if(session('successs'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <strong>Success:</strong> {{ session('successs') }}
        <button type="button" class="btn btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Uploads Modal -->
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
                    <form id="fileUploadForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- File Upload -->
                        <div class="mb-3">
                            <label class="btn btn-outline-secondary w-100">
                                Select File...
                                <input type="file" class="js-uploadFile d-none" name="file" multiple required>
                            </label>
                        </div>
                        <p class="help-block" id="uploadFile-status">Allowed filetypes are: .avif, .doc, .doc, .docx, .docx, .gif, .ico, .jpeg, .jpg, .json, .key, .lic, .mov, .mp3, .mp4, .odp, .ods, .odt, .ogg, .pdf, .png, .rar, .rtf, .svg, .txt, .wav, .webm, .webp, .xls, .xlsx, .xml, .zip. Max upload size allowed is 8M.</p>

                        <!-- Note Textarea -->
                        <div class="mb-3">
                            <textarea class="form-control" name="note" rows="3" placeholder="Enter a note (optional)"></textarea>
                        </div>
                    </form>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn text-white" style="background-color: #2B7093;" form="fileUploadForm">
                        upload
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Top Navbar -->

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Asset Info Tab -->
        <div class="tab-pane fade show active" id="info" role="tabpanel">
            <div class="info-grid">
                <!-- Basic Information -->
                <div class="info-section">
                    <div class="info-section-header">
                        <i class="fa fa-info-circle"></i>
                        Basic Information
                    </div>
                    <div class="info-section-body">
                        <div class="info-item">
                            <span class="info-label">Asset Tag</span>
                            <span class="info-value text-success fw-bold">{{ $stores->products_id }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Asset Type</span>
                            <span class="info-value">{{ $stores->rel_to_ProductType->product }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Brand</span>
                            <span class="info-value">{{ $stores->rel_to_brand->brand_name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Model</span>
                            <span class="info-value">{{ $stores->model }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Serial Number</span>
                            <span class="info-value">{{ $stores->asset_sl_no ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Description</span>
                            <span class="info-value">{{ $stores->description ?? 'No description' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Status & Assignment -->
                <div class="info-section">
                    <div class="info-section-header">
                        <i class="fa fa-tasks"></i>
                        Status & Assignment
                    </div>
                    <div class="info-section-body">
                        <div class="info-item">
                            <span class="info-label">Current Status</span>
                            <span class="status-badge status-{{ strtolower($stores->checkstatus) }}">
                                {{ $stores->checkstatus }}
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Asset Status</span>
                            <span class="info-value">{{ $stores->rel_to_Status->status_name ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Company</span>
                            <span class="info-value">{{ $stores->rel_to_Company->company }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Location</span>
                            <span class="info-value">{{ $stores->location ?? 'Not specified' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Assigned To</span>
                            <span class="info-value">{{ $stores->assigned_to ?? 'Unassigned' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Financial Information -->
                <div class="info-section">
                    <div class="info-section-header">
                        <i class="fa fa-dollar-sign"></i>
                        Financial Information
                    </div>
                    <div class="info-section-body">
                        <div class="info-item">
                            <span class="info-label">Purchase Cost</span>
                            <span class="info-value fw-bold">{{ $stores->currency ?? 'USD' }} {{ number_format($stores->cost ?? 0, 2) }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Purchase Date</span>
                            <span class="info-value">{{ $stores->purchase_date ? \Carbon\Carbon::parse($stores->purchase_date)->format('M d, Y') : 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Supplier</span>
                            <span class="info-value">{{ $stores->rel_to_Supplier->supplier_name ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Challan No</span>
                            <span class="info-value">{{ $stores->challan_no ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Warranty Period</span>
                            <span class="info-value">{{ $stores->warrenty ?? 'N/A' }}</span>
                        </div>

                        @php
                            $purchaseDate = \Carbon\Carbon::parse($stores->purchase_date);
                            $currentValue = $stores->cost * 0.8; // Simple depreciation calculation
                            $ageInMonths = $purchaseDate->diffInMonths(now());
                        @endphp

                        <div class="depreciation-info">
                            <div class="financial-summary">
                                <div class="financial-item">
                                    <div class="financial-value">${{ number_format($currentValue, 0) }}</div>
                                    <div class="financial-label">Current Value</div>
                                </div>
                                <div class="financial-item">
                                    <div class="financial-value">{{ $ageInMonths }}</div>
                                    <div class="financial-label">Age (Months)</div>
                                </div>
                                <div class="financial-item">
                                    <div class="financial-value">{{ $stores->durablity ?? 'N/A' }}</div>
                                    <div class="financial-label">Expected Life</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Specifications -->
                <div class="info-section">
                    <div class="info-section-header">
                        <i class="fa fa-cog"></i>
                        Specifications
                    </div>
                    <div class="info-section-body">
                        <div class="info-item">
                            <span class="info-label">Quantity</span>
                            <span class="info-value">{{ $stores->qty ?? 1 }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Units</span>
                            <span class="info-value">{{ $stores->rel_to_SizeMaseurment->size ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Durability</span>
                            <span class="info-value">{{ $stores->durablity ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Others</span>
                            <span class="info-value">{{ $stores->others ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Balance</span>
                            <span class="info-value">{{ $stores->balance ?? 'N/A' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Last Updated</span>
                            <span class="info-value">{{ $stores->updated_at->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Asset Image & QR Code -->
                <div class="info-section">
                    <div class="info-section-header">
                        <i class="fa fa-image"></i>
                        Asset Image & QR
                    </div>
                    <div class="info-section-body text-center">
                        @if($stores->picture)
                            <img src="{{ asset('/uploads/store/' . $stores->picture) }}"
                                alt="Asset Image" class="asset-image mb-3">
                        @else
                            <div class="alert alert-info">
                                <i class="fa fa-image fa-3x mb-2"></i>
                                <p>No image available</p>
                            </div>
                        @endif

                        <div class="mt-3">
                            <a href="{{ route('qr_code', $stores->id) }}" class="btn btn-outline-primary">
                                <i class="fa fa-qrcode"></i> Generate QR Code
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="info-section">
                    <div class="info-section-header">
                        <i class="fa fa-lightning-bolt"></i>
                        Quick Actions
                    </div>
                    <div class="info-section-body">
                        <div class="quick-actions">
                            <a href="{{ route('store.edit', $stores->id) }}" class="action-btn btn-edit">
                                <i class="fa fa-edit"></i> Edit Asset
                            </a>
                            <a href="{{ route('qr_code_view', $stores->id) }}" class="action-btn btn-print">
                                <i class="fa fa-print"></i> Print Label
                            </a>
                            <a href="#" class="action-btn btn-email">
                                <i class="fa fa-envelope"></i> Email Details
                            </a>
                            <a href="#" class="action-btn btn-delete" onclick="return confirm('Are you sure?')">
                                <i class="fa fa-trash"></i> Delete Asset
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Maintenance Tab -->
        <div class="tab-pane fade" id="maintenance" role="tabpanel">
            <div class="info-card">
                <div class="info-card-header">
                    <h5><i class="fa fa-wrench"></i> Maintenance Records</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-section">
                                <div class="info-section-header">
                                    <i class="fa fa-calendar"></i>
                                    Last Maintenance
                                </div>
                                <div class="info-section-body">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle"></i>
                                        No maintenance records found for this asset.
                                    </div>
                                    <button class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Schedule Maintenance
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-section">
                                <div class="info-section-header">
                                    <i class="fa fa-chart-line"></i>
                                    Maintenance Stats
                                </div>
                                <div class="info-section-body">
                                    <div class="financial-summary">
                                        <div class="financial-item">
                                            <div class="financial-value">0</div>
                                            <div class="financial-label">Total Services</div>
                                        </div>
                                        <div class="financial-item">
                                            <div class="financial-value">$0</div>
                                            <div class="financial-label">Total Cost</div>
                                        </div>
                                        <div class="financial-item">
                                            <div class="financial-value">N/A</div>
                                            <div class="financial-label">Next Due</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Files Tab -->
        <div class="tab-pane fade" id="files" role="tabpanel">
            <div class="info-card">
                <div class="info-card-header">
                    <h5><i class="fa fa-file"></i> Asset Files & Documents</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="info-section">
                                <div class="info-section-header">
                                    <i class="fa fa-folder"></i>
                                    Uploaded Files
                                </div>
                                <div class="info-section-body">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle"></i>
                                        No files uploaded for this asset yet.
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#uploadsModal">
                                            <i class="fa fa-upload"></i> Upload Files
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-section">
                                <div class="info-section-header">
                                    <i class="fa fa-info"></i>
                                    File Types
                                </div>
                                <div class="info-section-body">
                                    <div class="list-group">
                                        <div class="list-group-item">
                                            <i class="fa fa-file-pdf text-danger"></i> Manuals
                                        </div>
                                        <div class="list-group-item">
                                            <i class="fa fa-file-text text-primary"></i> Warranties
                                        </div>
                                        <div class="list-group-item">
                                            <i class="fa fa-image text-success"></i> Photos
                                        </div>
                                        <div class="list-group-item">
                                            <i class="fa fa-file text-warning"></i> Receipts
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection