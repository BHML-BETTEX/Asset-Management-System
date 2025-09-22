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

<!-- Profile Management Forms -->
<div class="row">
    <!-- Update Profile Information -->
    <div class="col-lg-4">
        <div class="card profile-form-card">
            <div class="card-header profile-card-header">
                <h5 class="mb-0">
                    <i class="fa fa-user me-2"></i>Update Profile Information
                </h5>
            </div>
            <div class="card-body">
                @if (session('name'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle me-2"></i>{{ session('name') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ route('name.change') }}" method="POST" id="nameForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Enter your full name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" value="{{ Auth::user()->email }}"
                               class="form-control" readonly>
                        <small class="form-text text-muted">
                            <i class="fa fa-info-circle"></i> Email cannot be changed. Contact administrator if needed.
                        </small>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa fa-save me-2"></i>Update Profile
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Change Password -->
    <div class="col-lg-4">
        <div class="card profile-form-card">
            <div class="card-header profile-card-header">
                <h5 class="mb-0">
                    <i class="fa fa-lock me-2"></i>Change Password
                </h5>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('wrong'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa fa-exclamation-triangle me-2"></i>{{ session('wrong') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ route('password.change') }}" method="POST" id="passwordForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Current Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" name="old_password"
                                   class="form-control @error('old_password') is-invalid @enderror"
                                   placeholder="Enter current password" required>
                            <span class="input-group-text toggle-password" data-target="old_password">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                        @error('old_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">New Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" name="new_password"
                                   class="form-control @error('new_password') is-invalid @enderror"
                                   placeholder="Enter new password" required>
                            <span class="input-group-text toggle-password" data-target="new_password">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                        @error('new_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            <i class="fa fa-info-circle"></i> Password must be at least 8 characters with uppercase, lowercase, numbers, and symbols.
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" name="confirm_password"
                                   class="form-control @error('confirm_password') is-invalid @enderror"
                                   placeholder="Confirm new password" required>
                            <span class="input-group-text toggle-password" data-target="confirm_password">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                        @error('confirm_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-warning w-100">
                        <i class="fa fa-key me-2"></i>Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Profile Photo -->
    <div class="col-lg-4">
        <div class="card profile-form-card">
            <div class="card-header profile-card-header">
                <h5 class="mb-0">
                    <i class="fa fa-camera me-2"></i>Update Profile Photo
                </h5>
            </div>
            <div class="card-body">
                @if (session('photo_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle me-2"></i>{{ session('photo_success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="text-center mb-3">
                    <div class="current-photo-preview">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('uploads/profile_photos/' . Auth::user()->profile_photo) }}"
                                 alt="Current Profile Photo" class="profile-photo-medium" id="currentPhoto">
                        @else
                            <div class="profile-photo-placeholder-medium" id="currentPhoto">
                                <i class="fa fa-user fa-3x"></i>
                            </div>
                        @endif
                    </div>
                    <p class="text-muted mt-2">Current Profile Photo</p>
                </div>

                <form action="{{ route('profile.photo.change') }}" method="POST" enctype="multipart/form-data" id="photoForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Choose New Photo <span class="text-danger">*</span></label>
                        <input type="file" name="profile_photo"
                               class="form-control @error('profile_photo') is-invalid @enderror"
                               accept="image/jpeg,image/png,image/jpg,image/gif"
                               id="photoInput" required>
                        @error('profile_photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            <i class="fa fa-info-circle"></i> Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB
                        </small>
                    </div>

                    <div class="mb-3">
                        <div class="photo-preview-container" id="photoPreview" style="display: none;">
                            <label class="form-label">Preview:</label>
                            <div class="text-center">
                                <img src="" alt="Photo Preview" class="profile-photo-medium" id="previewImage">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <i class="fa fa-upload me-2"></i>Upload Photo
                    </button>
                </form>
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

    .profile-photo-medium {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 2px solid #ddd;
        object-fit: cover;
    }

    .profile-photo-placeholder,
    .profile-photo-placeholder-medium {
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        border: 4px solid white;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .profile-photo-placeholder {
        width: 120px;
        height: 120px;
    }

    .profile-photo-placeholder-medium {
        width: 80px;
        height: 80px;
        color: #999;
        border-color: #ddd;
        background: #f8f9fa;
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

    .profile-form-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        transition: transform 0.3s ease;
    }

    .profile-form-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(0,0,0,0.15);
    }

    .profile-card-header {
        background: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        border-radius: 15px 15px 0 0 !important;
        padding: 15px 20px;
    }

    .profile-card-header h5 {
        color: #495057;
        font-weight: 600;
    }

    .toggle-password {
        cursor: pointer;
        background: #f8f9fa;
        border-left: 1px solid #ced4da;
    }

    .toggle-password:hover {
        background: #e9ecef;
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

    .form-text {
        font-size: 0.875rem;
    }

    .current-photo-preview {
        margin-bottom: 10px;
    }

    .photo-preview-container {
        border: 2px dashed #ddd;
        border-radius: 8px;
        padding: 15px;
        background: #f8f9fa;
    }
</style>
@endpush

@push('script')
<script>
$(document).ready(function() {
    // Password visibility toggle
    $('.toggle-password').on('click', function() {
        const target = $(this).data('target');
        const input = $('input[name="' + target + '"]');
        const icon = $(this).find('i');

        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Photo preview
    $('#photoInput').on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
                $('#photoPreview').show();
            }
            reader.readAsDataURL(file);
        } else {
            $('#photoPreview').hide();
        }
    });

    // Form validation
    $('#passwordForm').on('submit', function(e) {
        const newPassword = $('input[name="new_password"]').val();
        const confirmPassword = $('input[name="confirm_password"]').val();

        if (newPassword !== confirmPassword) {
            e.preventDefault();
            alert('New password and confirm password do not match!');
            return false;
        }
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});
</script>
@endpush