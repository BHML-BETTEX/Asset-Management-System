<form id="userEditForm" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <!-- Profile Photo Section -->
        <div class="col-md-4">
            <div class="profile-upload-section">
                <h6 class="mb-3">Profile Photo</h6>
                <div class="text-center">
                    <div class="current-photo mb-3">
                        @if($user->profile_photo)
                            <img src="{{ asset('uploads/profile_photos/' . $user->profile_photo) }}"
                                 alt="Current Photo"
                                 class="current-avatar"
                                 id="currentAvatar">
                        @else
                            <img src="{{ asset('images/user.png') }}"
                                 alt="Default Avatar"
                                 class="current-avatar"
                                 id="currentAvatar">
                        @endif
                    </div>

                    <div class="upload-controls">
                        <label for="profilePhoto" class="btn btn-outline-primary btn-sm">
                            <i class="fa fa-camera"></i> Change Photo
                        </label>
                        <input type="file" id="profilePhoto" name="profile_photo"
                               accept="image/*" style="display: none;" onchange="previewImage(this)">

                        @if($user->profile_photo)
                            <button type="button" class="btn btn-outline-danger btn-sm ms-2" onclick="removePhoto()">
                                <i class="fa fa-trash"></i> Remove
                            </button>
                        @endif
                    </div>
                    <small class="text-muted d-block mt-2">JPG, PNG, GIF up to 2MB</small>
                </div>
            </div>
        </div>

        <!-- Form Fields Section -->
        <div class="col-md-8">
            <div class="form-fields">
                <!-- Basic Information -->
                <div class="form-section mb-4">
                    <h6 class="section-title">
                        <i class="fa fa-user text-primary"></i> Basic Information
                    </h6>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editName" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editName" name="name"
                                   value="{{ $user->name }}" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="editEmail" class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="editEmail" name="email"
                                   value="{{ $user->email }}" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="form-section mb-4">
                    <h6 class="section-title">
                        <i class="fa fa-lock text-warning"></i> Security Settings
                    </h6>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editPassword" class="form-label">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="editPassword" name="password"
                                       placeholder="Leave blank to keep current password">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('editPassword')">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted">Minimum 8 characters required</small>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="editPasswordConfirm" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="editPasswordConfirm" name="password_confirmation"
                                   placeholder="Confirm new password">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>

                <!-- Role Assignment -->
                <div class="form-section mb-4">
                    <h6 class="section-title">
                        <i class="fa fa-shield text-success"></i> Role Assignment
                    </h6>

                    <div class="role-selection">
                        <label class="form-label">Assign Roles <span class="text-danger">*</span></label>
                        <div class="role-options">
                            @foreach($roles as $role)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="role[]"
                                           id="role_{{ $role }}" value="{{ $role }}"
                                           {{ $user->hasRole($role) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role_{{ $role }}">
                                        <span class="role-badge role-{{ strtolower($role) }}">
                                            {{ ucfirst($role) }}
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <!-- Account Status -->
                <div class="form-section">
                    <h6 class="section-title">
                        <i class="fa fa-info-circle text-info"></i> Account Information
                    </h6>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-display">
                                <label>Account Created:</label>
                                <span>{{ $user->created_at->format('F d, Y') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-display">
                                <label>Email Verification:</label>
                                <span>
                                    @if($user->email_verified_at)
                                        <span class="badge bg-success">Verified</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </span>
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
            <button type="submit" class="btn btn-success">
                <i class="fa fa-save"></i> Update User
            </button>
        </div>
    </div>
</form>

<style>
.current-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #e9ecef;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.profile-upload-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
    border: 1px solid #e9ecef;
    height: fit-content;
}

.form-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.section-title {
    color: #495057;
    font-size: 1rem;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
}

.form-control {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
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

.role-options {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    padding: 1rem;
    background: white;
    border-radius: 8px;
    border: 2px solid #e9ecef;
}

.form-check-label {
    cursor: pointer;
}

.role-badge {
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.form-check-input:checked + label .role-badge {
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.info-display {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background: white;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    margin-bottom: 0.5rem;
}

.info-display label {
    font-weight: 600;
    color: #495057;
    margin: 0;
}

.form-actions {
    background: #f8f9fa;
    margin: 0 -1.5rem -1.5rem -1.5rem;
    padding: 1rem 1.5rem;
    border-radius: 0 0 10px 10px;
}

.btn {
    border-radius: 8px;
    padding: 0.5rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

@media (max-width: 768px) {
    .role-options {
        flex-direction: column;
    }

    .info-display {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.25rem;
    }
}
</style>

<script>
// Form submission handler
document.getElementById('userEditForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Clear previous validation states
    clearValidation();

    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Updating...';
    submitBtn.disabled = true;

    // Validate form
    if (!validateForm()) {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        return;
    }

    // Prepare form data
    const formData = new FormData(this);

    // Submit form
    submitUserUpdate(formData, {{ $user->id }});
});

// Form validation
function validateForm() {
    let isValid = true;

    // Name validation
    const name = document.getElementById('editName');
    if (!name.value.trim()) {
        showFieldError(name, 'Name is required');
        isValid = false;
    }

    // Email validation
    const email = document.getElementById('editEmail');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.value.trim()) {
        showFieldError(email, 'Email is required');
        isValid = false;
    } else if (!emailRegex.test(email.value)) {
        showFieldError(email, 'Please enter a valid email address');
        isValid = false;
    }

    // Password validation (only if provided)
    const password = document.getElementById('editPassword');
    const passwordConfirm = document.getElementById('editPasswordConfirm');

    if (password.value) {
        if (password.value.length < 8) {
            showFieldError(password, 'Password must be at least 8 characters');
            isValid = false;
        }

        if (password.value !== passwordConfirm.value) {
            showFieldError(passwordConfirm, 'Passwords do not match');
            isValid = false;
        }
    }

    // Role validation
    const roleCheckboxes = document.querySelectorAll('input[name="role[]"]');
    const roleChecked = Array.from(roleCheckboxes).some(cb => cb.checked);

    if (!roleChecked) {
        const roleContainer = document.querySelector('.role-options');
        roleContainer.style.borderColor = '#dc3545';
        roleContainer.insertAdjacentHTML('afterend', '<div class="text-danger small mt-1">Please select at least one role</div>');
        isValid = false;
    }

    return isValid;
}

// Show field error
function showFieldError(field, message) {
    field.classList.add('is-invalid');
    const feedback = field.parentNode.querySelector('.invalid-feedback');
    if (feedback) {
        feedback.textContent = message;
        feedback.style.display = 'block';
    }
}

// Clear validation states
function clearValidation() {
    // Clear field validation
    document.querySelectorAll('.form-control').forEach(field => {
        field.classList.remove('is-invalid', 'is-valid');
    });

    document.querySelectorAll('.invalid-feedback').forEach(feedback => {
        feedback.style.display = 'none';
    });

    // Clear role validation
    const roleContainer = document.querySelector('.role-options');
    roleContainer.style.borderColor = '#e9ecef';
    const roleError = roleContainer.parentNode.querySelector('.text-danger');
    if (roleError) {
        roleError.remove();
    }
}

// Preview uploaded image
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('currentAvatar').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Remove photo
function removePhoto() {
    document.getElementById('currentAvatar').src = '{{ asset("images/user.png") }}';
    document.getElementById('profilePhoto').value = '';
}

// Toggle password visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const btn = field.nextElementSibling.querySelector('i');

    if (field.type === 'password') {
        field.type = 'text';
        btn.classList.remove('fa-eye');
        btn.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        btn.classList.remove('fa-eye-slash');
        btn.classList.add('fa-eye');
    }
}
</script>