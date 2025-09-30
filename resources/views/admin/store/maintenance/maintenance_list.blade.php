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
                    <div class="filter-actions">
                        <button type="button" class="btn btn-info btn-sm w-100"><a href="{{route('maintenance')}}" class="text-white"><span
                                    class="fa fa-mail-forward"> issue</span></a></button>
                        </button>
                    </div>|
                    <div class="filter-actions">
                        <button type="button" class="btn btn-info btn-sm w-100"><a href="{{route('maintenance_return')}}" class="text-white"><span
                                    class="fa fa-mail-reply"> Return</span></a></button>
                        </button>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="columnDropdown" id="columnDropdownMenu">
                        <!-- Column checkboxes will be generated by JavaScript -->
                    </div>
                </div>
        </div>
        </form>
    </div>

    <div class="row mb-2 bg-white">
        <ul class="nav nav-tabs mb-3 w-100 d-flex align-items-center" id="employeeTab" role="tablist" style="style=" border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);"">
            <!-- Left-aligned tabs -->
            <li class="nav-item">
                <a class="nav-link " id="info-tab" data-bs-toggle="tab" href="" role="tab">Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="">Maintenance</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="history-tab" data-bs-toggle="tab" href="#history" role="tab">Files</a>
            </li>

            <!-- Uploads tab -->
            <li class="nav-item">
                <a class="nav-link" id="uploads-tab" href="#history" role="tab" data-toggle="modal" data-target="#uploadsModal">
                    <i class="fa fa-paperclip"></i> Uploads
                </a>
            </li>

            <!-- Action dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                    <i class="fa fa-gear"></i> Action
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Action One</a></li>
                    <li><a class="dropdown-item" href="#">Action Two</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- Modal End -->
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
                                    <th>ASSET TAG</th>
                                    <th>ASSET TYPE</th>
                                    <th>MODEL</th>
                                    <th>Purchase Date</th>
                                    <th>Company</th>
                                    <th>DESCRIPTION</th>
                                    <th>Strat Date</th>
                                    <th>End Date</th>
                                    <th>note</th>
                                    <th>Total Cost</th>
                                    <th>Currency</th>
                                    <th>Vendor</th>
                                    <th>action</th>
                                </tr>
                            </thead>

                            <tbody style="height: 5px !important; overflow: scroll;">
                                @foreach ($maintenance_data as $key => $maintenances_data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $maintenances_data->asset_tag }}</td>
                                    <td>{{ $maintenances_data->asset_type }}</td>
                                    <td>{{ $maintenances_data->model }}</td>
                                    <td>{{ $maintenances_data->purchase_date }}</td>
                                    <td>{{ $maintenances_data->others }}</td>
                                    <td>{{ $maintenances_data->description }}</td>
                                    <td>{{ $maintenances_data->strat_date }}</td>
                                    <td>{{ $maintenances_data->end_date }}</td>
                                    <td>{{ $maintenances_data->note }}</td>
                                    <td>{{ $maintenances_data->amount }}</td>
                                    <td>{{ $maintenances_data->currency }}</td>
                                    <td>{{ $maintenances_data->vendor }}</td>
                                    <td>
                                        <button class="border-0 bg-white"><a class="text-primary"
                                                href="{{route('maintenance_edit', $maintenances_data->id)}}"><i
                                                    class="fa fa-edit "
                                                    style="font-size:20px;"></a></i></button>

                                    </td>
                                    @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{$maintenance_data->links()}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Display Table End -->
@endsection