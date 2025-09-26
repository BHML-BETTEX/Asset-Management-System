@extends('master')
@section('content')

<style>
    /* Modern Store List Styling */
    .page-header {
        background: linear-gradient(135deg, #343a40 0%, #495057 100%);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .summary-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .summary-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .summary-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .summary-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--card-color);
    }

    .summary-card.total { --card-color: #007bff; }
    .summary-card.instock { --card-color: #28a745; }
    .summary-card.issued { --card-color: #ffc107; }
    .summary-card.maintenance { --card-color: #dc3545; }

    .summary-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: var(--card-color);
        margin: 0;
    }

    .summary-label {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .summary-icon {
        position: absolute;
        top: 1rem;
        right: 1rem;
        font-size: 2rem;
        color: var(--card-color);
        opacity: 0.3;
    }

    .filter-panel {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .filter-panel .card-header {
        background: transparent;
        border: none;
        padding: 0 0 1rem 0;
    }

    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .action-btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: none;
        color: white;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }

    .btn-add { background-color: #17a2b8; }
    .btn-issue { background-color: #28a745; }
    .btn-return { background-color: #ffc107; color: #212529; }
    .btn-transfer { background-color: #6f42c1; }
    .btn-maintenance { background-color: #fd7e14; }
    .btn-waste { background-color: #dc3545; }
    .btn-calculator { background-color: #6f42c1; }
    .btn-print { background-color: #28a745; }

    .btn-print:disabled {
        background-color: #6c757d;
        opacity: 0.6;
        cursor: not-allowed;
    }

    .smart-table {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
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
        letter-spacing: 0.5px;
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

    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
    }

    .status-instock { background-color: #d4edda; color: #155724; }
    .status-issued { background-color: #cce5ff; color: #004085; }
    .status-maintenance { background-color: #fff3cd; color: #856404; }

    .action-buttons-cell {
        display: flex;
        gap: 0.25rem;
    }

    .table-action-btn {
        background: none;
        border: none;
        padding: 0.25rem;
        border-radius: 5px;
        transition: all 0.3s ease;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .table-action-btn:hover {
        background-color: #f8f9fa;
        transform: translateY(-1px);
    }

    .asset-link {
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .asset-link:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .filter-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .advanced-filters {
        border-top: 1px solid #dee2e6;
        padding-top: 1rem;
        margin-top: 1rem;
    }

    .form-control-sm, .form-select-sm {
        border-radius: 8px;
        border: 1px solid #e1e5e9;
        transition: all 0.3s ease;
    }

    .form-control-sm:focus, .form-select-sm:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .asset-image {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid #e9ecef;
    }

    .export-section {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Modal Improvements */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
    }

    .modal-body {
        padding: 2rem;
    }

    /* Label Preview Styles */
    .label-preview {
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 20px;
        background-color: #f8f9fa;
    }

    .preview-label {
        border: 1px solid #ccc;
        background: white;
        font-family: Arial, sans-serif;
        margin: 0 auto;
        position: relative;
    }

    .small-label {
        width: 160px;
        height: 80px;
        padding: 4px;
        font-size: 8px;
    }

    .medium-label {
        width: 240px;
        height: 160px;
        padding: 8px;
        font-size: 10px;
    }

    .large-label {
        width: 320px;
        height: 240px;
        padding: 12px;
        font-size: 12px;
    }

    .label-header {
        text-align: center;
        border-bottom: 1px solid #ddd;
        padding-bottom: 4px;
        margin-bottom: 4px;
        font-weight: bold;
    }

    .label-content {
        flex: 1;
    }

    .asset-tag {
        font-weight: bold;
        font-size: 1.2em;
        margin-bottom: 4px;
    }

    .asset-info {
        line-height: 1.2;
        margin-bottom: 4px;
    }

    .label-codes {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 4px;
        border-top: 1px solid #ddd;
        padding-top: 4px;
    }

    .qr-placeholder, .barcode-placeholder {
        border: 1px solid #ccc;
        background: #f5f5f5;
        text-align: center;
        font-size: 8px;
        color: #666;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qr-placeholder {
        width: 30px;
        height: 30px;
    }

    .barcode-placeholder {
        height: 20px;
        flex: 1;
        margin-left: 5px;
        letter-spacing: 1px;
    }

    /* Selected Assets List */
    .selected-asset-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        margin-bottom: 5px;
        background-color: #f8f9fa;
    }

    .selected-asset-info {
        flex: 1;
    }

    .selected-asset-tag {
        font-weight: bold;
        color: #495057;
    }

    .selected-asset-details {
        font-size: 0.85rem;
        color: #6c757d;
    }

    .remove-asset-btn {
        color: #dc3545;
        background: none;
        border: none;
        cursor: pointer;
        padding: 2px 5px;
    }

    .remove-asset-btn:hover {
        color: #c82333;
        background-color: #fff5f5;
        border-radius: 3px;
    }

    /* Print Styles */
    @media print {
        body * {
            visibility: hidden;
        }

        .print-labels, .print-labels * {
            visibility: visible;
        }

        .print-labels {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .print-label {
            page-break-inside: avoid;
            border: 1px solid #000;
            margin: 5mm;
            padding: 2mm;
            font-family: Arial, sans-serif;
        }

        .print-label-small {
            width: 50mm;
            height: 25mm;
            font-size: 6px;
        }

        .print-label-medium {
            width: 76mm;
            height: 51mm;
            font-size: 8px;
        }

        .print-label-large {
            width: 101mm;
            height: 76mm;
            font-size: 10px;
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .page-header {
            padding: 1.5rem;
            text-align: center;
        }

        .action-buttons {
            justify-content: center;
            flex-direction: column;
        }

        .action-btn {
            width: 100%;
            justify-content: center;
            margin-bottom: 0.5rem;
        }

        .summary-cards {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

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

        .smart-table .table thead th,
        .smart-table .table tbody td {
            padding: 0.4rem 0.2rem;
            white-space: nowrap;
        }

        .action-buttons-cell {
            min-width: 120px;
        }

        .table-action-btn {
            width: 28px;
            height: 28px;
            font-size: 0.7rem;
        }
    }

    @media (max-width: 576px) {
        .summary-cards {
            grid-template-columns: 1fr;
        }

        .page-header h1 {
            font-size: 1.5rem;
        }

        .filter-panel {
            padding: 1rem;
        }
    }

    /* Column Selector Styles */
    #columnDropdownMenu {
        min-width: 280px;
        max-height: 400px;
        overflow-y: auto;
        padding: 0.5rem;
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

    .column-checkbox-item input[type="checkbox"] {
        margin-right: 0.5rem;
    }

    .column-checkbox-item label {
        margin-bottom: 0;
        cursor: pointer;
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

    /* Prevent dropdown from closing when clicking inside */
    #columnDropdownMenu {
        pointer-events: auto;
    }

    .dropdown-item {
        padding: 0;
    }

    .dropdown-item:hover {
        background-color: transparent;
    }
</style>

<div class="container-fluid">
    <!-- Page Header -->


    <!-- Summary Dashboard -->
    <div class="summary-cards" style="display: none;">
        <div class="summary-card total">
            <div class="summary-icon">
                <i class="fa fa-cube"></i>
            </div>
            <div class="summary-label">Total Assets</div>
            <h2 class="summary-number">{{ $stores->total() ?? $stores->count() }}</h2>
            <small class="text-muted">All registered assets</small>
        </div>
        <div class="summary-card instock">
            <div class="summary-icon">
                <i class="fa fa-check-circle"></i>
            </div>
            <div class="summary-label">In Stock</div>
            <h2 class="summary-number">{{ $stores->where('checkstatus', 'INSTOCK')->count() }}</h2>
            <small class="text-muted">Available for assignment</small>
        </div>
        <div class="summary-card issued">
            <div class="summary-icon">
                <i class="fa fa-user"></i>
            </div>
            <div class="summary-label">Issued</div>
            <h2 class="summary-number">{{ $stores->where('checkstatus','<>', 'INSTOCK')->count() }}</h2>
            <small class="text-muted">Currently assigned</small>
        </div>
        <div class="summary-card maintenance">
            <div class="summary-icon">
                <i class="fa fa-wrench"></i>
            </div>
            <div class="summary-label">Maintenance</div>
            <h2 class="summary-number">{{ $stores->where('checkstatus', 'MAINTENANCE')->count() }}</h2>
            <small class="text-muted">Under maintenance</small>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="filter-panel">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fa fa-cogs me-2"></i>Quick Actions
            </h5>
        </div>
        <div class="action-buttons">
            <a href="{{ route('add_product') }}" class="action-btn btn-add">
                <i class="fa fa-plus"></i> Add Asset
            </a>
            <!-- <a href="{{ route('issue') }}" class="action-btn btn-issue">
                <i class="fa fa-mail-forward"></i> Issue Asset
            </a>
            <a href="{{ route('return') }}" class="action-btn btn-return">
                <i class="fa fa-mail-reply"></i> Return Asset
            </a> -->
            <!-- <a href="{{ route('transfer') }}" class="action-btn btn-transfer">
                <i class="fa fa-send"></i> Transfer Asset
            </a>
            <a href="{{ route('maintenance') }}" class="action-btn btn-maintenance">
                <i class="fa fa-gears"></i> Maintenance
            </a>
            <a href="{{ route('wastproduct') }}" class="action-btn btn-waste">
                <i class="fa fa-trash"></i> Waste Management
            </a> -->
            <button class="action-btn btn-calculator" data-toggle="modal" data-target="#depreciationModal">
                <i class="fa fa-calculator"></i> Depreciation Calculator
            </button>
            <button class="action-btn btn-print" id="bulkPrintBtn" data-toggle="modal" data-target="#bulkLabelModal" disabled>
                <i class="fa fa-print"></i> Print Labels (<span id="selectedCount">0</span>)
            </button>

                        <div class="col-md-6 text-md-end">
                <div class="export-section">
                    <form action="{{ route('store_export') }}" method="GET" class="d-flex align-items-center gap-2">
                        @foreach ($_GET as $key=> $item)
                        <input type="hidden" name="{{$key}}" value="{{$item}}">
                        @endforeach
                        <select name="type" class="form-select form-select-sm" style="width: auto;">
                            <option value="">Export Format</option>
                            <option value="xlsx">Excel (XLSX)</option>
                            <option value="csv">CSV</option>
                            <option value="xls">Excel (XLS)</option>
                        </select>
                        <button type="submit" class="btn btn-light btn-sm">
                            <i class="fa fa-download"></i> Export
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="card-header">
            <h6 class="mb-0">
                <i class="fa fa-filter me-2"></i>Filter & Search
            </h6>
        </div>
        <form action="" method="GET" id="filterForm">
            <div class="filter-row">
                <div>
                    <label class="form-label">Search Assets</label>
                    <input type="search" class="form-control form-control-sm" name="search"
                           placeholder="Search by asset tag, model, brand..."
                           value="{{ request('search') }}">
                </div>
                <div>
                    <label class="form-label">Asset Type</label>
                    <select name="product_search" class="form-select form-select-sm">
                        <option value="">All Types</option>
                        @foreach ($all_product_types as $product_type)
                        <option value="{{ $product_type->id }}"
                                {{ request('product_search') == $product_type->id ? 'selected' : '' }}>
                            {{ $product_type->product }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Status</label>
                    <select name="status_filter" class="form-select form-select-sm">
                        <option value="">All Status</option>
                        <option value="INSTOCK" {{ request('status_filter') == 'INSTOCK' ? 'selected' : '' }}>In Stock</option>
                        <option value="ISSUED" {{ request('status_filter') == 'ISSUED' ? 'selected' : '' }}>Issued</option>
                        <option value="MAINTENANCE" {{ request('status_filter') == 'MAINTENANCE' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>
                <div>
                    <label class="form-label">Company</label>
                    <select name="company_filter" class="form-select form-select-sm">
                        <option value="">All Companies</option>
                        @if(isset($companies))
                            @foreach ($companies as $company)
                            <option value="{{ $company->id }}"
                                    {{ request('company_filter') == $company->id ? 'selected' : '' }}>
                                {{ $company->company }}
                            </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <!-- Advanced Filters Toggle -->
            <div class="row mt-3">
                <div class="col-12">
                    <button type="button" class="btn btn-link btn-sm p-0" data-bs-toggle="collapse"
                            data-bs-target="#advancedFilters" aria-expanded="false">
                        <i class="fa fa-cog"></i> Advanced Filters
                    </button>
                </div>
            </div>

            <!-- Advanced Filters -->
            <div class="collapse advanced-filters" id="advancedFilters">
                <div class="filter-row">
                    <div>
                        <label class="form-label">Purchase Date From</label>
                        <input type="date" class="form-control form-control-sm" name="date_from"
                               value="{{ request('date_from') }}">
                    </div>
                    <div>
                        <label class="form-label">Purchase Date To</label>
                        <input type="date" class="form-control form-control-sm" name="date_to"
                               value="{{ request('date_to') }}">
                    </div>
                    <div>
                        <label class="form-label">Cost Range (Min)</label>
                        <input type="number" class="form-control form-control-sm" name="cost_min"
                               placeholder="Min cost" value="{{ request('cost_min') }}">
                    </div>
                    <div>
                        <label class="form-label">Cost Range (Max)</label>
                        <input type="number" class="form-control form-control-sm" name="cost_max"
                               placeholder="Max cost" value="{{ request('cost_max') }}">
                    </div>
                </div>
            </div>

            <!-- Filter Actions -->
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-search"></i> Apply Filters
                </button>
                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="clearFilters()">
                    <i class="fa fa-refresh"></i> Clear All
                </button>
            </div>
        </form>
    </div>

    <!-- Column Selector -->
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <h6 class="mb-0">
                        <i class="fa fa-columns me-2"></i>Column Visibility
                    </h6>
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="showAllColumns()">
                            <i class="fa fa-eye"></i> Show All
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="hideAllColumns()">
                            <i class="fa fa-eye-slash"></i> Hide All
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="resetToDefault()">
                            <i class="fa fa-refresh"></i> Reset Default
                        </button>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="columnDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-list"></i> Select Columns
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="columnDropdown" id="columnDropdownMenu">
                        <!-- Column checkboxes will be generated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Assets Table -->
    <div class="smart-table">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th data-column="checkbox" data-essential="true">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="selectAll">
                                <label class="form-check-label" for="selectAll"></label>
                            </div>
                        </th>
                        <th data-column="sl" data-essential="true">SL</th>
                        <th data-column="status" data-essential="true">STATUS</th>
                        <th data-column="action" data-essential="true">ACTION</th>
                        <th data-column="checkstatus">CHECKSTATUS</th>
                        <th data-column="asset_tag" data-essential="true">ASSET TAG</th>
                        <th data-column="asset_type" data-essential="true">ASSET TYPE</th>
                        <th data-column="model">MODEL</th>
                        <th data-column="brand">BRAND</th>
                        <th data-column="description">DESCRIPTION</th>
                        <th data-column="asset_sl_no">ASSET SL No</th>
                        <th data-column="qty">QTY</th>
                        <th data-column="units">UNITS</th>
                        <th data-column="warranty">WARRENTY</th>
                        <th data-column="durability">DURABLITY</th>
                        <th data-column="cost">COST</th>
                        <th data-column="currency">CURRENCY</th>
                        <th data-column="vendor">VENDOR</th>
                        <th data-column="purchase_date">PURCHASE DATE</th>
                        <th data-column="challan_no">CHALLAN NO</th>
                        <th data-column="status_name">STATUS NAME</th>
                        <th data-column="company">COMPANY</th>
                        <th data-column="others">OTHERS</th>
                        <th data-column="balance">Balance</th>
                        <th data-column="picture">PICTURE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stores as $key => $store)
                    <tr>
                        <td data-column="checkbox">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input asset-checkbox"
                                       data-asset-id="{{ $store->id }}"
                                       data-asset-tag="{{ e($store->products_id) }}"
                                       data-asset-type="{{ e($store->rel_to_ProductType->product ?? 'N/A') }}"
                                       data-model="{{ e($store->model ?? '') }}"
                                       data-brand="{{ e($store->rel_to_brand->brand ?? 'N/A') }}"
                                       data-company="{{ e($store->rel_to_company->company ?? 'N/A') }}">
                            </div>
                        </td>
                        <td data-column="sl">{{ $key +1 }}</td>
                        <td data-column="status" id="action-btn-{{ $store->id }}">
                            @if($store->checkstatus === 'INSTOCK')
                            <button class="btn btn-outline-success btn-sm issue-btn"
                                    data-toggle="modal"
                                    data-target="#issueModal"
                                    data-id="{{ $store->id }}"
                                    data-asset-tag="{{ e($store->products_id) }}"
                                    data-asset-type="{{ e($store->rel_to_ProductType->product ?? '') }}"
                                    data-model="{{ e($store->model ?? '') }}"
                                    data-company="{{ e($store->rel_to_Company->company ?? '') }}">
                                INSTOCK
                            </button>
                            @else
                            <button class="btn btn-outline-primary btn-sm return-btn"
                                    data-toggle="modal"
                                    data-target="#returnModal"
                                    data-id="{{ $store->id }}"
                                    data-asset-tag="{{ $store->products_id }}"
                                    data-asset-type="{{ $store->rel_to_ProductType->product}}"
                                    data-model="{{ $store->model }}">
                                ISSUED
                            </button>
                            @endif
                        </td>
                        <td data-column="action" class="action-buttons-cell">
                            <a href="{{ route('store.edit', $store->id) }}"
                               class="table-action-btn text-primary"
                               title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>

                            <a href="{{ route('qr_code_view', $store->id) }}"
                               class="table-action-btn text-success"
                               title="View">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="{{route('qr_code', $store->id)}}"
                               class="table-action-btn text-info"
                               title="QR Code">
                                <i class="fa fa-qrcode"></i>
                            </a>

                            <button class="table-action-btn text-info clone-btn"
                                    data-toggle="modal"
                                    data-target="#cloneModal"
                                    data-id="{{ $store->id }}"
                                    data-asset-tag="{{ e($store->products_id ?? '') }}"
                                    data-asset-type="{{ e($store->rel_to_ProductType->product ?? '') }}"
                                    data-product-type-id="{{ $store->rel_to_ProductType->id ?? '' }}"
                                    data-model="{{ e($store->model ?? '') }}"
                                    data-brand="{{ e($store->rel_to_brand->brand_name ?? '') }}"
                                    data-brand-id="{{ $store->rel_to_brand->id ?? '' }}"
                                    data-description="{{ e($store->description ?? '') }}"
                                    data-asset-sl-no="{{ e($store->asset_sl_no ?? '') }}"
                                    data-qty="{{ e($store->qty ?? '1') }}"
                                    data-units="{{ e($store->rel_to_SizeMaseurment->size ?? '') }}"
                                    data-units-id="{{ $store->rel_to_SizeMaseurment->id ?? '' }}"
                                    data-warranty="{{ e($store->warrenty ?? '') }}"
                                    data-durability="{{ e($store->durablity ?? '') }}"
                                    data-cost="{{ e($store->cost ?? '') }}"
                                    data-currency="{{ e($store->currency ?? 'USD') }}"
                                    data-vendor="{{ e($store->rel_to_Supplier->supplier_name ?? '') }}"
                                    data-vendor-id="{{ $store->rel_to_Supplier->id ?? '' }}"
                                    data-purchase-date="{{ e($store->purchase_date ?? '') }}"
                                    data-challan-no="{{ e($store->challan_no ?? '') }}"
                                    data-status="{{ e($store->rel_to_Status->status_name ?? '') }}"
                                    data-status-id="{{ $store->rel_to_Status->id ?? '' }}"
                                    data-company="{{ e($store->rel_to_Company->company ?? '') }}"
                                    data-company-id="{{ $store->rel_to_Company->id ?? '' }}"
                                    data-others="{{ e($store->others ?? '') }}"
                                    title="Clone Asset">
                                <i class="fa fa-copy"></i>
                            </button>
                        </td>
                        <td data-column="checkstatus" style="background-color: #feefe6;">
                            @if($store->checkstatus == "INSTOCK")
                            <span class="badge bg-success text-white">{{ $store->checkstatus }}</span>
                            @elseif($store->checkstatus == "MAINTENANCE")
                            <span class="badge bg-warning text-white">{{ $store->checkstatus }}</span>
                            @else
                            <span class="badge bg-primary text-white">{{ $store->checkstatus }}</span>
                            @endif
                        </td>
                        <td data-column="asset_tag"><a href="{{ route('store_info', $store->id) }}">{{ $store->products_id }}</a></td>
                        <td data-column="asset_type">{{ $store->rel_to_ProductType->product }}</td>
                        <td data-column="model">{{ $store->model }}</td>
                        <td data-column="brand">{{ $store->rel_to_brand->brand_name }}</td>
                        <td data-column="description">{{ $store->description }}</td>
                        <td data-column="asset_sl_no">{{ $store->asset_sl_no }}</td>
                        <td data-column="qty">{{ $store->qty }}</td>
                        <td data-column="units">{{ $store->rel_to_SizeMaseurment->size }}</td>
                        <td data-column="warranty">{{ $store->warrenty }}</td>
                        <td data-column="durability">{{ $store->durablity }}</td>
                        <td data-column="cost">{{ $store->cost }}</td>
                        <td data-column="currency">{{ $store->currency }}</td>
                        <td data-column="vendor">{{ $store->rel_to_Supplier->supplier_name }}</td>
                        <td data-column="purchase_date">{{ $store->purchase_date }}</td>
                        <td data-column="challan_no">{{ $store->challan_no }}</td>
                        <td data-column="status_name">{{ $store->rel_to_Status->status_name }}</td>
                        <td data-column="company">{{ $store->rel_to_Company->company }}</td>
                        <td data-column="others">{{ $store->others }}</td>
                        <td data-column="balance"></td>
                        <td data-column="picture"><img width="40" height="15"
                                src="{{ asset('/uploads/store/' . $store->picture) }}"
                                alt="picture">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center p-3 border-top">
            <div class="d-flex align-items-center">
                @if ($stores instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <span class="text-muted me-3">
                    Showing {{ $stores->firstItem() }} to {{ $stores->lastItem() }} of {{ $stores->total() }} assets
                </span>
                @else
                <span class="text-muted me-3">Showing all {{ $stores->count() }} assets</span>
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

            @if ($stores instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="pagination-wrapper">
                {{ $stores->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Issue Modal -->
<div class="modal fade" id="issueModal" tabindex="-1" aria-labelledby="issueModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="issueModalLabel">
                    <i class="fa fa-mail-forward me-2"></i>Issue Asset
                </h5>
                <button type="button" class="close btn border-0 bg-transparent text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('issue.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="issue_id" name="store_id" value="">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Asset Tag</label>
                            <input type="text" id="asset_tag" class="form-control" name="asset_tag" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Asset Type</label>
                            <input type="text" id="asset_type" class="form-control" name="asset_type" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Model</label>
                            <input type="text" id="model" class="form-control" name="model" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Company</label>
                            <input type="text" id="company" class="form-control" name="others" readonly>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Select Employee</label>
                            <select id="empl_id" name="emp_id" class="form-control select2">
                                <option value="" selected disabled>-- Select Employee --</option>
                                @foreach ($employee as $emp)
                                <option value="{{ $emp->emp_id }}" data-emp_id="{{ $emp->id }}">
                                    {{ $emp->emp_id }} - {{ $emp->emp_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Employee Name</label>
                            <input type="text" id="emp_name" class="form-control" name="emp_name" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Designation</label>
                            <input type="text" id="designation_id" class="form-control" name="designation_id" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Department</label>
                            <input type="text" id="department_id" class="form-control" name="department_id" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Issue Date</label>
                            <input type="date" id="issue_date" class="form-control" name="issue_date" required>
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fa fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-check me-2"></i>Issue Asset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Return Modal -->
<div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="returnModalLabel">
                    <i class="fa fa-mail-reply me-2"></i>Return Asset
                </h5>
                <button type="button" class="close btn border-0 bg-transparent text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('return_update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Asset Tag</label>
                            <input type="text" id="return_asset_tag" class="form-control" name="asset_tag" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Asset Type</label>
                            <input type="text" id="return_asset_type" class="form-control" name="asset_type" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Model</label>
                            <input type="text" id="return_model" class="form-control" name="model" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Return Date</label>
                            <input type="date" class="form-control" name="return_date" required>
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fa fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-warning">
                            <i class="fa fa-check me-2"></i>Return Asset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Clone Modal -->
<div class="modal fade" id="cloneModal" tabindex="-1" aria-labelledby="cloneModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);">
                <h5 class="modal-title text-white" id="cloneModalLabel">
                    <i class="fa fa-copy me-2"></i>Clone Asset
                </h5>
                <button type="button" class="close btn border-0 bg-transparent text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle me-2"></i>
                    <strong>Clone Asset:</strong> This will create a new asset with the same details. You can modify any field before saving.
                </div>

                <form action="{{ route('store.store') }}" method="POST" enctype="multipart/form-data" id="cloneForm">
                    @csrf
                    <div class="row g-3">
                        <!-- Asset Tag -->
                        <div class="col-md-4">
                            <label class="form-label">Asset Tag <span class="text-danger">*</span></label>
                            <input type="text" id="clone_asset_tag" class="form-control" name="products_id" required>
                            <small class="text-muted">Must be unique</small>
                        </div>

                        <!-- Asset Type -->
                        <div class="col-md-4">
                            <label class="form-label">Asset Type <span class="text-danger">*</span></label>
                            <select id="clone_product_type" class="form-control" name="product_type_id" required>
                                <option value="">Select Asset Type</option>
                                @foreach ($all_product_types as $product_type)
                                <option value="{{ $product_type->id }}">{{ $product_type->product }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Model -->
                        <div class="col-md-4">
                            <label class="form-label">Model</label>
                            <input type="text" id="clone_model" class="form-control" name="model">
                        </div>

                        <!-- Brand -->
                        <div class="col-md-4">
                            <label class="form-label">Brand</label>
                            <select id="clone_brand" class="form-control" name="brand_id">
                                <option value="">Select Brand</option>
                                @if(isset($brands))
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Serial Number -->
                        <div class="col-md-4">
                            <label class="form-label">Serial Number</label>
                            <input type="text" id="clone_serial" class="form-control" name="asset_sl_no">
                        </div>

                        <!-- Quantity -->
                        <div class="col-md-4">
                            <label class="form-label">Quantity</label>
                            <input type="number" id="clone_qty" class="form-control" name="qty" min="1" value="1">
                        </div>

                        <!-- Units -->
                        <div class="col-md-4">
                            <label class="form-label">Units</label>
                            <select id="clone_units" class="form-control" name="units">
                                <option value="">Select Units</option>
                                @if(isset($units))
                                    @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->size }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Warranty -->
                        <div class="col-md-4">
                            <label class="form-label">Warranty Period</label>
                            <input type="text" id="clone_warranty" class="form-control" name="warrenty" placeholder="e.g., 2 years">
                        </div>

                        <!-- Durability -->
                        <div class="col-md-4">
                            <label class="form-label">Durability</label>
                            <input type="text" id="clone_durability" class="form-control" name="durablity" placeholder="e.g., 5 years">
                        </div>

                        <!-- Cost -->
                        <div class="col-md-4">
                            <label class="form-label">Cost</label>
                            <div class="input-group">
                                <select id="clone_currency" class="form-control" name="currency" style="max-width: 80px;">
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="BDT">BDT</option>
                                    <option value="GBP">GBP</option>
                                </select>
                                <input type="number" id="clone_cost" class="form-control" name="cost" step="0.01" min="0">
                            </div>
                        </div>

                        <!-- Vendor -->
                        <div class="col-md-4">
                            <label class="form-label">Vendor/Supplier</label>
                            <select id="clone_vendor" class="form-control" name="supplier_id">
                                <option value="">Select Vendor</option>
                                @if(isset($suppliers))
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Purchase Date -->
                        <div class="col-md-4">
                            <label class="form-label">Purchase Date</label>
                            <input type="date" id="clone_purchase_date" class="form-control" name="purchase_date">
                        </div>

                        <!-- Challan Number -->
                        <div class="col-md-4">
                            <label class="form-label">Challan Number</label>
                            <input type="text" id="clone_challan" class="form-control" name="challan_no">
                        </div>

                        <!-- Status -->
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select id="clone_status" class="form-control" name="status_id">
                                <option value="">Select Status</option>
                                @if(isset($statuses))
                                    @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Company -->
                        <div class="col-md-4">
                            <label class="form-label">Company <span class="text-danger">*</span></label>
                            <select id="clone_company" class="form-control" name="company_id" required>
                                <option value="">Select Company</option>
                                @if(isset($companies))
                                    @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->company }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea id="clone_description" class="form-control" name="description" rows="3"></textarea>
                        </div>

                        <!-- Others -->
                        <div class="col-md-12">
                            <label class="form-label">Additional Notes</label>
                            <textarea id="clone_others" class="form-control" name="others" rows="2"></textarea>
                        </div>

                        <!-- Picture Upload -->
                        <div class="col-md-12">
                            <label class="form-label">Asset Picture</label>
                            <input type="file" class="form-control" name="picture" accept="image/*">
                            <small class="text-muted">Upload a new picture for the cloned asset (optional)</small>
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fa fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-info">
                            <i class="fa fa-copy me-2"></i>Clone Asset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Depreciation Calculator Modal -->
<div class="modal fade" id="depreciationModal" tabindex="-1" aria-labelledby="depreciationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #6f42c1 0%, #5a359a 100%);">
                <h5 class="modal-title text-white" id="depreciationModalLabel">
                    <i class="fa fa-calculator me-2"></i>Asset Depreciation Calculator
                </h5>
                <button type="button" class="close btn border-0 bg-transparent text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle me-2"></i>
                    <strong>Depreciation Calculator:</strong> Calculate asset depreciation using different methods. Select an asset from the table or enter custom values.
                </div>

                <div class="row">
                    <!-- Asset Selection -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fa fa-cubes me-2"></i>Asset Selection</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Select Asset</label>
                                    <select id="depreciation_asset" class="form-control">
                                        <option value="">Select an Asset</option>
                                        @foreach ($stores as $asset)
                                        <option value="{{ $asset->id }}"
                                                data-tag="{{ $asset->products_id }}"
                                                data-cost="{{ $asset->cost ?? 0 }}"
                                                data-purchase-date="{{ $asset->purchase_date }}"
                                                data-type="{{ $asset->rel_to_ProductType->product ?? '' }}">
                                            {{ $asset->products_id }} - {{ $asset->rel_to_ProductType->product ?? 'N/A' }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Asset Tag</label>
                                    <input type="text" id="dep_asset_tag" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Asset Type</label>
                                    <input type="text" id="dep_asset_type" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Calculation Parameters -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fa fa-cogs me-2"></i>Calculation Parameters</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Original Cost <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" id="dep_original_cost" class="form-control" step="0.01" min="0" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Salvage Value</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" id="dep_salvage_value" class="form-control" step="0.01" min="0" value="0">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Useful Life <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" id="dep_useful_life" class="form-control" min="1" required>
                                        <span class="input-group-text">years</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Purchase Date</label>
                                    <input type="date" id="dep_purchase_date" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Depreciation Method</label>
                                    <select id="dep_method" class="form-control">
                                        <option value="straight_line">Straight Line</option>
                                        <option value="declining_balance">Declining Balance</option>
                                        <option value="double_declining">Double Declining Balance</option>
                                        <option value="sum_of_years">Sum of Years' Digits</option>
                                    </select>
                                </div>

                                <div class="mb-3" id="dep_rate_container" style="display: none;">
                                    <label class="form-label">Depreciation Rate (%)</label>
                                    <input type="number" id="dep_rate" class="form-control" step="0.01" min="0" max="100">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Results -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fa fa-chart-line me-2"></i>Depreciation Results</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Current Age</label>
                                    <div class="input-group">
                                        <input type="text" id="dep_current_age" class="form-control" readonly>
                                        <span class="input-group-text">years</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Total Depreciation</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="text" id="dep_total_depreciation" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Current Book Value</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="text" id="dep_book_value" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Annual Depreciation</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="text" id="dep_annual_depreciation" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Depreciation Rate</label>
                                    <div class="input-group">
                                        <input type="text" id="dep_percentage" class="form-control" readonly>
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary w-100" onclick="calculateDepreciation()">
                                    <i class="fa fa-calculator me-2"></i>Calculate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Depreciation Schedule Table -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fa fa-table me-2"></i>Depreciation Schedule</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped" id="depreciation_schedule">
                                        <thead class="bg-secondary text-white">
                                            <tr>
                                                <th>Year</th>
                                                <th>Beginning Value</th>
                                                <th>Depreciation</th>
                                                <th>Accumulated Depreciation</th>
                                                <th>Ending Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">
                                                    <i class="fa fa-info-circle"></i> Enter parameters and click Calculate to see depreciation schedule
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times me-2"></i>Close
                </button>
                <button type="button" class="btn btn-success" onclick="exportDepreciationSchedule()">
                    <i class="fa fa-download me-2"></i>Export Schedule
                </button>
                <button type="button" class="btn btn-info" onclick="resetCalculator()">
                    <i class="fa fa-refresh me-2"></i>Reset
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Label Print Modal -->
<div class="modal fade" id="bulkLabelModal" tabindex="-1" aria-labelledby="bulkLabelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                <h5 class="modal-title text-white" id="bulkLabelModalLabel">
                    <i class="fa fa-print me-2"></i>Bulk Label Print
                </h5>
                <button type="button" class="close btn border-0 bg-transparent text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle me-2"></i>
                    <strong>Selected Assets:</strong> You have selected <span id="modalSelectedCount">0</span> assets for label printing.
                </div>

                <!-- Label Configuration -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fa fa-cog me-2"></i>Print Settings</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Label Size</label>
                                    <select class="form-control" id="labelSize">
                                        <option value="small">Small (2" x 1")</option>
                                        <option value="medium" selected>Medium (3" x 2")</option>
                                        <option value="large">Large (4" x 3")</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Copies per Asset</label>
                                    <input type="number" class="form-control" id="copiesCount" value="1" min="1" max="10">
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="includeQR" checked>
                                        <label class="form-check-label" for="includeQR">Include QR Code</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="includeBarcode" checked>
                                        <label class="form-check-label" for="includeBarcode">Include Barcode</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Additional Text</label>
                                    <textarea class="form-control" id="additionalText" rows="2" placeholder="Optional additional text for labels"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fa fa-eye me-2"></i>Label Preview</h6>
                            </div>
                            <div class="card-body text-center">
                                <div class="label-preview" id="labelPreview">
                                    <div class="preview-label medium-label">
                                        <div class="label-header">
                                            <strong>SAMPLE ASSET</strong>
                                        </div>
                                        <div class="label-content">
                                            <div class="asset-tag">AST-001</div>
                                            <div class="asset-info">
                                                <small>Type: Laptop</small><br>
                                                <small>Brand: Dell</small>
                                            </div>
                                        </div>
                                        <div class="label-codes">
                                            <div class="qr-placeholder">QR</div>
                                            <div class="barcode-placeholder">|||||||||||</div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted mt-2">
                                    <small>This is how your labels will appear</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Selected Assets List -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fa fa-list me-2"></i>Selected Assets</h6>
                            </div>
                            <div class="card-body">
                                <div class="selected-assets-list" id="selectedAssetsList">
                                    <div class="text-muted text-center">
                                        <i class="fa fa-info-circle"></i> No assets selected
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times me-2"></i>Cancel
                </button>
                <button type="button" class="btn btn-info" onclick="previewLabels()">
                    <i class="fa fa-eye me-2"></i>Preview All
                </button>
                <button type="button" class="btn btn-success" onclick="printLabels()">
                    <i class="fa fa-print me-2"></i>Print Labels
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
$(document).ready(function() {
    // Initialize Select2
    $('#product_search').select2({
        placeholder: "All Types",
        allowClear: true
    });

    $('#empl_id').select2({
        placeholder: "Select an Employee",
        allowClear: true,
        width: '100%',
        dropdownParent: $('#issueModal')
    });

    // Issue modal data population
    $('.issue-btn').on('click', function() {
        const ds = this.dataset;
        $('#issue_id').val(ds.id);
        $('#asset_tag').val(ds.assetTag);
        $('#asset_type').val(ds.assetType);
        $('#model').val(ds.model);
        $('#company').val(ds.company);
    });

    // Return modal data population
    $('.return-btn').on('click', function() {
        const ds = this.dataset;
        $('#return_asset_tag').val(ds.assetTag);
        $('#return_asset_type').val(ds.assetType);
        $('#return_model').val(ds.model);
    });

    // Employee selection handler
    $('#empl_id').on('change', function() {
        let empl_id = $('#empl_id option:selected').data("emp_id");
        if (empl_id) {
            $.ajax({
                url: "{{ route('search.empl', '') }}/" + empl_id,
                success: function(result) {
                    $('#emp_name').val(result.data.emp_name);
                    $('#designation_id').val(result.data.designation_id);
                    $('#department_id').val(result.data.department_id);
                    $('#phone_number').val(result.data.phone_number);
                    $('#email').val(result.data.email);
                }
            });
        }
    });

    // Clone modal data population using event delegation
    $(document).on('click', '.clone-btn', function(e) {
        e.preventDefault();
        console.log('Clone button clicked'); // Debug log

        const btn = this;

        // Log all data attributes to debug
        console.log('All data attributes:', btn.dataset);

        // Get data attributes using getAttribute (most reliable method)
        const originalTag = btn.getAttribute('data-asset-tag') || '';
        const productTypeId = btn.getAttribute('data-product-type-id') || '';
        const model = btn.getAttribute('data-model') || '';
        const brandId = btn.getAttribute('data-brand-id') || '';
        const qty = btn.getAttribute('data-qty') || '1';
        const unitsId = btn.getAttribute('data-units-id') || '';
        const warranty = btn.getAttribute('data-warranty') || '';
        const durability = btn.getAttribute('data-durability') || '';
        const cost = btn.getAttribute('data-cost') || '';
        const currency = btn.getAttribute('data-currency') || 'USD';
        const vendorId = btn.getAttribute('data-vendor-id') || '';
        const statusId = btn.getAttribute('data-status-id') || '';
        const companyId = btn.getAttribute('data-company-id') || '';
        const description = btn.getAttribute('data-description') || '';
        const others = btn.getAttribute('data-others') || '';

        console.log('Extracted data:');
        console.log('- Original Tag:', originalTag);
        console.log('- Product Type ID:', productTypeId);
        console.log('- Model:', model);
        console.log('- Brand ID:', brandId);
        console.log('- Company ID:', companyId);

        // Generate new asset tag based on original
        const timestamp = Date.now().toString().slice(-4);
        const newTag = originalTag ? originalTag + '_COPY_' + timestamp : 'CLONE_' + timestamp;

        // Populate form fields immediately (no delay)
        console.log('Populating form fields...');

        // Basic text inputs
        $('#clone_asset_tag').val(newTag);
        $('#clone_model').val(model);
        $('#clone_serial').val(''); // Clear for uniqueness
        $('#clone_qty').val(qty);
        $('#clone_warranty').val(warranty);
        $('#clone_durability').val(durability);
        $('#clone_cost').val(cost);
        $('#clone_currency').val(currency);
        $('#clone_purchase_date').val(''); // Clear for new entry
        $('#clone_challan').val(''); // Clear for uniqueness
        $('#clone_description').val(description);
        $('#clone_others').val(others);

        // Select dropdowns (without Select2 for now)
        $('#clone_product_type').val(productTypeId);
        $('#clone_brand').val(brandId);
        $('#clone_units').val(unitsId);
        $('#clone_vendor').val(vendorId);
        $('#clone_status').val(statusId);
        $('#clone_company').val(companyId);

        console.log('Form fields populated');
        console.log('Asset tag field value:', $('#clone_asset_tag').val());
        console.log('Model field value:', $('#clone_model').val());
        console.log('Product type field value:', $('#clone_product_type').val());

        // Add clone notification
        const notification = `<div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
            <i class="fa fa-info-circle me-2"></i>
            <strong>Cloning:</strong> Asset Tag and Serial Number have been cleared/modified for uniqueness.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>`;

        // Remove any existing notifications and add new one
        $('#cloneModal .alert-warning').remove();
        $('#cloneModal .alert-info').after(notification);

        console.log('Data populated successfully'); // Debug log
    });

    // Initialize Select2 for clone modal (simple initialization)
    try {
        $('#clone_product_type, #clone_brand, #clone_units, #clone_vendor, #clone_status, #clone_company').select2({
            width: '100%',
            placeholder: 'Select an option'
        });
    } catch (e) {
        console.log('Select2 initialization skipped:', e);
    }

    // Auto-generate asset tag suggestion
    $('#clone_asset_tag').on('blur', function() {
        const value = $(this).val();
        if (value && !value.includes('_COPY_')) {
            $(this).val(value + '_COPY');
        }
    });

    // Form validation before submit
    $('#cloneForm').on('submit', function(e) {
        const assetTag = $('#clone_asset_tag').val().trim();
        const productType = $('#clone_product_type').val();
        const company = $('#clone_company').val();

        if (!assetTag) {
            e.preventDefault();
            alert('Asset Tag is required!');
            $('#clone_asset_tag').focus();
            return false;
        }

        if (!productType) {
            e.preventDefault();
            alert('Asset Type is required!');
            $('#clone_product_type').focus();
            return false;
        }

        if (!company) {
            e.preventDefault();
            alert('Company is required!');
            $('#clone_company').focus();
            return false;
        }

        // Show loading state
        $(this).find('button[type="submit"]').html('<i class="fa fa-spinner fa-spin me-2"></i>Cloning Asset...').prop('disabled', true);
    });

    // Initialize Select2 for depreciation asset dropdown
    try {
        $('#depreciation_asset').select2({
            placeholder: 'Select an Asset',
            allowClear: true,
            width: '100%'
        });
    } catch (e) {
        console.log('Select2 for depreciation asset skipped:', e);
    }

    // Asset selection handler
    $('#depreciation_asset').on('change', function() {
        const selectedOption = $(this).find('option:selected');
        const assetTag = selectedOption.data('tag') || '';
        const cost = selectedOption.data('cost') || 0;
        const purchaseDate = selectedOption.data('purchase-date') || '';
        const assetType = selectedOption.data('type') || '';

        // Populate asset information fields
        $('#dep_asset_tag').val(assetTag);
        $('#dep_asset_type').val(assetType);
        $('#dep_original_cost').val(cost);
        $('#dep_purchase_date').val(purchaseDate);

        // Calculate current age if purchase date is available
        if (purchaseDate) {
            const purchase = new Date(purchaseDate);
            const today = new Date();
            const ageInYears = ((today - purchase) / (1000 * 60 * 60 * 24 * 365)).toFixed(1);
            $('#dep_current_age').val(ageInYears);
        }
    });

    // Show/hide depreciation rate field based on method
    $('#dep_method').on('change', function() {
        const method = $(this).val();
        if (method === 'declining_balance') {
            $('#dep_rate_container').show();
            $('#dep_rate').val(25); // Default 25% rate
        } else {
            $('#dep_rate_container').hide();
        }
    });

    // Auto-calculate current age when purchase date changes
    $('#dep_purchase_date').on('change', function() {
        const purchaseDate = $(this).val();
        if (purchaseDate) {
            const purchase = new Date(purchaseDate);
            const today = new Date();
            const ageInYears = ((today - purchase) / (1000 * 60 * 60 * 24 * 365)).toFixed(1);
            $('#dep_current_age').val(ageInYears);
        }
    });

    // Select all checkbox functionality
    $('#selectAll').on('change', function() {
        const isChecked = $(this).is(':checked');
        $('.asset-checkbox').prop('checked', isChecked);
        updateSelectedAssets();
    });

    // Individual asset checkbox functionality
    $('.asset-checkbox').on('change', function() {
        updateSelectedAssets();

        // Update select all checkbox state
        const totalCheckboxes = $('.asset-checkbox').length;
        const checkedCheckboxes = $('.asset-checkbox:checked').length;

        $('#selectAll').prop('indeterminate', checkedCheckboxes > 0 && checkedCheckboxes < totalCheckboxes);
        $('#selectAll').prop('checked', checkedCheckboxes === totalCheckboxes);
    });

    // Label size change handler
    $('#labelSize').on('change', function() {
        updateLabelPreview();
    });

    // Other setting change handlers
    $('#includeQR, #includeBarcode').on('change', function() {
        updateLabelPreview();
    });
});

function clearFilters() {
    // Reset form
    document.getElementById('filterForm').reset();
    // Redirect to clean URL
    window.location.href = window.location.pathname;
}

function calculateDepreciation() {
    // Get input values
    const originalCost = parseFloat($('#dep_original_cost').val()) || 0;
    const salvageValue = parseFloat($('#dep_salvage_value').val()) || 0;
    const usefulLife = parseInt($('#dep_useful_life').val()) || 0;
    const method = $('#dep_method').val();
    const purchaseDate = $('#dep_purchase_date').val();
    const customRate = parseFloat($('#dep_rate').val()) || 25;

    // Validation
    if (originalCost <= 0) {
        alert('Please enter a valid original cost');
        $('#dep_original_cost').focus();
        return;
    }

    if (usefulLife <= 0) {
        alert('Please enter a valid useful life');
        $('#dep_useful_life').focus();
        return;
    }

    if (salvageValue >= originalCost) {
        alert('Salvage value cannot be greater than or equal to original cost');
        $('#dep_salvage_value').focus();
        return;
    }

    // Calculate current age
    let currentAge = 0;
    if (purchaseDate) {
        const purchase = new Date(purchaseDate);
        const today = new Date();
        currentAge = (today - purchase) / (1000 * 60 * 60 * 24 * 365);
    }

    let schedule = [];
    let totalDepreciation = 0;
    let annualDepreciation = 0;
    let depreciationRate = 0;

    // Calculate based on method
    switch (method) {
        case 'straight_line':
            annualDepreciation = (originalCost - salvageValue) / usefulLife;
            depreciationRate = (annualDepreciation / originalCost) * 100;
            schedule = calculateStraightLine(originalCost, salvageValue, usefulLife);
            break;

        case 'declining_balance':
            depreciationRate = customRate;
            annualDepreciation = originalCost * (depreciationRate / 100);
            schedule = calculateDecliningBalance(originalCost, salvageValue, usefulLife, depreciationRate);
            break;

        case 'double_declining':
            depreciationRate = (2 / usefulLife) * 100;
            annualDepreciation = originalCost * (depreciationRate / 100);
            schedule = calculateDoubleDeclining(originalCost, salvageValue, usefulLife);
            break;

        case 'sum_of_years':
            const sumOfYears = (usefulLife * (usefulLife + 1)) / 2;
            depreciationRate = (usefulLife / sumOfYears) * 100;
            annualDepreciation = (originalCost - salvageValue) * (usefulLife / sumOfYears);
            schedule = calculateSumOfYears(originalCost, salvageValue, usefulLife);
            break;
    }

    // Calculate totals based on current age
    if (currentAge > 0 && currentAge <= usefulLife) {
        totalDepreciation = calculateCurrentDepreciation(schedule, currentAge);
    } else if (currentAge > usefulLife) {
        totalDepreciation = originalCost - salvageValue;
    }

    const currentBookValue = originalCost - totalDepreciation;

    // Update results
    $('#dep_total_depreciation').val(formatCurrency(totalDepreciation));
    $('#dep_book_value').val(formatCurrency(Math.max(currentBookValue, salvageValue)));
    $('#dep_annual_depreciation').val(formatCurrency(annualDepreciation));
    $('#dep_percentage').val(depreciationRate.toFixed(2));

    // Update schedule table
    updateScheduleTable(schedule);
}

function calculateStraightLine(cost, salvage, life) {
    const annualDepreciation = (cost - salvage) / life;
    const schedule = [];
    let accumulatedDepreciation = 0;

    for (let year = 1; year <= life; year++) {
        const beginningValue = year === 1 ? cost : schedule[year - 2].endingValue;
        const depreciation = annualDepreciation;
        accumulatedDepreciation += depreciation;
        const endingValue = Math.max(cost - accumulatedDepreciation, salvage);

        schedule.push({
            year: year,
            beginningValue: beginningValue,
            depreciation: depreciation,
            accumulatedDepreciation: accumulatedDepreciation,
            endingValue: endingValue
        });
    }

    return schedule;
}

function calculateDecliningBalance(cost, salvage, life, rate) {
    const schedule = [];
    let bookValue = cost;
    let accumulatedDepreciation = 0;

    for (let year = 1; year <= life; year++) {
        const beginningValue = bookValue;
        let depreciation = bookValue * (rate / 100);

        // Ensure we don't depreciate below salvage value
        if (bookValue - depreciation < salvage) {
            depreciation = bookValue - salvage;
        }

        accumulatedDepreciation += depreciation;
        bookValue -= depreciation;

        schedule.push({
            year: year,
            beginningValue: beginningValue,
            depreciation: depreciation,
            accumulatedDepreciation: accumulatedDepreciation,
            endingValue: bookValue
        });

        // Stop if we've reached salvage value
        if (bookValue <= salvage) {
            break;
        }
    }

    return schedule;
}

function calculateDoubleDeclining(cost, salvage, life) {
    const rate = (2 / life) * 100;
    return calculateDecliningBalance(cost, salvage, life, rate);
}

function calculateSumOfYears(cost, salvage, life) {
    const schedule = [];
    const sumOfYears = (life * (life + 1)) / 2;
    const depreciableBase = cost - salvage;
    let accumulatedDepreciation = 0;

    for (let year = 1; year <= life; year++) {
        const beginningValue = year === 1 ? cost : schedule[year - 2].endingValue;
        const remainingLife = life - year + 1;
        const depreciation = depreciableBase * (remainingLife / sumOfYears);
        accumulatedDepreciation += depreciation;
        const endingValue = cost - accumulatedDepreciation;

        schedule.push({
            year: year,
            beginningValue: beginningValue,
            depreciation: depreciation,
            accumulatedDepreciation: accumulatedDepreciation,
            endingValue: endingValue
        });
    }

    return schedule;
}

function calculateCurrentDepreciation(schedule, currentAge) {
    if (!schedule || schedule.length === 0) return 0;

    const fullYears = Math.floor(currentAge);
    const partialYear = currentAge - fullYears;

    let totalDepreciation = 0;

    // Add depreciation for full years
    for (let i = 0; i < Math.min(fullYears, schedule.length); i++) {
        totalDepreciation += schedule[i].depreciation;
    }

    // Add partial year depreciation
    if (partialYear > 0 && fullYears < schedule.length) {
        totalDepreciation += schedule[fullYears].depreciation * partialYear;
    }

    return totalDepreciation;
}

function updateScheduleTable(schedule) {
    const tbody = $('#depreciation_schedule tbody');
    tbody.empty();

    if (!schedule || schedule.length === 0) {
        tbody.append(`
            <tr>
                <td colspan="5" class="text-center text-muted">
                    <i class="fa fa-info-circle"></i> No data to display
                </td>
            </tr>
        `);
        return;
    }

    schedule.forEach(function(row) {
        const tr = `
            <tr>
                <td>${row.year}</td>
                <td>$${formatNumber(row.beginningValue)}</td>
                <td>$${formatNumber(row.depreciation)}</td>
                <td>$${formatNumber(row.accumulatedDepreciation)}</td>
                <td>$${formatNumber(row.endingValue)}</td>
            </tr>
        `;
        tbody.append(tr);
    });
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(amount);
}

function formatNumber(amount) {
    return new Intl.NumberFormat('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(Math.abs(amount) < 0.01 ? 0 : amount);
}

function exportDepreciationSchedule() {
    const schedule = [];
    const tbody = $('#depreciation_schedule tbody tr');

    if (tbody.length <= 1 || tbody.first().find('td').attr('colspan')) {
        alert('No depreciation schedule to export. Please calculate first.');
        return;
    }

    // Get asset information
    const assetTag = $('#dep_asset_tag').val() || 'Unknown';
    const assetType = $('#dep_asset_type').val() || 'Unknown';
    const originalCost = $('#dep_original_cost').val() || '0';
    const method = $('#dep_method option:selected').text();

    // Create CSV content
    let csv = 'Asset Depreciation Schedule\n';
    csv += `Asset Tag:,${assetTag}\n`;
    csv += `Asset Type:,${assetType}\n`;
    csv += `Original Cost:,$${originalCost}\n`;
    csv += `Method:,${method}\n`;
    csv += `Generated:,${new Date().toLocaleString()}\n\n`;
    csv += 'Year,Beginning Value,Depreciation,Accumulated Depreciation,Ending Value\n';

    tbody.each(function() {
        const cells = $(this).find('td');
        if (cells.length === 5) {
            const row = [];
            cells.each(function() {
                row.push($(this).text().trim());
            });
            csv += row.join(',') + '\n';
        }
    });

    // Download file
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    link.setAttribute('href', url);
    link.setAttribute('download', `depreciation_schedule_${assetTag}_${Date.now()}.csv`);
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function resetCalculator() {
    // Clear all form fields
    $('#depreciation_asset').val('').trigger('change');
    $('#dep_asset_tag').val('');
    $('#dep_asset_type').val('');
    $('#dep_original_cost').val('');
    $('#dep_salvage_value').val('0');
    $('#dep_useful_life').val('');
    $('#dep_purchase_date').val('');
    $('#dep_method').val('straight_line');
    $('#dep_rate').val('25');
    $('#dep_rate_container').hide();

    // Clear results
    $('#dep_current_age').val('');
    $('#dep_total_depreciation').val('');
    $('#dep_book_value').val('');
    $('#dep_annual_depreciation').val('');
    $('#dep_percentage').val('');

    // Reset table
    const tbody = $('#depreciation_schedule tbody');
    tbody.html(`
        <tr>
            <td colspan="5" class="text-center text-muted">
                <i class="fa fa-info-circle"></i> Enter parameters and click Calculate to see depreciation schedule
            </td>
        </tr>
    `);
}

// Bulk Label Print functionality
let selectedAssets = [];

function updateSelectedAssets() {
    selectedAssets = [];
    $('.asset-checkbox:checked').each(function() {
        const checkbox = $(this);
        selectedAssets.push({
            id: checkbox.data('asset-id'),
            tag: checkbox.data('asset-tag'),
            type: checkbox.data('asset-type'),
            model: checkbox.data('model'),
            brand: checkbox.data('brand'),
            company: checkbox.data('company')
        });
    });

    // Update UI
    const count = selectedAssets.length;
    $('#selectedCount').text(count);
    $('#modalSelectedCount').text(count);
    $('#bulkPrintBtn').prop('disabled', count === 0);

    // Update selected assets list in modal
    updateSelectedAssetsList();
}

function updateSelectedAssetsList() {
    const container = $('#selectedAssetsList');

    if (selectedAssets.length === 0) {
        container.html(`
            <div class="text-muted text-center">
                <i class="fa fa-info-circle"></i> No assets selected
            </div>
        `);
        return;
    }

    let html = '';
    selectedAssets.forEach((asset, index) => {
        html += `
            <div class="selected-asset-item">
                <div class="selected-asset-info">
                    <div class="selected-asset-tag">${asset.tag}</div>
                    <div class="selected-asset-details">
                        ${asset.type} • ${asset.brand} • ${asset.company}
                    </div>
                </div>
                <button class="remove-asset-btn" onclick="removeSelectedAsset(${index})" title="Remove">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        `;
    });

    container.html(html);
}

function removeSelectedAsset(index) {
    const asset = selectedAssets[index];

    // Uncheck the checkbox
    $(`.asset-checkbox[data-asset-id="${asset.id}"]`).prop('checked', false);

    // Update selected assets
    updateSelectedAssets();
}

function updateLabelPreview() {
    const labelSize = $('#labelSize').val();
    const includeQR = $('#includeQR').is(':checked');
    const includeBarcode = $('#includeBarcode').is(':checked');

    // Update preview label size class
    const previewLabel = $('#labelPreview .preview-label');
    previewLabel.removeClass('small-label medium-label large-label');
    previewLabel.addClass(`${labelSize}-label`);

    // Update codes visibility
    const qrPlaceholder = previewLabel.find('.qr-placeholder');
    const barcodePlaceholder = previewLabel.find('.barcode-placeholder');

    qrPlaceholder.toggle(includeQR);
    barcodePlaceholder.toggle(includeBarcode);
}

function previewLabels() {
    if (selectedAssets.length === 0) {
        alert('Please select at least one asset to preview.');
        return;
    }

    const labelSize = $('#labelSize').val();
    const includeQR = $('#includeQR').is(':checked');
    const includeBarcode = $('#includeBarcode').is(':checked');
    const additionalText = $('#additionalText').val();

    // Create preview window
    const previewWindow = window.open('', '_blank', 'width=800,height=600');
    let previewHtml = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Label Preview</title>
            <style>
                body { font-family: Arial, sans-serif; padding: 20px; }
                .preview-container { display: flex; flex-wrap: wrap; gap: 10px; }
                .preview-label {
                    border: 2px solid #000;
                    padding: 8px;
                    background: white;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }
                .label-small { width: 160px; height: 80px; font-size: 8px; }
                .label-medium { width: 240px; height: 120px; font-size: 10px; }
                .label-large { width: 320px; height: 160px; font-size: 12px; }
                .label-header { text-align: center; font-weight: bold; border-bottom: 1px solid #ccc; padding-bottom: 2px; }
                .label-content { flex: 1; }
                .asset-tag { font-weight: bold; margin: 4px 0; }
                .label-footer { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #ccc; padding-top: 2px; }
                .qr-code, .barcode { border: 1px solid #ccc; background: #f5f5f5; }
                .qr-code { width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; }
                .barcode { height: 20px; flex: 1; margin-left: 5px; display: flex; align-items: center; justify-content: center; }
            </style>
        </head>
        <body>
            <h2>Label Preview (' + selectedAssets.length + ' labels)</h2>
            <div class="preview-container">
    `;

    selectedAssets.forEach(asset => {
        previewHtml += '<div class="preview-label label-' + labelSize + '">' +
            '<div class="label-header">' + (asset.company || 'COMPANY') + '</div>' +
            '<div class="label-content">' +
                '<div class="asset-tag">' + asset.tag + '</div>' +
                '<div>' + asset.type + '</div>' +
                '<div>' + asset.brand + '</div>' +
                (additionalText ? '<div><small>' + additionalText + '</small></div>' : '') +
            '</div>' +
            '<div class="label-footer">' +
                (includeQR ? '<div class="qr-code">QR</div>' : '') +
                (includeBarcode ? '<div class="barcode">|||||||||||</div>' : '') +
            '</div>' +
        '</div>';
    });

    previewHtml += `
            </div>
            <br>
            <button onclick="window.print()" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">Print Labels</button>
            <button onclick="window.close()" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">Close</button>
        </body>
        </html>
    `;

    previewWindow.document.write(previewHtml);
    previewWindow.document.close();
}

function printLabels() {
    if (selectedAssets.length === 0) {
        alert('Please select at least one asset to print.');
        return;
    }

    const labelSize = $('#labelSize').val();
    const copies = parseInt($('#copiesCount').val()) || 1;
    const includeQR = $('#includeQR').is(':checked');
    const includeBarcode = $('#includeBarcode').is(':checked');
    const additionalText = $('#additionalText').val();

    // Create print window
    const printWindow = window.open('', '_blank', 'width=800,height=600');
    let printHtml = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Asset Labels</title>
            <style>
                @media print {
                    body { margin: 0; }
                    .print-label { page-break-inside: avoid; }
                }
                body { font-family: Arial, sans-serif; }
                .print-container { display: flex; flex-wrap: wrap; }
                .print-label {
                    border: 2px solid #000;
                    padding: 4px;
                    margin: 2mm;
                    background: white;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }
                .label-small { width: 50mm; height: 25mm; font-size: 6px; }
                .label-medium { width: 76mm; height: 38mm; font-size: 8px; }
                .label-large { width: 100mm; height: 50mm; font-size: 10px; }
                .label-header { text-align: center; font-weight: bold; border-bottom: 1px solid #000; padding-bottom: 1px; margin-bottom: 2px; }
                .label-content { flex: 1; }
                .asset-tag { font-weight: bold; margin: 1px 0; }
                .label-footer { display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #000; padding-top: 1px; margin-top: 2px; }
                .qr-code { width: 15px; height: 15px; border: 1px solid #000; display: flex; align-items: center; justify-content: center; font-size: 4px; }
                .barcode { height: 10px; flex: 1; margin-left: 2px; border: 1px solid #000; display: flex; align-items: center; justify-content: center; font-size: 4px; }
            </style>
        </head>
        <body>
            <div class="print-container">
    `;

    selectedAssets.forEach(asset => {
        for (let copy = 0; copy < copies; copy++) {
            printHtml += '<div class="print-label label-' + labelSize + '">' +
                '<div class="label-header">' + (asset.company || 'COMPANY').substring(0, 20) + '</div>' +
                '<div class="label-content">' +
                    '<div class="asset-tag">' + asset.tag + '</div>' +
                    '<div>' + asset.type + '</div>' +
                    '<div>' + asset.brand + '</div>' +
                    (additionalText ? '<div><small>' + additionalText.substring(0, 30) + '</small></div>' : '') +
                '</div>' +
                '<div class="label-footer">' +
                    (includeQR ? '<div class="qr-code">QR</div>' : '') +
                    (includeBarcode ? '<div class="barcode">||||||||</div>' : '') +
                '</div>' +
            '</div>';
        }
    });

    printHtml += `
            </div>
        </body>
        </html>
    `;

    printWindow.document.write(printHtml);
    printWindow.document.close();

    // Close the modal
    $('#bulkLabelModal').modal('hide');

    // Show success message
    setTimeout(() => {
        alert('Successfully sent ' + (selectedAssets.length * copies) + ' labels to printer!');
    }, 500);
}

// Column Selector Functionality
$(document).ready(function() {
    initializeColumnSelector();

    // Load saved column preferences
    loadColumnPreferences();
});

function initializeColumnSelector() {
    const table = $('.smart-table table');
    const headers = table.find('thead th[data-column]');
    const dropdownMenu = $('#columnDropdownMenu');

    // Clear existing items
    dropdownMenu.empty();

    // Create checkbox items for each column
    headers.each(function() {
        const columnName = $(this).data('column');
        const columnText = $(this).text().trim() || columnName.toUpperCase();
        const isEssential = $(this).data('essential') === true;

        // Skip checkbox column from toggles
        if (columnName === 'checkbox') return;

        const checkboxItem = $(`
            <div class="dropdown-item">
                <div class="column-checkbox-item ${isEssential ? 'essential' : ''}"
                     data-column="${columnName}"
                     ${isEssential ? 'data-essential="true"' : ''}>
                    <input type="checkbox"
                           id="col-${columnName}"
                           class="form-check-input column-checkbox"
                           data-column="${columnName}"
                           ${isEssential ? 'disabled' : ''}>
                    <label for="col-${columnName}" class="form-check-label">
                        ${columnText}
                        ${isEssential ? ' <small class="text-muted">(Essential)</small>' : ''}
                    </label>
                </div>
            </div>
        `);

        dropdownMenu.append(checkboxItem);
    });

    // Add click handlers for checkbox items
    $('.column-checkbox-item').on('click', function(e) {
        // Don't toggle if clicking on essential items or the checkbox itself
        if ($(this).hasClass('essential') || $(e.target).is('input')) return;

        const checkbox = $(this).find('input[type="checkbox"]');
        checkbox.prop('checked', !checkbox.prop('checked'));

        const columnName = $(this).data('column');
        toggleColumn(columnName);
    });

    // Add change handlers for checkboxes
    $('.column-checkbox').on('change', function() {
        const columnName = $(this).data('column');
        toggleColumn(columnName);
    });

    // Prevent dropdown from closing when clicking inside
    $('#columnDropdownMenu').on('click', function(e) {
        e.stopPropagation();
    });
}

function toggleColumn(columnName) {
    const table = $('.smart-table table');
    const columnElements = table.find(`[data-column="${columnName}"]`);
    const checkbox = $(`.column-checkbox[data-column="${columnName}"]`);
    const isChecked = checkbox.prop('checked');

    if (isChecked) {
        // Show column
        columnElements.show();
    } else {
        // Hide column
        columnElements.hide();
    }

    // Save preference
    saveColumnPreferences();
}

function showAllColumns() {
    const table = $('.smart-table table');
    const allColumns = table.find('[data-column]');
    const checkboxes = $('.column-checkbox');

    allColumns.show();
    checkboxes.prop('checked', true);

    saveColumnPreferences();
}

function hideAllColumns() {
    const table = $('.smart-table table');
    const nonEssentialColumns = table.find('[data-column]:not([data-essential="true"])');
    const nonEssentialCheckboxes = $('.column-checkbox:not(:disabled)');

    nonEssentialColumns.hide();
    nonEssentialCheckboxes.prop('checked', false);

    saveColumnPreferences();
}

function resetToDefault() {
    const defaultVisibleColumns = [
        'sl', 'status', 'action', 'asset_tag', 'asset_type',
        'model', 'brand', 'cost', 'purchase_date', 'company'
    ];

    const table = $('.smart-table table');
    const allColumns = table.find('[data-column]');
    const checkboxes = $('.column-checkbox');

    // Hide all columns and uncheck all checkboxes first
    allColumns.hide();
    checkboxes.prop('checked', false);

    // Show essential columns and default visible columns
    defaultVisibleColumns.forEach(columnName => {
        const columnElements = table.find(`[data-column="${columnName}"]`);
        const checkbox = $(`.column-checkbox[data-column="${columnName}"]`);

        columnElements.show();
        checkbox.prop('checked', true);
    });

    // Always show essential columns (they should be disabled but ensure they're visible)
    const essentialColumns = table.find('[data-essential="true"]');
    essentialColumns.show();

    saveColumnPreferences();
}

function saveColumnPreferences() {
    const visibleColumns = [];
    $('.column-checkbox').each(function() {
        const columnName = $(this).data('column');
        const isChecked = $(this).prop('checked');
        if (isChecked) {
            visibleColumns.push(columnName);
        }
    });

    localStorage.setItem('storeListVisibleColumns', JSON.stringify(visibleColumns));
}

function loadColumnPreferences() {
    const saved = localStorage.getItem('storeListVisibleColumns');
    if (!saved) {
        // Load default configuration
        resetToDefault();
        return;
    }

    try {
        const visibleColumns = JSON.parse(saved);
        const table = $('.smart-table table');

        // Hide all non-essential columns and uncheck all non-essential checkboxes first
        const allColumns = table.find('[data-column]:not([data-essential="true"])');
        const checkboxes = $('.column-checkbox:not(:disabled)');

        allColumns.hide();
        checkboxes.prop('checked', false);

        // Show saved visible columns and check corresponding checkboxes
        visibleColumns.forEach(columnName => {
            const columnElements = table.find(`[data-column="${columnName}"]`);
            const checkbox = $(`.column-checkbox[data-column="${columnName}"]`);

            columnElements.show();
            checkbox.prop('checked', true);
        });

        // Always show essential columns
        const essentialColumns = table.find('[data-essential="true"]');
        essentialColumns.show();

    } catch (e) {
        console.error('Error loading column preferences:', e);
        resetToDefault();
    }
}
</script>
@endpush