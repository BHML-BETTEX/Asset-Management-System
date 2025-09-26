@extends('master')

@section('content')

<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">User Profile</li>
    </ol>
</div>

<!-- Profile Header -->
<div class="row">
    <div class="col-12">
        <div class="card profile-header-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        <div class="profile-photo-wrapper">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('uploads/profile_photos/' . Auth::user()->profile_photo) }}"
                                     alt="Profile Photo" class="profile-photo-large">
                            @else
                                <div class="profile-photo-placeholder">
                                    <i class="fa fa-user fa-4x"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="profile-info">
                            <h2 class="profile-name">{{ Auth::user()->name }}</h2>
                            <p class="profile-email">
                                <i class="fa fa-envelope me-2"></i>{{ Auth::user()->email }}
                            </p>
                            <p class="profile-joined">
                                <i class="fa fa-calendar me-2"></i>Member since {{ Auth::user()->created_at->format('F d, Y') }}
                            </p>
                            <div class="profile-roles">
                                <i class="fa fa-shield me-2"></i>
                                @if(Auth::user()->getRoleNames()->isNotEmpty())
                                    @foreach(Auth::user()->getRoleNames() as $role)
                                        <span class="badge badge-primary me-1">{{ ucfirst($role) }}</span>
                                    @endforeach
                                @else
                                    <span class="badge badge-secondary">No roles assigned</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card profile-actions-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5 class="mb-2">
                            <i class="fa fa-cogs me-2 text-primary"></i>Profile Management
                        </h5>
                        <p class="text-muted mb-0">Update your personal information, change password, or upload a new profile photo</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="action-buttons">
                            <button type="button" class="btn btn-primary me-2" onclick="editMyProfile()">
                                <i class="fa fa-user-edit me-1"></i> Edit Profile
                            </button>
                            <button type="button" class="btn btn-warning me-2" onclick="changeMyPassword()">
                                <i class="fa fa-key me-1"></i> Change Password
                            </button>
                            <button type="button" class="btn btn-success" onclick="updateProfilePhoto()">
                                <i class="fa fa-camera me-1"></i> Update Photo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Details -->
<div class="row">
    <div class="col-lg-8">
        <div class="card profile-details-card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fa fa-info-circle me-2"></i>Profile Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="profile-field">
                            <label>Full Name:</label>
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                        <div class="profile-field">
                            <label>Email Address:</label>
                            <span>{{ Auth::user()->email }}</span>
                        </div>
                        <div class="profile-field">
                            <label>Phone Number:</label>
                            <span>{{ Auth::user()->phone ?? 'Not provided' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-field">
                            <label>Department:</label>
                            <span>{{ Auth::user()->department ?? 'Not specified' }}</span>
                        </div>
                        <div class="profile-field">
                            <label>Position:</label>
                            <span>{{ Auth::user()->position ?? 'Not specified' }}</span>
                        </div>
                        <div class="profile-field">
                            <label>Location:</label>
                            <span>{{ Auth::user()->location ?? 'Not specified' }}</span>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->bio)
                <div class="profile-field mt-3">
                    <label>Bio:</label>
                    <span>{{ Auth::user()->bio }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card profile-stats-card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fa fa-chart-bar me-2"></i>Account Status
                </h5>
            </div>
            <div class="card-body">
                <div class="stat-item">
                    <div class="stat-label">Member Since</div>
                    <div class="stat-value">{{ Auth::user()->created_at->format('M d, Y') }}</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Email Status</div>
                    <div class="stat-value">
                        @if(Auth::user()->email_verified_at)
                            <span class="badge bg-success">
                                <i class="fa fa-check me-1"></i>Verified
                            </span>
                        @else
                            <span class="badge bg-warning">
                                <i class="fa fa-clock me-1"></i>Pending
                            </span>
                        @endif
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Current Roles</div>
                    <div class="stat-value">
                        @if(Auth::user()->getRoleNames()->isNotEmpty())
                            @foreach(Auth::user()->getRoleNames() as $role)
                                <span class="badge role-badge me-1">{{ ucfirst($role) }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">No roles assigned</span>
                        @endif
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Last Updated</div>
                    <div class="stat-value">{{ Auth::user()->updated_at->diffForHumans() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editProfileModalLabel">
                    <i class="fa fa-user-edit me-2"></i>Edit My Profile
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="editProfileContent">
                <!-- Profile edit form will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="changePasswordModalLabel">
                    <i class="fa fa-key me-2"></i>Change My Password
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="changePasswordContent">
                <!-- Password change form will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Update Photo Modal -->
<div class="modal fade" id="updatePhotoModal" tabindex="-1" aria-labelledby="updatePhotoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="updatePhotoModalLabel">
                    <i class="fa fa-camera me-2"></i>Update Profile Photo
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="updatePhotoContent">
                <!-- Photo update form will be loaded here -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('style')
<style>
    .profile-header-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 15px;
        margin-bottom: 30px;
    }

    .profile-photo-wrapper {
        position: relative;
    }

    .profile-photo-large {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid white;
        object-fit: cover;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .profile-photo-placeholder {
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        border: 4px solid white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        width: 120px;
        height: 120px;
    }

    .profile-info {
        padding-left: 20px;
    }

    .profile-name {
        color: white;
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 2rem;
    }

    .profile-email,
    .profile-joined {
        color: rgba(255,255,255,0.9);
        margin-bottom: 8px;
        font-size: 1.1rem;
    }

    .profile-roles {
        margin-top: 10px;
    }

    .profile-actions-card,
    .profile-details-card,
    .profile-stats-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }

    .profile-actions-card:hover,
    .profile-details-card:hover,
    .profile-stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(0,0,0,0.15);
    }

    .action-buttons .btn {
        border-radius: 25px;
        padding: 8px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .action-buttons .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .profile-field {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        margin-bottom: 8px;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #667eea;
    }

    .profile-field label {
        font-weight: 600;
        color: #495057;
        margin: 0;
        min-width: 120px;
    }

    .profile-field span {
        color: #6c757d;
        text-align: right;
        flex: 1;
    }

    .stat-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        margin-bottom: 10px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 10px;
        border-left: 4px solid #28a745;
    }

    .stat-label {
        font-weight: 600;
        color: #495057;
        font-size: 0.9rem;
    }

    .stat-value {
        color: #6c757d;
        font-weight: 500;
    }

    .role-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .btn {
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-1px);
    }

    .badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: normal;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ced4da;
        padding: 10px 15px;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .alert {
        border-radius: 10px;
        border: none;
    }

    .breadcrumb {
        background: transparent;
        margin-bottom: 20px;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
        color: #6c757d;
    }

    @media (max-width: 768px) {
        .action-buttons {
            text-align: center !important;
            margin-top: 15px;
        }

        .action-buttons .btn {
            margin-bottom: 10px;
            width: 100%;
        }

        .profile-field {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }

        .profile-field span {
            text-align: left;
        }
    }
</style>
@endpush

@push('script')
<script>
$(document).ready(function() {
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});

// Edit Profile Modal
function editMyProfile() {
    $.ajax({
        url: '/users/{{ Auth::id() }}/profile/edit',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            $('#editProfileContent').html('<div class="text-center p-4"><i class="fa fa-spinner fa-spin fa-2x"></i><p class="mt-2">Loading profile information...</p></div>');
        },
        success: function(response) {
            if (response.success) {
                $('#editProfileContent').html(response.html);
                $('#editProfileModal').modal('show');
            } else {
                showAlert('danger', response.message || 'Failed to load profile edit form');
            }
        },
        error: function(xhr) {
            console.error('Error loading profile edit form:', xhr);
            let errorMsg = 'Error loading profile edit form';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            }
            showAlert('danger', errorMsg);
        }
    });
}

// Change Password Modal
function changeMyPassword() {
    $.ajax({
        url: '/users/{{ Auth::id() }}/password/edit',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            $('#changePasswordContent').html('<div class="text-center p-4"><i class="fa fa-spinner fa-spin fa-2x"></i><p class="mt-2">Loading password change form...</p></div>');
        },
        success: function(response) {
            if (response.success) {
                $('#changePasswordContent').html(response.html);
                $('#changePasswordModal').modal('show');
            } else {
                showAlert('danger', response.message || 'Failed to load password change form');
            }
        },
        error: function(xhr) {
            console.error('Error loading password change form:', xhr);
            let errorMsg = 'Error loading password change form';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            }
            showAlert('danger', errorMsg);
        }
    });
}

// Update Profile Photo Modal
function updateProfilePhoto() {
    const photoForm = `
        <form id="myProfilePhotoForm" method="POST" enctype="multipart/form-data">
            <div class="text-center mb-4">
                <div class="current-photo-preview">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('uploads/profile_photos/' . Auth::user()->profile_photo) }}"
                             alt="Current Profile Photo" class="profile-photo-current" id="currentPhotoPreview">
                    @else
                        <div class="profile-photo-placeholder-current" id="currentPhotoPreview">
                            <i class="fa fa-user fa-3x"></i>
                        </div>
                    @endif
                </div>
                <p class="text-muted">Current Profile Photo</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Choose New Photo <span class="text-danger">*</span></label>
                <input type="file" name="profile_photo" class="form-control"
                       accept="image/jpeg,image/png,image/jpg,image/gif"
                       id="myProfilePhotoInput" required>
                <small class="form-text text-muted">
                    <i class="fa fa-info-circle"></i> Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB
                </small>
                <div class="invalid-feedback"></div>
            </div>

            <div class="mb-3">
                <div class="photo-preview-container" id="myPhotoPreview" style="display: none;">
                    <label class="form-label">Preview:</label>
                    <div class="text-center">
                        <img src="" alt="Photo Preview" class="profile-photo-preview" id="myPreviewImage">
                    </div>
                </div>
            </div>

            <div class="form-actions pt-3 border-top">
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-upload"></i> Update Photo
                    </button>
                </div>
            </div>
        </form>

        <style>
        .profile-photo-current,
        .profile-photo-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 2px solid #ddd;
            object-fit: cover;
        }
        .profile-photo-placeholder-current {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #f8f9fa;
            border: 2px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            margin: 0 auto;
        }
        .photo-preview-container {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 15px;
            background: #f8f9fa;
        }
        </style>
    `;

    $('#updatePhotoContent').html(photoForm);
    $('#updatePhotoModal').modal('show');

    // Photo preview functionality
    $('#myProfilePhotoInput').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // File size validation (2MB)
            if (file.size > 2 * 1024 * 1024) {
                showAlert('danger', 'File size must be less than 2MB');
                this.value = '';
                return;
            }

            // File type validation
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                showAlert('danger', 'Please select a valid image file (JPG, PNG, GIF)');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                $('#myPreviewImage').attr('src', e.target.result);
                $('#myPhotoPreview').show();
            };
            reader.readAsDataURL(file);
        } else {
            $('#myPhotoPreview').hide();
        }
    });

    // Form submission
    $('#myProfilePhotoForm').on('submit', function(e) {
        e.preventDefault();
        submitMyPhotoUpdate(new FormData(this));
    });
}

// Submit Profile Update
function submitMyProfileUpdate(formData) {
    $.ajax({
        url: '/users/{{ Auth::id() }}/profile/update',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            $('#editProfileModal .btn[type="submit"]').prop('disabled', true)
                .html('<i class="fa fa-spinner fa-spin"></i> Updating...');
        },
        success: function(response) {
            if (response.success) {
                $('#editProfileModal').modal('hide');
                showAlert('success', response.message);
                location.reload(); // Reload to show updated information
            } else {
                handleFormErrors(response.errors, '#editProfileModal');
            }
        },
        error: function(xhr) {
            console.error('Error updating profile:', xhr);
            if (xhr.status === 422 && xhr.responseJSON.errors) {
                handleFormErrors(xhr.responseJSON.errors, '#editProfileModal');
            } else {
                showAlert('danger', 'Error updating profile');
            }
        },
        complete: function() {
            $('#editProfileModal .btn[type="submit"]').prop('disabled', false)
                .html('<i class="fa fa-save"></i> Update Profile');
        }
    });
}

// Submit Password Change
function submitMyPasswordChange(formData) {
    $.ajax({
        url: '/users/{{ Auth::id() }}/password/update',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            $('#changePasswordModal .btn[type="submit"]').prop('disabled', true)
                .html('<i class="fa fa-spinner fa-spin"></i> Changing...');
        },
        success: function(response) {
            if (response.success) {
                $('#changePasswordModal').modal('hide');
                showAlert('success', response.message);
                // Clear form
                $('#changePasswordModal form')[0].reset();
            } else {
                handleFormErrors(response.errors, '#changePasswordModal');
            }
        },
        error: function(xhr) {
            console.error('Error changing password:', xhr);
            if (xhr.status === 422 && xhr.responseJSON.errors) {
                handleFormErrors(xhr.responseJSON.errors, '#changePasswordModal');
            } else {
                showAlert('danger', 'Error changing password');
            }
        },
        complete: function() {
            $('#changePasswordModal .btn[type="submit"]').prop('disabled', false)
                .html('<i class="fa fa-key"></i> Change Password');
        }
    });
}

// Submit Photo Update
function submitMyPhotoUpdate(formData) {
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    $.ajax({
        url: '/profile/photo/change',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function() {
            $('#updatePhotoModal .btn[type="submit"]').prop('disabled', true)
                .html('<i class="fa fa-spinner fa-spin"></i> Uploading...');
        },
        success: function(response) {
            $('#updatePhotoModal').modal('hide');
            showAlert('success', 'Profile photo updated successfully!');
            location.reload(); // Reload to show updated photo
        },
        error: function(xhr) {
            console.error('Error updating photo:', xhr);
            showAlert('danger', 'Error updating profile photo');
        },
        complete: function() {
            $('#updatePhotoModal .btn[type="submit"]').prop('disabled', false)
                .html('<i class="fa fa-upload"></i> Update Photo');
        }
    });
}

// Handle form errors
function handleFormErrors(errors, modalSelector) {
    // Clear previous errors
    $(modalSelector + ' .is-invalid').removeClass('is-invalid');
    $(modalSelector + ' .invalid-feedback').hide();

    // Show new errors
    $.each(errors, function(field, messages) {
        const input = $(modalSelector + ' [name="' + field + '"]');
        input.addClass('is-invalid');
        const feedback = input.siblings('.invalid-feedback');
        if (feedback.length) {
            feedback.text(messages[0]).show();
        }
    });
}

// Show alert messages
function showAlert(type, message) {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            <i class="fa fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;

    // Remove existing alerts
    $('.alert').remove();

    // Add new alert at the top of the page
    $('.page-titles').after(alertHtml);

    // Auto-hide after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
}
</script>
@endpush