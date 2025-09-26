<div class="user-details">
    <div class="row">
        <!-- User Profile Section -->
        <div class="col-md-4 text-center">
            <div class="profile-section">
                @if($user->profile_photo)
                    <img src="{{ asset('uploads/profile_photos/' . $user->profile_photo) }}"
                         alt="Profile Photo"
                         class="profile-photo mb-3">
                @else
                    <img src="{{ asset('images/user.png') }}"
                         alt="Default Avatar"
                         class="profile-photo mb-3">
                @endif

                <h4 class="user-name">{{ $user->name }}</h4>
                <p class="user-email text-muted">{{ $user->email }}</p>

                <!-- Status Badge -->
                <div class="mb-3">
                    @if($user->email_verified_at)
                        <span class="badge bg-success">
                            <i class="fa fa-check-circle"></i> Verified Account
                        </span>
                    @else
                        <span class="badge bg-warning">
                            <i class="fa fa-clock"></i> Pending Verification
                        </span>
                    @endif
                </div>

                <!-- Role Badges -->
                <div class="roles-section">
                    <h6>Assigned Roles:</h6>
                    @foreach ($user->getRoleNames() as $role)
                        <span class="badge role-badge role-{{ strtolower($role) }} me-1">{{ $role }}</span>
                    @endforeach
                    @if($user->getRoleNames()->isEmpty())
                        <span class="text-muted">No roles assigned</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- User Information Section -->
        <div class="col-md-8">
            <div class="info-sections">
                <!-- Basic Information -->
                <div class="info-section mb-4">
                    <h5 class="section-title">
                        <i class="fa fa-user text-primary"></i> Basic Information
                    </h5>
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Full Name:</label>
                            <span>{{ $user->name }}</span>
                        </div>
                        <div class="info-item">
                            <label>Email Address:</label>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="info-item">
                            <label>User ID:</label>
                            <span>#{{ $user->id }}</span>
                        </div>
                        <div class="info-item">
                            <label>Account Status:</label>
                            <span>
                                @if($user->email_verified_at)
                                    <span class="text-success"><i class="fa fa-check-circle"></i> Active</span>
                                @else
                                    <span class="text-warning"><i class="fa fa-clock"></i> Pending</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Account Details -->
                <div class="info-section mb-4">
                    <h5 class="section-title">
                        <i class="fa fa-calendar text-info"></i> Account Details
                    </h5>
                    <div class="info-grid">
                        <div class="info-item">
                            <label>Member Since:</label>
                            <span>{{ $user->created_at->format('F d, Y') }}</span>
                        </div>
                        <div class="info-item">
                            <label>Last Updated:</label>
                            <span>{{ $user->updated_at->diffForHumans() }}</span>
                        </div>
                        <div class="info-item">
                            <label>Email Verified:</label>
                            <span>
                                @if($user->email_verified_at)
                                    {{ $user->email_verified_at->format('F d, Y') }}
                                @else
                                    <span class="text-muted">Not verified</span>
                                @endif
                            </span>
                        </div>
                        <div class="info-item">
                            <label>Account Age:</label>
                            <span>{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Permissions & Access -->
                <div class="info-section mb-4">
                    <h5 class="section-title">
                        <i class="fa fa-shield text-success"></i> Permissions & Access
                    </h5>
                    <div class="permissions-list">
                        @if($user->getRoleNames()->isNotEmpty())
                            @foreach ($user->getRoleNames() as $role)
                                <div class="permission-item">
                                    <span class="badge bg-primary me-2">{{ ucfirst($role) }}</span>
                                    <span class="text-muted">
                                        @switch($role)
                                            @case('admin')
                                                Full system access and management
                                                @break
                                            @case('user')
                                                Basic user access
                                                @break
                                            @case('manager')
                                                Asset management and user oversight
                                                @break
                                            @case('editor')
                                                Content editing and modification
                                                @break
                                            @default
                                                Custom role permissions
                                        @endswitch
                                    </span>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-warning">
                                <i class="fa fa-exclamation-triangle"></i>
                                No roles assigned to this user.
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Statistics -->
                <div class="info-section">
                    <h5 class="section-title">
                        <i class="fa fa-chart-line text-warning"></i> Activity Statistics
                    </h5>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number">{{ $user->created_at->diffInDays(now()) }}</div>
                            <div class="stat-label">Days Active</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $user->getRoleNames()->count() }}</div>
                            <div class="stat-label">Assigned Roles</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">
                                @if($user->email_verified_at)
                                    100%
                                @else
                                    0%
                                @endif
                            </div>
                            <div class="stat-label">Profile Complete</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $user->updated_at->diffInDays($user->created_at) }}</div>
                            <div class="stat-label">Profile Updates</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.profile-photo {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #e9ecef;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.user-name {
    color: #495057;
    margin-bottom: 0.5rem;
}

.user-email {
    font-size: 1rem;
    margin-bottom: 1rem;
}

.profile-section {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.roles-section h6 {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
}

.role-badge {
    font-size: 0.75rem;
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
}

.info-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.section-title {
    color: #495057;
    font-size: 1.1rem;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #e9ecef;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 0.75rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid #e9ecef;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item label {
    font-weight: 600;
    color: #495057;
    margin: 0;
    min-width: 130px;
}

.info-item span {
    color: #6c757d;
    text-align: right;
}

.permission-item {
    padding: 0.75rem 0;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    align-items: center;
}

.permission-item:last-child {
    border-bottom: none;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    gap: 1rem;
}

.stat-item {
    text-align: center;
    padding: 1rem;
    background: white;
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: bold;
    color: #495057;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.8rem;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

@media (max-width: 768px) {
    .info-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.25rem;
    }

    .info-item span {
        text-align: left;
    }

    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>