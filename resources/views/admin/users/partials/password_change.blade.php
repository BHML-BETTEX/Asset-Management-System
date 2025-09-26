<form id="changePasswordForm" method="POST">
    @csrf

    <div class="password-change-container">
        <!-- User Info -->
        <div class="user-info-header mb-4">
            <div class="d-flex align-items-center">
                <div class="user-avatar-small me-3">
                    @if($user->profile_photo)
                        <img src="{{ asset('uploads/profile_photos/' . $user->profile_photo) }}"
                             alt="User Avatar" class="avatar-img">
                    @else
                        <img src="{{ asset('images/user.png') }}" alt="User Avatar" class="avatar-img">
                    @endif
                </div>
                <div>
                    <h6 class="mb-1">{{ $user->name }}</h6>
                    <small class="text-muted">{{ $user->email }}</small>
                </div>
            </div>
        </div>

        <!-- Security Notice -->
        <div class="security-notice mb-4">
            <div class="alert alert-info border-0">
                <div class="d-flex align-items-start">
                    <i class="fa fa-info-circle fa-lg me-2 mt-1"></i>
                    <div>
                        <h6 class="alert-heading mb-2">Password Security Guidelines</h6>
                        <ul class="mb-0 small">
                            <li>Use at least 8 characters</li>
                            <li>Include uppercase and lowercase letters</li>
                            <li>Add numbers and special characters</li>
                            <li>Avoid common words or personal information</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Password Fields -->
        <div class="password-fields">
            <!-- Current Password -->
            <div class="form-section mb-4">
                <h6 class="section-title">
                    <i class="fa fa-lock text-warning"></i> Current Password
                </h6>
                <div class="password-input-group">
                    <input type="password" class="form-control" id="currentPassword" name="current_password"
                           placeholder="Enter your current password" required>
                    <button class="password-toggle" type="button" onclick="togglePasswordField('currentPassword')">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
                <div class="invalid-feedback"></div>
            </div>

            <!-- New Password -->
            <div class="form-section mb-4">
                <h6 class="section-title">
                    <i class="fa fa-key text-success"></i> New Password
                </h6>
                <div class="password-input-group">
                    <input type="password" class="form-control" id="newPassword" name="new_password"
                           placeholder="Enter your new password" required>
                    <button class="password-toggle" type="button" onclick="togglePasswordField('newPassword')">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
                <div class="password-strength mt-2">
                    <div class="strength-bar">
                        <div class="strength-fill" id="strengthFill"></div>
                    </div>
                    <small class="strength-text" id="strengthText">Password strength will appear here</small>
                </div>
                <div class="invalid-feedback"></div>
            </div>

            <!-- Confirm Password -->
            <div class="form-section mb-4">
                <h6 class="section-title">
                    <i class="fa fa-check-circle text-primary"></i> Confirm New Password
                </h6>
                <div class="password-input-group">
                    <input type="password" class="form-control" id="confirmPassword" name="new_password_confirmation"
                           placeholder="Confirm your new password" required>
                    <button class="password-toggle" type="button" onclick="togglePasswordField('confirmPassword')">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
                <div class="password-match-indicator mt-2" id="passwordMatch" style="display: none;">
                    <small class="match-text"></small>
                </div>
                <div class="invalid-feedback"></div>
            </div>
        </div>

        <!-- Additional Security Options -->
        <div class="security-options mb-4">
            <div class="form-section">
                <h6 class="section-title">
                    <i class="fa fa-shield text-info"></i> Security Options
                </h6>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="logoutAllDevices" name="logout_all_devices">
                    <label class="form-check-label" for="logoutAllDevices">
                        <strong>Log out from all devices</strong>
                        <br><small class="text-muted">This will sign you out from all browsers and devices</small>
                    </label>
                </div>
            </div>
        </div>

        <!-- Last Password Change Info -->
        <div class="password-history mb-4">
            <div class="alert alert-light border">
                <div class="d-flex align-items-center">
                    <i class="fa fa-history text-muted me-2"></i>
                    <div>
                        <small class="text-muted">
                            <strong>Last password change:</strong>
                            {{ $user->updated_at->format('M d, Y \a\t H:i') }}
                            ({{ $user->updated_at->diffForHumans() }})
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Actions -->
    <div class="form-actions pt-3 border-top">
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="fa fa-times"></i> Cancel
            </button>
            <button type="submit" class="btn btn-warning">
                <i class="fa fa-key"></i> Change Password
            </button>
        </div>
    </div>
</form>

<style>
.password-change-container {
    padding: 1rem;
}

.user-avatar-small {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid #e9ecef;
}

.avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-info-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    padding: 1rem;
    border-radius: 10px;
    border: 1px solid #dee2e6;
}

.security-notice .alert {
    background: linear-gradient(135deg, #cff4fc 0%, #b6effb 100%);
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

.password-input-group {
    position: relative;
    display: flex;
    align-items: center;
}

.password-input-group .form-control {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
    padding: 0.75rem 3rem 0.75rem 1rem;
    font-family: 'Segoe UI', monospace;
}

.password-input-group .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.password-toggle {
    position: absolute;
    right: 0.75rem;
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: all 0.3s ease;
    z-index: 5;
}

.password-toggle:hover {
    color: #495057;
    background: #f8f9fa;
}

.password-strength {
    margin-top: 0.5rem;
}

.strength-bar {
    width: 100%;
    height: 6px;
    background: #e9ecef;
    border-radius: 3px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.strength-fill {
    height: 100%;
    width: 0%;
    border-radius: 3px;
    transition: all 0.3s ease;
}

.strength-weak { background: #dc3545; }
.strength-fair { background: #ffc107; }
.strength-good { background: #28a745; }
.strength-strong { background: #17a2b8; }

.strength-text {
    display: block;
    font-size: 0.85rem;
    font-weight: 500;
}

.password-match-indicator {
    padding: 0.5rem;
    border-radius: 6px;
    border-left: 4px solid;
}

.match-success {
    background: #d4edda;
    border-color: #28a745;
    color: #155724;
}

.match-error {
    background: #f8d7da;
    border-color: #dc3545;
    color: #721c24;
}

.security-options .form-check {
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.security-options .form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

.password-history .alert {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.form-actions {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    margin: 0 -1rem -1rem -1rem;
    padding: 1rem;
    border-radius: 0 0 10px 10px;
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
    .password-change-container {
        padding: 0.5rem;
    }

    .form-section {
        padding: 1rem;
    }

    .password-input-group .form-control {
        padding-right: 2.5rem;
    }
}
</style>

<script>
// Form submission handler
document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Clear previous validation states
    clearPasswordValidation();

    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Changing...';
    submitBtn.disabled = true;

    // Validate form
    if (!validatePasswordForm()) {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        return;
    }

    // Prepare form data
    const formData = new FormData(this);

    // Submit form
    if (typeof submitPasswordChange === 'function') {
        submitPasswordChange(formData, {{ $user->id }});
    } else {
        submitMyPasswordChange(formData);
    }
});

// Form validation
function validatePasswordForm() {
    let isValid = true;

    // Current password validation
    const currentPassword = document.getElementById('currentPassword');
    if (!currentPassword.value.trim()) {
        showPasswordFieldError(currentPassword, 'Current password is required');
        isValid = false;
    }

    // New password validation
    const newPassword = document.getElementById('newPassword');
    if (!newPassword.value.trim()) {
        showPasswordFieldError(newPassword, 'New password is required');
        isValid = false;
    } else if (newPassword.value.length < 8) {
        showPasswordFieldError(newPassword, 'New password must be at least 8 characters');
        isValid = false;
    }

    // Confirm password validation
    const confirmPassword = document.getElementById('confirmPassword');
    if (!confirmPassword.value.trim()) {
        showPasswordFieldError(confirmPassword, 'Please confirm your new password');
        isValid = false;
    } else if (newPassword.value !== confirmPassword.value) {
        showPasswordFieldError(confirmPassword, 'Passwords do not match');
        isValid = false;
    }

    // Check if new password is different from current
    if (currentPassword.value === newPassword.value) {
        showPasswordFieldError(newPassword, 'New password must be different from current password');
        isValid = false;
    }

    return isValid;
}

// Show field error
function showPasswordFieldError(field, message) {
    field.classList.add('is-invalid');
    field.style.borderColor = '#dc3545';
    const feedback = field.parentNode.parentNode.querySelector('.invalid-feedback');
    if (feedback) {
        feedback.textContent = message;
        feedback.style.display = 'block';
    }
}

// Clear validation states
function clearPasswordValidation() {
    document.querySelectorAll('#changePasswordForm .form-control').forEach(field => {
        field.classList.remove('is-invalid', 'is-valid');
        field.style.borderColor = '#e9ecef';
    });

    document.querySelectorAll('#changePasswordForm .invalid-feedback').forEach(feedback => {
        feedback.style.display = 'none';
    });
}

// Toggle password visibility
function togglePasswordField(fieldId) {
    const field = document.getElementById(fieldId);
    const btn = field.parentNode.querySelector('.password-toggle i');

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

// Password strength checker
document.getElementById('newPassword').addEventListener('input', function() {
    const password = this.value;
    const strengthFill = document.getElementById('strengthFill');
    const strengthText = document.getElementById('strengthText');

    let strength = 0;
    let strengthLabel = '';
    let strengthClass = '';

    if (password.length >= 8) strength += 25;
    if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 25;
    if (/\d/.test(password)) strength += 25;
    if (/[^a-zA-Z\d]/.test(password)) strength += 25;

    if (strength === 0) {
        strengthLabel = 'Enter a password';
        strengthClass = '';
    } else if (strength <= 25) {
        strengthLabel = 'Weak password';
        strengthClass = 'strength-weak';
    } else if (strength <= 50) {
        strengthLabel = 'Fair password';
        strengthClass = 'strength-fair';
    } else if (strength <= 75) {
        strengthLabel = 'Good password';
        strengthClass = 'strength-good';
    } else {
        strengthLabel = 'Strong password';
        strengthClass = 'strength-strong';
    }

    strengthFill.style.width = strength + '%';
    strengthFill.className = 'strength-fill ' + strengthClass;
    strengthText.textContent = strengthLabel;
    strengthText.className = 'strength-text ' + strengthClass;
});

// Password match checker
document.getElementById('confirmPassword').addEventListener('input', function() {
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = this.value;
    const matchIndicator = document.getElementById('passwordMatch');
    const matchText = matchIndicator.querySelector('.match-text');

    if (confirmPassword.length > 0) {
        matchIndicator.style.display = 'block';

        if (newPassword === confirmPassword) {
            matchIndicator.className = 'password-match-indicator match-success';
            matchText.textContent = '✓ Passwords match';
        } else {
            matchIndicator.className = 'password-match-indicator match-error';
            matchText.textContent = '✗ Passwords do not match';
        }
    } else {
        matchIndicator.style.display = 'none';
    }
});

// Hide match indicator when new password changes
document.getElementById('newPassword').addEventListener('input', function() {
    const matchIndicator = document.getElementById('passwordMatch');
    matchIndicator.style.display = 'none';
    document.getElementById('confirmPassword').value = '';
});
</script>