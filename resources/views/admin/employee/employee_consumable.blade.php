@extends('master')

@section('content')
<div class="container">
    <div class="page-title">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center flex-wrap">

                {{-- ✅ Breadcrumb --}}
                <div class="col-md-5 text-white">
                    <ol class="breadcrumb p-2 m-0" style="background-color: #2C3E50;">
                        <li class="breadcrumb-item"><a href="">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Consumable of {{ $employee->emp_name }}</li>
                    </ol>
                </div>

                {{-- ✅ Search --}}
                <div class="col-md-4 top_search">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" placeholder="Search for..." value="">
                            <button class="btn btn-secondary" type="submit">Go!</button>
                        </div>
                    </form>
                </div>

                {{-- ✅ Export --}}
                <div class="col-md-2">
                    <form action="" method="GET">
                        <div class="input-group">
                            <select name="type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="xlsx">XLSX</option>
                                <option value="csv">CSV</option>
                                <option value="xls">XLS</option>
                            </select>
                            <button type="submit" class="btn btn-success">Export</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ✅ Nav Tabs --}}
        <div class="row mb-3 bg-white">
            <ul class="nav nav-tabs mb-3 w-100 d-flex align-items-center" id="employeeTab" role="tablist">
                <!-- Left-aligned tabs -->
                <li class="nav-item">
                    <a class="nav-link active" id="info-tab" data-bs-toggle="tab" href="{{ route('employee_info', $employee->id) }}" role="tab">Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('employee_assets', ['emp_id' => $employee->emp_id]) }}">Assets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="consumables-tab" data-bs-toggle="tab" href="{{ route('employee_consumable', ['emp_id' => $employee->emp_id]) }}" role="tab">Consumables</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="file-tab" data-bs-toggle="tab" href="{{ route('employee_file', ['emp_id' => $employee->emp_id]) }}" role="tab">File Uploads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="history-tab" data-bs-toggle="tab" href="#history" role="tab">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="locations-tab" data-bs-toggle="tab" href="#history" role="tab">Managed Locations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="users-tab" data-bs-toggle="tab" href="#history" role="tab">Managed Users</a>
                </li>

                <!-- Spacer: Push the following items to the right -->
                <li class="nav-item ms-auto"></li>

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
                        <form id="fileUploadForm" action="{{ route('employee.storeOtherFile', ['id' => $employee->id]) }}" method="POST" enctype="multipart/form-data">
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

        {{-- ✅ Asset Table --}}
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th>SL</th>
                                        <th>PRODUCT TYPE</th>
                                        <th>MODEL</th>
                                        <th>QTY</th>
                                        <th>UNITS</th>
                                        <th>EMP ID</th>
                                        <th>NAME</th>
                                        <th>DEPARTMENT</th>
                                        <th>COMPANY</th>
                                        <th>NOTES</th>
                                        <th>ISSUE DATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($consumable_issue as $key => $issue)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $issue->product_type }}</td>
                                        <td>{{ $issue->model_id }}</td>
                                        <td>{{ $issue->issue_qty }}</td>
                                        <td>{{ $issue->rel_to_SizeMaseurment->size }}</td>
                                        <td>{{ $issue->emp_id }}</td>
                                        <td>{{ $issue->emp_name }}</td>
                                        <td>{{ $issue->rel_to_Department->department_name }}</td>
                                        <td>{{ $issue->rel_to_Company->company }}</td>
                                        <td>{{ $issue->others }}</td>
                                        <td>{{ $issue->issue_date }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ Return Modal --}}
    <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content shadow-lg">
                <div class="modal-header">
                    <h5 class="modal-title">Return Asset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('return_update') }}" method="POST" class="form-card">
                        @csrf

                        <input type="hidden" id="return_asset_tag" name="asset_tag">
                        <input type="hidden" id="return_asset_type" name="asset_type">
                        <input type="hidden" id="return_model" name="model">
                        <input type="hidden" id="return_emp_id" name="emp_id">
                        <input type="hidden" id="return_issue_date_hidden" name="issue_date">

                        <div class="mb-3">
                            <label>Asset Tag</label>
                            <input type="text" id="display_asset_tag" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label>Asset Type</label>
                            <input type="text" id="display_asset_type" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label>Model</label>
                            <input type="text" id="display_model" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label>Employee ID</label>
                            <input type="text" id="display_emp_id" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label>Employee Name</label>
                            <input type="text" id="return_emp_name" name="emp_name" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label>Issue Date</label>
                            <input type="text" id="return_issue_date" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label>Return Date <span class="text-danger">*</span></label>
                            <input type="date" name="return_date" class="form-control" required>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <button type="submit" class="btn btn-success btn-lg flex-fill">
                                <span class="fa fa-file-text"></span> Submit
                            </button>
                            <button type="reset" class="btn btn-secondary btn-lg">
                                <span class="fa fa-undo"></span> Reset
                            </button>
                            <a href="{{ route('store') }}" class="btn btn-info btn-lg text-white">
                                <span class="fa fa-step-backward"></span> Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection