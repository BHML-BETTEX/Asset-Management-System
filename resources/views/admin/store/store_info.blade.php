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

                <a class="nav-link" href="{{ route('history', $stores->products_id) }}">History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('maintenance_list', $stores->id) }}">Maintenance</a>
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
    <div class="tab-content bg-white">
        <div class="row">
            <div class="col-lg-9">
                <div class="tab-pane fade show active" id="info" role="tabpanel">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="mb-0">{{ $stores->products_id }}/{{ $stores->model }}/Profile</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th>Asset Tag</th>
                                    <td class="text-success"><B>{{ $stores->products_id }}</B></td>
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
                            <div class="col-lg-12" style="padding-top: 5px;">
                                <a href="{{ route('store.edit', $stores->id) }}" class="btn btn-block btn-sm btn-info btn-social hidden-print">
                                    <i class="fa fa-edit me-1"></i> Edit Asset
                                </a>
                            </div>
                            <div class="col-lg-12" style="padding-top: 5px;">
                                <a href="" class="btn btn-block btn-sm btn-secondary btn-social hidden-print">
                                    <i class="fa fa-print me-1"></i> Print All Assigned
                                </a>
                            </div>
                            <div class="col-lg-12" style="padding-top: 5px;">
                                <a href="" class="btn btn-block btn-sm btn-primary btn-social hidden-print">
                                    <i class="fa fa-mail me-1"></i> Email List of All Assigned
                                </a>
                            </div>
                            <div class="col-lg-12" style="padding-top: 5px;">
                                <a href="" class="btn btn-block btn-sm btn-danger btn-social hidden-print" onclick="return confirm('Are you sure you want to delete this user?')">
                                    <i class="fa fa-trash me-1"></i> Delete
                                </a>
                            </div>
                            <div class="col-lg-12" style="padding-top: 5px;">
                                <a href="" class="btn btn-block btn-sm btn-danger btn-social hidden-print">
                                    <i class="fa fa-edit me-1"></i> Checkin All / Delete User
                                </a>
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