@extends('master')

@section('content')

<div class="container">

    <!-- Page Title -->
    <div class="row mb-2 bg-white">
        <ul class="nav nav-tabs mb-3 w-100 d-flex align-items-center" id="employeeTab" role="tablist">
            <!-- Left-aligned tabs -->
            <li class="nav-item">
                <a class="nav-link active" id="info-tab" data-bs-toggle="tab" href="" role="tab">Info</a>
            </li>
            <li class="nav-item">

                <a class="nav-link" href="{{ route('history', $stores->id) }}">History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('maintenance_list', $stores->id) }}">Maintenance</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('store_file', $stores->id)}}" role="tab">Files</a>
            </li>
        </ul>
    </div>


    <!-- Top Navbar -->

    <!-- Tab Content -->
    <div class="tab-content bg-white">
        <div class="row">
            <div class="col-lg-9">
                <div class="tab-pane fade show active" id="info" role="tabpanel">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            {{-- Issue Success --}}
                            @if (session('issue_success'))
                            <div class="alert alert-warning alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                                <span>{{ session('issue_success') }}</span>
                                <button type="button" class="border-0 bg-warning text-white fw-bold px-2 rounded" data-bs-dismiss="alert" aria-label="Close">X</button>
                            </div>
                            @endif

                            {{-- Delete Success --}}
                            @if(session('delete_success'))
                            <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
                                <span>{{ session('delete_success') }}</span>
                                <button type="button" class="border-0 bg-danger text-white fw-bold px-2 rounded" data-bs-dismiss="alert" aria-label="Close">X</button>
                            </div>
                            @endif

                            <h5 class="mb-0">{{ $stores->asset_tag }}/{{ $stores->model }}/Profile</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Asset Tag</th>
                                    <td class="text-success"><B>{{ $stores->asset_tag }}</B></td>
                                </tr>
                                <tr>
                                    <th>Asset Type</th>
                                    <td>{{ $stores->rel_to_ProductType->product }}</td>
                                </tr>
                                <tr>
                                    <th>Brand</th>
                                    <td>{{ $stores->rel_to_brand->brand_name }}</td>
                                </tr>
                                <tr>
                                    <th>Model</th>
                                    <td>{{ $stores->model }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $stores->description }}</td>
                                </tr>
                                <tr>
                                    <th>Serial</th>
                                    <td>{{ $stores->asset_sl_no }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $stores->rel_to_Status->status_name }}</td>
                                </tr>
                                <tr>
                                    <th>Company</th>
                                    <td>{{ $stores->rel_to_Company->company }}</td>
                                </tr>

                                <tr>
                                    <th>Purchase Date</th>
                                    <td>{{ $stores->purchase_date }}</td>
                                </tr>
                                <tr>
                                    <th>Supplier</th>
                                    <td>{{ $stores->rel_to_Supplier->supplier_name }}</td>
                                </tr>
                                <tr>
                                    <th>CheckStatus</th>
                                    <td class="text-info"><b>{{ $stores->checkstatus }}</b></td>
                                </tr>
                                <tr>
                                    <th>Photo</th>
                                    <td>
                                        <img src="{{ asset('/uploads/store/' . $stores->picture) }}"
                                            alt="Product Photo" width="100" class="rounded shadow-sm">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row">
                    <div class="info-stack-container p-2">
                        <div class="col-md-3 col-xs-12 col-lg-12 col-sm-push-9 info-stack">
                            <div class="col-lg-12">
                                <img src="https://bxasset.bettex.com/public/uploads/avatars/setting-default_avatar-1-7tjaWAl05r.png" class=" img-thumbnail hidden-print" style="margin-bottom: 20px;" alt="Nadia Shahrin Chandni">
                            </div>
                            <div class="col-lg-12" style="padding-top: 2px;">
                                <a href="{{ route('store.edit', $stores->id) }}" class="btn btn-block btn-sm btn-info btn-social hidden-print">
                                    <i class="fa fa-edit me-1"></i> Edit Asset
                                </a>
                            </div>
                            <div class="col-lg-12" style="padding-top: 2px;">
                                <a href="" class="btn btn-block btn-sm btn-secondary btn-social hidden-print">
                                    <i class="fa fa-print me-1"></i> Print All Assigned
                                </a>
                            </div>
                            <div class="col-lg-12" style="padding-top: 2px;">
                                <a href="{{route('store.clone', $stores->id)}}" class="btn btn-block btn-sm btn-primary btn-social hidden-print">
                                    <i class="fa fa-copy me-1"></i> Clone asset
                                </a>
                            </div>
                            <div class="col-lg-12" style="padding-top: 2px;">
                                {{-- Delete Asset --}}
                                <a href="{{ route('store.delete', $stores->id) }}"
                                    class="btn btn-block btn-sm btn-danger btn-social hidden-print
       @if($stores->checkstatus != 'INSTOCK') disabled opacity-50 pointer-events-none @endif"
                                    onclick="return confirm('Are you sure you want to delete this asset?')">
                                    <i class="fa fa-trash me-1"></i> Delete
                                </a>
                            </div>

                            <!--Checkin button disable after delete-->
                            <div class="col-lg-12" style="padding-top: 2px;">
                                @php
                                $latestIssue = \App\Models\Issue::where('asset_tag', $stores->asset_tag)
                                ->whereNull('return_date')
                                ->latest('issue_date')
                                ->first();
                                @endphp

                                @if ($latestIssue || $stores->checkstatus == 'DELETE')
                                {{-- Disabled Checkin All --}}
                                <button type="button"
                                    class="btn btn-block btn-sm btn-warning btn-social hidden-print"
                                    style="opacity: 0.5; cursor: not-allowed; pointer-events: none;">
                                    <i class="fa fa-edit me-1"></i> Checkin All
                                </button>
                                @else
                                {{-- Active Checkin All --}}
                                <a href="{{ route('issue', $stores->id) }}"
                                    class="btn btn-block btn-sm btn-warning btn-social hidden-print">
                                    <i class="fa fa-edit me-1"></i> Checkin All
                                </a>
                                @endif
                            </div>
                            <div class="col-lg-12" style="padding-top: 2px;">
                                <a href="{{route('qr_code_view', $stores->id)}}" class="btn btn-block btn-sm btn-secondary btn-social hidden-print">
                                    <i class="fa fa-eye me-1"></i> QR View
                                </a>
                            </div>

                            <div class="col-lg-12" style="padding-top: 2px;">
                                <a href="{{route('qr_code', $stores->id)}}" class="btn btn-block btn-sm btn-info btn-social hidden-print">
                                    <i class="fa fa-eye me-1"></i> QR Print
                                </a>
                            </div>

                            <div class="col-lg-12" style="padding-top: 10px;">
                                <div id="print-area">
                                    <table>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Info Tab -->


        <!-- Assets Tab -->
        <div class="tab-pane fade" id="assets" role="tabpanel">
            <div class="card card-body">
                <p>No assets assigned.</p>
            </div>
        </div>

        <!-- History Tab -->
        <div class="tab-pane fade" id="history" role="tabpanel">
            <div class="card card-body">
                <p>No history available.</p>
            </div>
        </div>
    </div>

</div>
@endsection