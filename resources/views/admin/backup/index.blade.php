@extends('master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h3 class="text-white mb-0">
                        <i class="fa fa-database me-2"></i>Database Backup Management
                    </h3>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-triangle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Backup Status Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card {{ $backupStatus['mysqldump_available'] ? 'border-success' : 'border-warning' }}">
                                <div class="card-header {{ $backupStatus['mysqldump_available'] ? 'bg-success' : 'bg-warning' }} text-white">
                                    <h6 class="mb-0">
                                        <i class="fa fa-info-circle me-2"></i>Backup System Status
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fa fa-{{ $backupStatus['mysqldump_available'] ? 'check text-success' : 'exclamation-triangle text-warning' }} me-2"></i>
                                                <strong>MySQL Dump:</strong>
                                                <span class="ms-2 badge bg-{{ $backupStatus['mysqldump_available'] ? 'success' : 'warning' }}">
                                                    {{ $backupStatus['mysqldump_available'] ? 'Available' : 'Not Found' }}
                                                </span>
                                            </div>
                                            @if($backupStatus['mysqldump_available'])
                                                <small class="text-muted">Path: {{ $backupStatus['mysqldump_path'] }}</small>
                                            @else
                                                <small class="text-warning">Using PHP fallback method</small>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fa fa-{{ $backupStatus['storage_writable'] ? 'check text-success' : 'times text-danger' }} me-2"></i>
                                                <strong>Storage:</strong>
                                                <span class="ms-2 badge bg-{{ $backupStatus['storage_writable'] ? 'success' : 'danger' }}">
                                                    {{ $backupStatus['storage_writable'] ? 'Writable' : 'Not Writable' }}
                                                </span>
                                            </div>
                                            <small class="text-muted">Path: {{ $backupStatus['storage_path'] }}</small>
                                        </div>
                                    </div>
                                    @if(!$backupStatus['mysqldump_available'])
                                        <div class="alert alert-info mt-3 mb-0">
                                            <h6><i class="fa fa-lightbulb-o me-2"></i>MySQL Dump Configuration</h6>
                                            <p class="mb-2">To enable faster backups, configure the mysqldump path in your <code>.env</code> file:</p>
                                            <code>MYSQLDUMP_PATH="C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysqldump.exe"</code>
                                            <p class="mt-2 mb-2"><small class="text-muted">Common paths: XAMPP, Laragon, WAMP, or system PATH</small></p>
                                            <button type="button" class="btn btn-sm btn-outline-info" onclick="detectMysqldumpPath()">
                                                <i class="fa fa-search me-1"></i>Auto-Detect Path
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Backup Options -->
                    <div class="row">
                        <!-- Full Database Backup -->
                        <div class="col-md-6">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">
                                        <i class="fa fa-download me-2"></i>Full Database Backup
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted">Create a complete backup of all database tables and data.</p>

                                    <form action="{{ route('backup.full') }}" method="POST" id="fullBackupForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Format:</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="format" id="fullSql" value="sql" checked>
                                                <label class="form-check-label" for="fullSql">
                                                    <i class="fa fa-file-code-o me-1"></i>SQL File
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="format" id="fullZip" value="zip">
                                                <label class="form-check-label" for="fullZip">
                                                    <i class="fa fa-file-zip-o me-1"></i>ZIP Archive
                                                </label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-lg w-100">
                                            <i class="fa fa-download me-2"></i>Create Full Backup
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Individual Table Backup -->
                        <div class="col-md-6">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0">
                                        <i class="fa fa-table me-2"></i>Individual Table Backup
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted">Select specific tables to backup.</p>

                                    <form action="{{ route('backup.table') }}" method="POST" id="tableBackupForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Format:</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="format" id="tableSql" value="sql" checked>
                                                <label class="form-check-label" for="tableSql">
                                                    <i class="fa fa-file-code-o me-1"></i>SQL File
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="format" id="tableZip" value="zip">
                                                <label class="form-check-label" for="tableZip">
                                                    <i class="fa fa-file-zip-o me-1"></i>ZIP Archive
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Select Tables:</label>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" id="selectAll">
                                                <label class="form-check-label fw-bold" for="selectAll">
                                                    Select All Tables
                                                </label>
                                            </div>
                                            <div class="table-selection" style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; border-radius: 4px;">
                                                @foreach($tables as $table)
                                                <div class="form-check">
                                                    <input class="form-check-input table-checkbox" type="checkbox" name="tables[]" value="{{ $table }}" id="table_{{ $table }}">
                                                    <label class="form-check-label" for="table_{{ $table }}">
                                                        <i class="fa fa-table me-1"></i>{{ $table }}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success btn-lg w-100">
                                            <i class="fa fa-download me-2"></i>Create Table Backup
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Existing Backups -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0">
                                        <i class="fa fa-history me-2"></i>Existing Backups
                                    </h5>
                                </div>
                                <div class="card-body">
                                    @if(count($backupFiles) > 0)
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th><i class="fa fa-file me-1"></i>Filename</th>
                                                        <th><i class="fa fa-hdd-o me-1"></i>Size</th>
                                                        <th><i class="fa fa-calendar me-1"></i>Created</th>
                                                        <th><i class="fa fa-cogs me-1"></i>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($backupFiles as $file)
                                                    <tr>
                                                        <td>
                                                            <i class="fa fa-{{ str_ends_with($file['name'], '.zip') ? 'file-zip-o' : 'file-code-o' }} me-2"></i>
                                                            {{ $file['name'] }}
                                                        </td>
                                                        <td>{{ $file['size'] }}</td>
                                                        <td>{{ $file['date'] }}</td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <a href="{{ route('backup.download', $file['name']) }}"
                                                                   class="btn btn-sm btn-outline-primary"
                                                                   title="Download">
                                                                    <i class="fa fa-download"></i>
                                                                </a>
                                                                <button type="button"
                                                                        class="btn btn-sm btn-outline-danger"
                                                                        onclick="deleteBackup('{{ $file['name'] }}')"
                                                                        title="Delete">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fa fa-folder-open fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">No backup files found.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mb-0">Creating backup...</p>
                <small class="text-muted">Please wait, this may take a few minutes.</small>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
$(document).ready(function() {
    // Select all tables functionality
    $('#selectAll').change(function() {
        $('.table-checkbox').prop('checked', $(this).is(':checked'));
    });

    // Update select all when individual checkboxes change
    $('.table-checkbox').change(function() {
        var totalCheckboxes = $('.table-checkbox').length;
        var checkedCheckboxes = $('.table-checkbox:checked').length;
        $('#selectAll').prop('checked', totalCheckboxes === checkedCheckboxes);
    });

    // Show loading modal on form submit
    $('#fullBackupForm, #tableBackupForm').submit(function() {
        $('#loadingModal').modal('show');

        // Set a cookie to track download status
        document.cookie = "download_started=1; path=/";

        // Check for download completion
        let downloadCheck = setInterval(function() {
            // Check if download completed cookie exists
            if (document.cookie.indexOf('download_completed=1') !== -1) {
                clearInterval(downloadCheck);
                $('#loadingModal').modal('hide');

                // Clean up cookies
                document.cookie = "download_started=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                document.cookie = "download_completed=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            }
        }, 500);

        // Fallback: hide modal after 10 seconds if no completion detected
        setTimeout(function() {
            clearInterval(downloadCheck);
            $('#loadingModal').modal('hide');

            // Clean up cookies
            document.cookie = "download_started=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "download_completed=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        }, 10000);
    });

    // Hide loading modal when page loads (in case of error)
    $(window).on('load', function() {
        $('#loadingModal').modal('hide');
    });
});

function deleteBackup(filename) {
    if (confirm('Are you sure you want to delete this backup file?')) {
        // Create form to send DELETE request
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("backup.delete", ":filename") }}'.replace(':filename', filename);

        // Add CSRF token
        var csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        // Add method override for DELETE
        var methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);

        document.body.appendChild(form);
        form.submit();
    }
}

function detectMysqldumpPath() {
    fetch('{{ route("backup.detect.path") }}')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let message = '<h6>MySQL Dump Path Detection Results:</h6>';

                if (Object.keys(data.detected_paths).length > 0) {
                    message += '<div class="alert alert-success"><h6><i class="fa fa-check me-2"></i>Found MySQL Dump Paths:</h6>';

                    if (data.detected_paths.configured) {
                        message += `<p><strong>Configured:</strong> ${data.detected_paths.configured}</p>`;
                    }

                    if (data.detected_paths.common) {
                        message += '<p><strong>Common Locations:</strong></p><ul>';
                        data.detected_paths.common.forEach(path => {
                            message += `<li><code>${path}</code></li>`;
                        });
                        message += '</ul>';
                    }

                    if (data.detected_paths.system) {
                        message += `<p><strong>System:</strong> ${data.detected_paths.system}</p>`;
                    }

                    message += '</div>';
                } else {
                    message += '<div class="alert alert-warning"><h6><i class="fa fa-exclamation-triangle me-2"></i>No MySQL Dump Found</h6>';
                    message += '<p>MySQL dump was not found in common locations. Try these suggestions:</p><ul>';

                    Object.entries(data.suggestions).forEach(([name, path]) => {
                        message += `<li><strong>${name}:</strong> <code>${path}</code></li>`;
                    });

                    message += '</ul></div>';
                }

                // Show in a modal or alert
                const modalBody = document.createElement('div');
                modalBody.innerHTML = message;

                // Create a simple modal (if Bootstrap modal is available)
                if (typeof bootstrap !== 'undefined') {
                    const modalHtml = `
                        <div class="modal fade" id="detectModal" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">MySQL Dump Detection</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">${message}</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    document.body.insertAdjacentHTML('beforeend', modalHtml);
                    const modal = new bootstrap.Modal(document.getElementById('detectModal'));
                    modal.show();

                    // Remove modal after hiding
                    document.getElementById('detectModal').addEventListener('hidden.bs.modal', function () {
                        this.remove();
                    });
                } else {
                    // Fallback to alert
                    alert(message.replace(/<[^>]*>/g, ''));
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error detecting MySQL dump path. Please check the console for details.');
        });
}
</script>
@endpush