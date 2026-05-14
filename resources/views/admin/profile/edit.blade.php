@extends('admin_layout.app')

@section('content')
<style>
    .profile-page {
        padding: 30px 0;
        background: #f5f8fb;
        min-height: calc(100vh - 120px);
    }

    .profile-card {
        max-width: 760px;
        margin: 0 auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 10px 35px rgba(16, 24, 40, 0.08);
        overflow: hidden;
        border: 1px solid #eef2f7;
    }

    .profile-card-header {
        padding: 30px 35px;
        color: #fff;
    }

    .profile-card-header h2 {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .profile-card-header p {
        margin: 8px 0 0;
        font-size: 14px;
        color: rgba(255,255,255,0.75);
    }

    .profile-card-body {
        padding: 35px;
    }

    .profile-alert {
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 14px;
        margin-bottom: 22px;
        border: none;
    }

    .profile-alert-success {
        background: #e8fff1;
        color: #0f8a4b;
    }

    .profile-section-title {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin-bottom: 18px;
        padding-bottom: 10px;
        border-bottom: 1px solid #edf2f7;
    }

    .profile-group {
        margin-bottom: 22px;
    }

    .profile-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .profile-input-wrap {
        position: relative;
    }

    .profile-input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 15px;
        color: #9ca3af;
        pointer-events: none;
    }

    .profile-input {
        width: 100%;
        height: 52px;
        border: 1px solid #dbe3ec;
        border-radius: 12px;
        padding: 0 16px 0 42px;
        font-size: 15px;
        color: #111827;
        background: #fff;
        transition: all 0.25s ease;
    }

    .profile-input:focus {
        outline: none;
        border-color: #111827;
        box-shadow: 0 0 0 4px rgba(17, 24, 39, 0.08);
    }

    .profile-input::placeholder {
        color: #9ca3af;
    }

    .profile-help {
        margin-top: 8px;
        font-size: 12px;
        color: #6b7280;
    }

    .profile-error {
        display: block;
        margin-top: 8px;
        font-size: 12px;
        color: #dc2626;
        font-weight: 500;
    }

    .profile-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-top: 30px;
        flex-wrap: wrap;
        padding-top: 20px;
        border-top: 1px solid #edf2f7;
    }

    .profile-meta {
        font-size: 13px;
        color: #6b7280;
    }

    .profile-btn {
        border: none;
        border-radius: 12px;
        padding: 13px 24px;
        font-size: 14px;
        font-weight: 600;
        background: linear-gradient(135deg, #111827, #374151);
        color: #fff;
        transition: all 0.25s ease;
        box-shadow: 0 8px 18px rgba(17, 24, 39, 0.18);
    }

    .profile-btn:hover {
        transform: translateY(-1px);
        opacity: 0.96;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 768px) {
        .profile-page {
            padding: 20px 12px;
        }

        .profile-card-header,
        .profile-card-body {
            padding: 22px;
        }

        .profile-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .profile-actions {
            align-items: stretch;
        }

        .profile-btn {
            width: 100%;
        }
    }
</style>

<div class="profile-page">
    <div class="profile-card">
        <div class="profile-card-header">
            <h2>My Profile</h2>
            <p>Manage your account details, email address, and password securely.</p>
        </div>

        <div class="profile-card-body">
            @if(session('success'))
                <div class="profile-alert profile-alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <div class="profile-section-title">Basic Information</div>

                <div class="profile-grid">
                    <div class="profile-group">
                        <label class="profile-label">Full Name</label>
                        <div class="profile-input-wrap">
                            <span class="profile-input-icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <input
                                type="text"
                                name="name"
                                class="profile-input"
                                placeholder="Enter your full name"
                                value="{{ old('name', auth()->user()->name) }}"
                            >
                        </div>
                        @error('name')
                            <small class="profile-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="profile-group">
                        <label class="profile-label">Email Address</label>
                        <div class="profile-input-wrap">
                            <span class="profile-input-icon">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input
                                type="email"
                                name="email"
                                class="profile-input"
                                placeholder="Enter your email address"
                                value="{{ old('email', auth()->user()->email) }}"
                            >
                        </div>
                        @error('email')
                            <small class="profile-error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="profile-section-title mt-4">Change Password</div>

                <div class="profile-grid">
                    <div class="profile-group">
                        <label class="profile-label">New Password</label>
                        <div class="profile-input-wrap">
                            <span class="profile-input-icon">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input
                                type="password"
                                name="password"
                                class="profile-input"
                                placeholder="Enter new password"
                            >
                        </div>
                        <div class="profile-help">Leave blank if you do not want to change your password.</div>
                        @error('password')
                            <small class="profile-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="profile-group">
                        <label class="profile-label">Confirm New Password</label>
                        <div class="profile-input-wrap">
                            <span class="profile-input-icon">
                                <i class="fas fa-shield-alt"></i>
                            </span>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="profile-input"
                                placeholder="Confirm new password"
                            >
                        </div>
                    </div>
                </div>

                <div class="profile-actions">
                    <div class="profile-meta">
                        Logged in as: <strong>{{ auth()->user()->email }}</strong>
                    </div>

                    <button type="submit" class="profile-btn">
                        <i class="fas fa-save me-2"></i> Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection