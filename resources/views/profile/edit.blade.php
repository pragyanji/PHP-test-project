<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile Settings — IMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
            color: #333;
        }

        /* ─── Navigation Bar ─── */
        nav {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1.2rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        nav > div {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            gap: 3rem;
            align-items: center;
            justify-content: space-between;
        }

        nav a.logo {
            color: white;
            font-weight: 800;
            text-decoration: none;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }

        nav ul {
            display: flex;
            gap: 2.5rem;
            list-style: none;
            flex: 1;
        }

        nav a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 0;
            border-bottom: 2px solid transparent;
        }

        nav a:hover {
            color: white;
            border-bottom-color: white;
        }

        .nav-auth {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nav-auth-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-weight: 600;
            padding: 0.45rem 1.2rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            border: 1.5px solid rgba(255, 255, 255, 0.3);
        }

        .nav-auth-link:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.6);
            color: white;
        }

        .nav-auth-register {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .nav-auth-register:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .nav-user-menu {
            position: relative;
        }

        .nav-user-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.12);
            border: 1.5px solid rgba(255, 255, 255, 0.25);
            border-radius: 8px;
            padding: 0.35rem 0.75rem 0.35rem 0.35rem;
            cursor: pointer;
            color: white;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-user-button:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .nav-user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .nav-dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 0.5rem);
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            min-width: 180px;
            overflow: hidden;
            z-index: 1001;
        }

        .nav-user-menu.open .nav-dropdown {
            display: block;
            animation: dropdownFade 0.2s ease;
        }

        @keyframes dropdownFade {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .nav-dropdown a,
        .nav-dropdown-logout {
            display: block;
            width: 100%;
            padding: 0.75rem 1.25rem;
            color: #374151;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            border: none;
            background: none;
            cursor: pointer;
            text-align: left;
            transition: background 0.2s ease;
        }

        .nav-dropdown a:hover,
        .nav-dropdown-logout:hover {
            background: #f3f4f6;
            color: #667eea;
        }

        /* ─── Profile Layout ─── */
        .profile-container {
            max-width: 850px;
            margin: 3rem auto;
            padding: 0 1.5rem;
        }

        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 2.5rem;
            color: white;
            margin-bottom: 2rem;
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.25);
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
        }

        .profile-header-content {
            display: flex;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .profile-avatar-large {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            border: 2.5px solid rgba(255, 255, 255, 0.45);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 800;
            color: white;
            margin-right: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .profile-title-text h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .profile-title-text p {
            font-size: 0.95rem;
            opacity: 0.85;
        }

        @media (max-width: 640px) {
            .profile-header-content {
                flex-direction: column;
                text-align: center;
            }
            .profile-avatar-large {
                margin-right: 0;
                margin-bottom: 1rem;
            }
        }

        /* ─── Settings Cards ─── */
        .settings-card {
            background: white;
            border-radius: 16px;
            padding: 2.2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            margin-bottom: 2rem;
            border: 1px solid #eef2f6;
            transition: all 0.3s ease;
        }

        .settings-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
        }

        .card-header {
            margin-bottom: 2rem;
            border-bottom: 1px solid #f3f4f6;
            padding-bottom: 1rem;
        }

        .card-header h2 {
            font-size: 1.25rem;
            color: #1f2937;
            font-weight: 700;
            margin-bottom: 0.35rem;
        }

        .card-header p {
            font-size: 0.9rem;
            color: #6b7280;
            line-height: 1.5;
        }

        /* ─── Forms & Form Groups ─── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group-full {
            grid-column: span 2;
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            .form-group-full {
                grid-column: span 1;
            }
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #4b5563;
            margin-bottom: 0.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
        }

        .form-control.is-invalid {
            border-color: #ef4444;
            background-color: #fffafb;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
        }

        .error-feedback {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.35rem;
            font-weight: 500;
        }

        /* ─── Buttons ─── */
        .btn {
            padding: 0.8rem 1.8rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.35);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #4b5563;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
            color: #1f2937;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(239, 68, 68, 0.3);
        }

        /* ─── Danger Card (Special Card Style) ─── */
        .danger-card {
            border: 1.5px dashed #fca5a5;
            background: #fff8f8;
        }

        .danger-card .card-header {
            border-bottom-color: #fee2e2;
        }

        /* ─── Alerts & Banners ─── */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .alert-info {
            background: #fef3c7;
            color: #92400e;
            border-left: 4px solid #f59e0b;
        }

        /* ─── Modal Overlay and Card ─── */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-card {
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }

        .modal-overlay.open .modal-card {
            transform: scale(1);
        }

        .modal-card h3 {
            font-size: 1.3rem;
            color: #1f2937;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .modal-card p {
            color: #6b7280;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    @includeIf('common.base')

    <div class="profile-container">
        <!-- Profile Page Header Banner -->
        <div class="profile-header">
            <div class="profile-header-content">
                <div class="profile-avatar-large">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="profile-title-text">
                    <h1 style="display: flex; align-items: center; gap: 0.75rem;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="url(#profileHeaderGradient)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                            <defs>
                                <linearGradient id="profileHeaderGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#667eea" />
                                    <stop offset="100%" stop-color="#764ba2" />
                                </linearGradient>
                            </defs>
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                        <span>Profile Settings</span>
                    </h1>
                    <p>Manage your account credentials, security preferences, and details.</p>
                </div>
            </div>
        </div>

        <!-- Forms Action Alerts -->
        @if (session('status') === 'profile-updated')
            <div class="alert alert-success">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Profile details updated successfully!</span>
            </div>
        @endif

        @if (session('status') === 'password-updated')
            <div class="alert alert-success">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Your password has been changed successfully.</span>
            </div>
        @endif

        <!-- Form 1: Profile Information -->
        <div class="settings-card">
            <div class="card-header">
                <h2 style="display: flex; align-items: center; gap: 0.5rem;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span>Profile Information</span>
                </h2>
                <p>Update your account's public name and primary email address.</p>
            </div>

            <form method="post" action="{{ route('profile.update', auth()->id()) }}">
                @csrf
                @method('patch')

                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autocomplete="name">
                        @error('name')
                            <div class="error-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="email">
                        @error('email')
                            <div class="error-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="alert alert-info">
                        <div style="flex: 1;">
                            <span style="font-weight: 600;">Your email address is unverified.</span>
                            <form id="send-verification" method="post" action="{{ route('verification.send') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-secondary" style="padding: 0.3rem 0.7rem; font-size: 0.8rem; margin-left: 0.5rem;">
                                    Re-send verification email
                                </button>
                            </form>
                        </div>
                    </div>
                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success" style="margin-top: -1rem;">
                            <span>A new verification link has been sent to your email address.</span>
                        </div>
                    @endif
                @endif

                <div class="form-actions" style="justify-content: flex-end;">
                    <button type="submit" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Form 2: Password Update -->
        <div class="settings-card">
            <div class="card-header">
                <h2 style="display: flex; align-items: center; gap: 0.5rem;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#667eea" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <span>Security Settings</span>
                </h2>
                <p>Change your account password. Ensure your password is strong and distinct from other platforms.</p>
            </div>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="update_password_current_password">Current Password</label>
                    <input type="password" id="update_password_current_password" name="current_password" class="form-control {{ $errors->updatePassword->has('current_password') ? 'is-invalid' : '' }}" autocomplete="current-password">
                    @if ($errors->updatePassword->has('current_password'))
                        <div class="error-feedback">{{ $errors->updatePassword->first('current_password') }}</div>
                    @endif
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="update_password_password">New Password</label>
                        <input type="password" id="update_password_password" name="password" class="form-control {{ $errors->updatePassword->has('password') ? 'is-invalid' : '' }}" autocomplete="new-password">
                        @if ($errors->updatePassword->has('password'))
                            <div class="error-feedback">{{ $errors->updatePassword->first('password') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="update_password_password_confirmation">Confirm Password</label>
                        <input type="password" id="update_password_password_confirmation" name="password_confirmation" class="form-control {{ $errors->updatePassword->has('password_confirmation') ? 'is-invalid' : '' }}" autocomplete="new-password">
                        @if ($errors->updatePassword->has('password_confirmation'))
                            <div class="error-feedback">{{ $errors->updatePassword->first('password_confirmation') }}</div>
                        @endif
                    </div>
                </div>

                <div class="form-actions" style="justify-content: flex-end;">
                    <button type="submit" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
                        </svg>
                        Update Password
                    </button>
                </div>
            </form>
        </div>

        <!-- Form 3: Delete Account (Danger Zone) -->
        <div class="settings-card danger-card">
            <div class="card-header">
                <h2 style="color: #b91c1c; display: flex; align-items: center; gap: 0.5rem;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#b91c1c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                    <span>Danger Zone</span>
                </h2>
                <p style="color: #7f1d1d;">Permanently delete your account and remove all data from our inventory management system. This process is irreversible.</p>
            </div>

            <div class="form-actions" style="margin-top: 0; justify-content: flex-end;">
                <button type="button" class="btn btn-danger" onclick="openDeleteModal()" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                    Delete Account
                </button>
            </div>
        </div>
    </div>

    <!-- Account Deletion Confirmation Modal -->
    <div id="delete-modal" class="modal-overlay">
        <div class="modal-card">
            <h3>Are you absolutely sure?</h3>
            <p>Once your account is deleted, all of its resources, items, and log records will be permanently removed. Please enter your password below to confirm this action.</p>
            
            <form method="post" action="{{ route('profile.destroy', auth()->id()) }}">
                @csrf
                @method('delete')
                
                <div class="form-group">
                    <label for="delete-password">Confirm Password</label>
                    <input type="password" id="delete-password" name="password" class="form-control {{ $errors->userDeletion->has('password') ? 'is-invalid' : '' }}" placeholder="Enter your current password" required>
                    @if ($errors->userDeletion->has('password'))
                        <div class="error-feedback">{{ $errors->userDeletion->first('password') }}</div>
                    @endif
                </div>
                
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete Account</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDeleteModal() {
            const modal = document.getElementById('delete-modal');
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.add('open');
                document.getElementById('delete-password').focus();
            }, 10);
        }

        function closeDeleteModal() {
            const modal = document.getElementById('delete-modal');
            modal.classList.remove('open');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        }

        // Close modal when clicking outside of modal card
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('delete-modal');
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeDeleteModal();
                }
            });
        });
    </script>

    <!-- Keep delete modal open if there are deletion errors -->
    @if ($errors->userDeletion->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                openDeleteModal();
            });
        </script>
    @endif
</body>

</html>
