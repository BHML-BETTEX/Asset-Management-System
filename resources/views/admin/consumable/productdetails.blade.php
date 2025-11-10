@extends('master')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* Modern Store List Styling */
    .pagination-wrapper nav {
        margin-bottom: 0;
    }

    .form-select-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        height: auto;
    }

    .select2-container--bootstrap4 {
        width: 100% !important;
    }

    .custom-file-upload {
        border: 2px dashed #ddd;
        border-radius: 10px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .custom-file-upload:hover {
        border-color: #2B7093;
        background-color: rgba(43, 112, 147, 0.05);
    }

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

    .summary-card.total {
        --card-color: #007bff;
    }

    .summary-card.instock {
        --card-color: #28a745;
    }

    .summary-card.issued {
        --card-color: #ffc107;
    }

    .summary-card.maintenance {
        --card-color: #dc3545;
    }

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
        border-radius: ;
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

    .btn-add {
        background-color: #17a2b8;
    }

    .btn-issue {
        background-color: #28a745;
    }

    .btn-return {
        background-color: #ffc107;
        color: #212529;
    }

    .btn-transfer {
        background-color: #6f42c1;
    }

    .btn-maintenance {
        background-color: #fd7e14;
    }

    .btn-waste {
        background-color: #dc3545;
    }

    .btn-calculator {
        background-color: #6f42c1;
    }

    .btn-print {
        background-color: #28a745;
    }

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

    .status-instock {
        background-color: #d4edda;
        color: #155724;
    }

    .status-issued {
        background-color: #cce5ff;
        color: #004085;
    }

    .status-maintenance {
        background-color: #fff3cd;
        color: #856404;
    }

    .action-buttons-cell {
        min-width: 120px;
        display: flex;
        gap: 0.10rem;
    }

    .table-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.375rem 0.75rem;
        /* Bootstrap medium size padding */
        font-size: 1rem;
        /* Medium font size */
        border: none;
        background: none;
        cursor: pointer;
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
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        /* Better min size */
        gap: 1.2rem;
        /* Slightly more spacing between fields */
        margin-bottom: 1rem;
        align-items: end;
        /* Aligns inputs/selects nicely on the bottom */
    }


    .dropdown-menu {
        padding: 0.5rem 0;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border: none;
        border-radius: 0.5rem;
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        color: #495057;
        transition: all 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #2B7093;
    }

    .dropdown-item i {
        font-size: 1rem;
        width: 1.5rem;
        text-align: center;
    }

    .btn-group .dropdown-toggle::after {
        margin-left: 0.5rem;
    }

    .input-group-sm {
        height: 31px;
    }

    .advanced-filters {
        border-top: 1px solid #dee2e6;
        padding-top: 1rem;
        margin-top: 1rem;
    }

    .filter-row label {
        font-weight: 600;
        margin-bottom: 0.3rem;
        font-size: 0.85rem;
        color: #495057;
    }

    .filter-row input,
    .filter-row select {
        height: 36px;
        /* Forces all inputs/selects to have same height */
        line-height: 36px;
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
    }

    .form-control-sm:focus,
    .form-select-sm:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-primary.btn-sm {
        height: 31px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .form-control-sm:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

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
        background-color: #26B99A;
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
    }

    .modal-body {
        padding: 2rem;
    }

    .form-floating {
        position: relative;
        margin-bottom: 1rem;
    }

    .form-floating>.form-control,
    .form-floating>.form-select {
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
    }

    .form-floating>label {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        padding: 1rem 0.75rem;
        pointer-events: none;
        border: 1px solid transparent;
        transform-origin: 0 0;
        transition: opacity .1s ease-in-out, transform .1s ease-in-out;
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

    .qr-placeholder,
    .barcode-placeholder {
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

        .print-labels,
        .print-labels * {
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


        .table-action-btn {
            width: 28px;
            height: 28px;
            font-size: 0.7rem;
        }

        .btn-group {
            flex-direction: column;
            width: 100%;
        }

        .btn-group .btn {
            margin-bottom: 5px;
        }
    }

    /* Filter Panel Button Styling */
    .btn-group .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.375rem 0.75rem;
        height: 31px;
    }

    .btn-group .btn i {
        font-size: 0.875rem;

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

    .form-check {
        position: relative;
        display: block;
        padding-left: 1.25rem;
    }

    button,
    input {
        overflow: visible;
    }
</style>

<div class="container">
    <div class="card mb-2" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
        <div class="card-header" style="background-color: #f8f9fa; border-radius: 12px 12px 0 0;">
            <h6 class="mb-0 text-dark">
                <span class="">Consuamble List</span>
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
                        @foreach ($all_product_types as $Type)
                        <option value="{{ $Type->id }}"
                            {{ request('product_search') == $Type->id ? 'selected' : '' }}>
                            {{ $Type->product }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Company</label>
                    <select name="company_filter" class="form-control form-control-sm select2-filter">
                        <option value="">All Companies</option>
                        @foreach($all_company as $allcompany)
                        <option value="{{ $allcompany->id }}"
                            {{ request('company_filter') == $allcompany->id ? 'selected' : '' }}>
                            {{ $allcompany->company }}
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
                    <button type="button" class="btn btn-outline-secondary btn-sm w-100" onclick="clearFilters()">
                        <i class="fa fa-refresh"></i> Clear All
                    </button>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="columnDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-list"></i> Select Columns
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="columnDropdown" id="columnDropdownMenu">
                        <!-- Column checkboxes will be generated by JavaScript -->
                    </div>
                </div>

                <div class="filter-actions">
                    <a href="" class="btn btn-info text-white" data-toggle="modal" data-target="#addLocationModal"><i class="fa fa-plus"></i> Add</a>
                </div>
                <div class="filter-actions">
                    <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-download"></i> Export
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Display Table Start -->
<div class="row">
    <div class="col-lg-12">
        <div class="smart-table">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped table-bordered ">
                            <thead class="bg-info text-white ">
                                <tr>
                                    <th>SL</th>
                                    <th>ASSET TYPE</th>
                                    <th>MODEL</th>
                                    <th>BRAND</th>
                                    <th>DESCRIPTION</th>
                                    <th>ASSET SL No</th>
                                    <th>QTY</th>
                                    <th>UNITS</th>
                                    <th>WARRENTY</th>
                                    <th>DURABLITY</th>
                                    <th>COST</th>
                                    <th>TOTAL</th>
                                    <th>CURRENCY</th>
                                    <th>VENDOR</th>
                                    <th>PURCHASE DATE</th>
                                    <th>CHALLAN NO</th>
                                    <th>COMPANY</th>
                                    <th>OTHERS</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody style="height: 3px !important; overflow: scroll; ">
                                @foreach ($productdetails as $key => $productdetail)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $productdetail->rel_to_ProductType->product }}</td>
                                    <td>{{ $productdetail->model}}</td>
                                    <td>{{ $productdetail->rel_to_brand->brand_name }}</td>
                                    <td>{{ $productdetail->description }}</td>
                                    <td>{{ $productdetail->asset_sl_no }}</td>
                                    <td>{{ $productdetail->qty }}</td>
                                    <td>{{ $productdetail->rel_to_SizeMaseurment->size }}</td>
                                    <td>{{ $productdetail->warrenty }}</td>
                                    <td>{{ $productdetail->durablity }}</td>
                                    <td>{{ $productdetail->cost }}</td>
                                    <td>{{ $productdetail->total }}</td>
                                    <td>{{ $productdetail->currency }}</td>
                                    <td>{{ $productdetail->rel_to_Supplier->supplier_name }}</td>
                                    <td>{{ $productdetail->purchase_date }}</td>
                                    <td>{{ $productdetail->challan_no }}</td>
                                    <td>{{ $productdetail->rel_to_Company->company }}</td>
                                    <td>{{ $productdetail->others }}</td>
                                    <td>
                                        <button class="border-0 bg-white"><a class="text-primary"
                                                href=""><i
                                                    class="fa fa-edit "
                                                    style="font-size:20px;"></a></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$productdetails->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<div class="modal fade bd-example-modal-xl" id="addLocationModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card p-1">
                        <div class="card-header " style="background-color: #0cb0b7;">
                            <h5 class="text-white">Add Consumable Product</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('productdetails_store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="controls">
                                    <!-- Asset Type & Brand -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Asset Type *</label>
                                                <select id="asset_type" name="asset_type" class="form-control select2" required>
                                                    <option value="">-- Select Asset Types --</option>
                                                    @foreach ($all_product_types as $product_type)
                                                    <option value="{{ $product_type->id }}">{{ $product_type->product }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Brand</label>
                                                <select id="brand" name="brand" class="form-control select2">
                                                    <option value="" selected disabled>-- Select Brand --</option>
                                                    @foreach ($all_brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Model & Serial -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Model *
                                                    <span class="text-success" data-toggle="modal" data-target="#addModelModal">
                                                        <i class="fa fa-plus" style="font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select id="model" name="model" class="form-control select2" required>
                                                    <option value="" selected disabled>-- Select Model --</option>
                                                    @foreach ($products as $product)
                                                    <option value="{{ $product->product_model }}">{{ $product->product_model }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Serial</label>
                                                <input type="text" name="asset_sl_no" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" class="form-control" rows="6"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Quantity & Units -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Quantity <span class="text-danger">*</span></label>
                                                <input id="qty" type="number" name="qty" class="form-control" value="1" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Units <span class="text-danger">*</span>
                                                    <span class="text-success" data-toggle="modal" data-target="#addUnitModal">
                                                        <i class="fa fa-plus" style="font-size:10px;"></i>
                                                    </span>
                                                </label>
                                                <select name="units" class="form-control" required>
                                                    <option value="" selected disabled>-- Select Units --</option>
                                                    @foreach ($all_SizeMaseurment as $size)
                                                    <option value="{{ $size->id }}">{{ $size->size }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cost & Currency -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Cost</label>
                                                <input id="cost" type="number" name="cost" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Currency</label>
                                                <select name="currency" class="form-control">
                                                    <option value="" selected disabled>-- Select Currency --</option>
                                                    <option>BDT</option>
                                                    <option>USD</option>
                                                    <option>RMB</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Total Amount -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Total Amount</label>
                                                <input id="total" type="text" readonly name="total" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Warranty & Durability -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Warranty</label>
                                                <input type="number" name="warrenty" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Durability</label>
                                                <select name="durablity" class="form-control">
                                                    <option value="" selected disabled>-- Select Durability --</option>
                                                    <option>Days</option>
                                                    <option>Week</option>
                                                    <option>Month</option>
                                                    <option>Year</option>
                                                    <option>Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Purchase Date -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Purchase date</label>
                                                <input type="date" name="purchase_date" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Vendor & Company -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Vendor *</label>
                                                <select name="vendor" class="form-control select2" required>
                                                    <option value="" selected disabled>-- Select Vendor --</option>
                                                    @foreach ($all_supplier as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Company</label>
                                                <select name="company" class="form-control" required>
                                                    <option value="" selected disabled>-- Select Company --</option>
                                                    @foreach ($all_company as $company)
                                                    <option value="{{ $company->id }}">{{ $company->company }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Challan Number -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Challan Number</label>
                                                <input type="text" name="challan_no" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Note -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Note</label>
                                                <input type="text" name="others" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary"><span class="fa fa-file-text"></span> Submit</button>
                                            <button type="reset" class="btn btn-secondary"><span class="fa fa-undo"></span> Reset</button>
                                            <a href="{{ route('productdetails') }}" class="btn btn-info"><span class="fa fa-step-backward"></span> Back</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="addModelModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card p-1">
                        <div class="card-header " style="background-color: #99abb0;">
                            <h5 class="text-white">Add Product</h5>
                        </div>
                        @if (session ('brand_add'))
                        <div class="alert alert-success">{{ session('brand_add') }}</div>
                        @endif
                        <div class="card-body">
                            <form action="{{route('product_store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="form_label">Product Type
                                            <span class="text-success" data-toggle="modal" data-target="#addCompanyModal"><i
                                                    class="fa fa-plus"
                                                    style="font-size:10px;"></i></span>
                                        </label>
                                        <select id="product_type" name="product_type"
                                            class="form-control select2" required="required">
                                            <option value="" selected disabled>--Select
                                                Your
                                                Issue--</option>
                                            @foreach ($all_product_types as $all_product_type)
                                            <option value="{{ $all_product_type->id }}">
                                                {{ $all_product_type->product }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Model</label>
                                    <input type="text" class="form-control" name="product_model" placeholder="note">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn text-white" style="background-color: #0cb0b7;">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection

@push('script')

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "-- Select Item --",
            allowClear: true,
            width: '100%',
            minimumResultsForSearch: 0,
            dropdownParent: $('#addLocationModal')
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const costInput = document.getElementById('cost');
        const qtyInput = document.getElementById('qty');
        const totalInput = document.getElementById('total');

        function calculateTotal() {
            const cost = parseFloat(costInput.value) || 0;
            const qty = parseFloat(qtyInput.value) || 0;
            const total = cost * qty;
            totalInput.value = total.toFixed(2);
        }

        costInput.addEventListener('input', calculateTotal);
        qtyInput.addEventListener('input', calculateTotal);
    });
</script>

@if(session('add_message'))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session("add_message") }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if(session('product_delete'))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session("product_delete") }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif
@endpush