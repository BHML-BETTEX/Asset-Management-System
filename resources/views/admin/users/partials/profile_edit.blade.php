<form id="profileEditForm" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <!-- Profile Photo Section -->
        <div class="col-md-4">
            <div class="profile-upload-section">
                <h6 class="mb-3"><i class="fa fa-camera text-primary"></i> Profile Photo</h6>
                <div class="text-center">
                    <div class="current-photo mb-3">
                        @if($user->profile_photo)
                            <img src="{{ asset('uploads/profile_photos/' . $user->profile_photo) }}"
                                 alt="Current Photo"
                                 class="profile-avatar"
                                 id="profileAvatar">
                        @else
                            <img src="{{ asset('images/user.png') }}"
                                 alt="Default Avatar"
                                 class="profile-avatar"
                                 id="profileAvatar">
                        @endif
                        <div class="photo-overlay">
                            <i class="fa fa-camera"></i>
                        </div>
                    </div>

                    <div class="upload-controls">
                        <label for="profilePhotoUpload" class="btn btn-primary btn-sm">
                            <i class="fa fa-upload"></i> Upload Photo
                        </label>
                        <input type="file" id="profilePhotoUpload" name="profile_photo"
                               accept="image/*" style="display: none;" onchange="previewProfileImage(this)">

                        @if($user->profile_photo)
                            <button type="button" class="btn btn-outline-danger btn-sm ms-2" onclick="removeProfilePhoto()">
                                <i class="fa fa-trash"></i> Remove
                            </button>
                        @endif
                    </div>
                    <small class="text-muted d-block mt-2">
                        Supported: JPG, PNG, GIF<br>
                        Maximum size: 2MB
                    </small>
                </div>
            </div>
        </div>

        <!-- Profile Information Section -->
        <div class="col-md-8">
            <div class="profile-form-section">
                <!-- Basic Information -->
                <div class="form-section mb-4">
                    <h6 class="section-title">
                        <i class="fa fa-user text-success"></i> Personal Information
                    </h6>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="profileName" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="profileName" name="name"
                                   value="{{ $user->name }}" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="profileEmail" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="profileEmail" name="email"
                                   value="{{ $user->email }}" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="profilePhone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="profilePhone" name="phone"
                                   value="{{ $user->phone ?? '' }}" placeholder="+1 (555) 123-4567">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="profileDepartment" class="form-label">Department</label>
                            <input type="text" class="form-control" id="profileDepartment" name="department"
                                   value="{{ $user->department ?? '' }}" placeholder="e.g., IT, HR, Finance">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="form-section mb-4">
                    <h6 class="section-title">
                        <i class="fa fa-info-circle text-info"></i> Additional Information
                    </h6>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="profilePosition" class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="profilePosition" name="position"
                                   value="{{ $user->position ?? '' }}" placeholder="e.g., Software Developer">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="profileLocation" class="form-label">Location</label>
                            <input type="text" class="form-control" id="profileLocation" name="location"
                                   value="{{ $user->location ?? '' }}" placeholder="e.g., New York, NY">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="profileBio" class="form-label">Bio</label>
                        <textarea class="form-control" id="profileBio" name="bio" rows="3"
                                  placeholder="Tell us about yourself...">{{ $user->bio ?? '' }}</textarea>
                        <small class="text-muted">Maximum 500 characters</small>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <!-- Account Status Display -->
                <div class="form-section">
                    <h6 class="section-title">
                        <i class="fa fa-shield text-warning"></i> Account Status
                    </h6>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="status-display">
                                <label>Account Created:</label>
                                <span class="badge bg-primary">{{ $user->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="status-display">
                                <label>Email Status:</label>
                                @if($user->email_verified_at)
                                    <span class="badge bg-success">
                                        <i class="fa fa-check"></i> Verified
                                    </span>
                                @else
                                    <span class="badge bg-warning">
                                        <i class="fa fa-clock"></i> Pending
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="status-display">
                                <label>Current Roles:</label>
                                <div>
                                    @foreach ($user->getRoleNames() as $role)
                                        <span class="badge role-badge role-{{ strtolower($role) }} me-1">{{ $role }}</span>
                                    @endforeach
                                    @if($user->getRoleNames()->isEmpty())
                                        <span class="text-muted">No roles assigned</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="status-display">
                                <label>Last Login:</label>
                                <span class="text-muted">{{ $user->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="form-actions mt-4 pt-3 border-top">
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="fa fa-times"></i> Cancel
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Update Profile
            </button>
        </div>
    </div>
</form>

<style>
.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #e9ecef;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
}

.profile-avatar:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

.current-photo {
    position: relative;
    display: inline-block;
}

.photo-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    cursor: pointer;
}

.current-photo:hover .photo-overlay {
    opacity: 1;
}

.photo-overlay i {
    color: white;
    font-size: 1.5rem;
}

.profile-upload-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 2rem;
    border-radius: 15px;
    border: 1px solid #dee2e6;
    height: fit-content;
    text-align: center;
}

.profile-form-section {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 15px;
    border: 1px solid #dee2e6;
}

.form-section {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.section-title {
    color: #495057;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-control {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
    padding: 0.75rem 1rem;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.form-control.is-invalid {
    border-color: #dc3545;
}

.form-control.is-valid {
    border-color: #28a745;
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
}

.status-display {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    margin-bottom: 0.5rem;
}

.status-display label {
    font-weight: 600;
    color: #495057;
    margin: 0;
    font-size: 0.9rem;
}

.role-badge {
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.upload-controls {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    flex-wrap: wrap;
}

.form-actions {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    margin: 0 -2rem -2rem -2rem;
    padding: 1.5rem 2rem;
    border-radius: 0 0 15px 15px;
}

.btn {
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

@media (max-width: 768px) {
    .profile-form-section,
    .profile-upload-section {
        padding: 1.5rem;
    }

    .status-display {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .upload-controls {
        flex-direction: column;
    }
}
</style>

<script>
// Form submission handler
document.getElementById('profileEditForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Clear previous validation states
    clearProfileValidation();

    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Updating...';
    submitBtn.disabled = true;

    // Validate form
    if (!validateProfileForm()) {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        return;
    }

    // Prepare form data
    const formData = new FormData(this);

    // Submit form
    if (typeof submitProfileUpdate === 'function') {
        submitProfileUpdate(formData, {{ $user->id }});
    } else {
        submitMyProfileUpdate(formData);
    }
});

// Form validation
function validateProfileForm() {
    let isValid = true;

    // Name validation
    const name = document.getElementById('profileName');
    if (!name.value.trim()) {
        showProfileFieldError(name, 'Name is required');
        isValid = false;
    } else if (name.value.trim().length < 2) {
        showProfileFieldError(name, 'Name must be at least 2 characters');
        isValid = false;
    }

    // Email validation
    const email = document.getElementById('profileEmail');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim()) {
        showProfileFieldError(email, 'Email is required');
        isValid = false;
    } else if (!emailRegex.test(email.value)) {
        showProfileFieldError(email, 'Please enter a valid email address');
        isValid = false;
    }

    // Bio length validation
    const bio = document.getElementById('profileBio');
    if (bio.value.length > 500) {
        showProfileFieldError(bio, 'Bio must not exceed 500 characters');
        isValid = false;
    }

    return isValid;
}

// Show field error
function showProfileFieldError(field, message) {
    field.classList.add('is-invalid');
    const feedback = field.parentNode.querySelector('.invalid-feedback');
    if (feedback) {
        feedback.textContent = message;
        feedback.style.display = 'block';
    }
}

// Clear validation states
function clearProfileValidation() {
    document.querySelectorAll('#profileEditForm .form-control').forEach(field => {
        field.classList.remove('is-invalid', 'is-valid');
    });

    document.querySelectorAll('#profileEditForm .invalid-feedback').forEach(feedback => {
        feedback.style.display = 'none';
    });
}

// Preview uploaded image
function previewProfileImage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];

        // File size validation (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('File size must be less than 2MB');
            input.value = '';
            return;
        }

        // File type validation
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            alert('Please select a valid image file (JPG, PNG, GIF)');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profileAvatar').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

// Remove photo
function removeProfilePhoto() {
    document.getElementById('profileAvatar').src = '{{ asset("images/user.png") }}';
    document.getElementById('profilePhotoUpload').value = '';
}

// Character counter for bio
document.getElementById('profileBio').addEventListener('input', function() {
    const maxLength = 500;
    const currentLength = this.value.length;
    const remaining = maxLength - currentLength;

    const small = this.nextElementSibling;
    if (remaining < 0) {
        small.textContent = `Exceeds limit by ${Math.abs(remaining)} characters`;
        small.className = 'text-danger';
        this.classList.add('is-invalid');
    } else {
        small.textContent = `${remaining} characters remaining`;
        small.className = 'text-muted';
        this.classList.remove('is-invalid');
    }
});
</script>