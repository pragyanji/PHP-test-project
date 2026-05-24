<x-guest-layout>
    <div class="auth-title">
        <h1 style="display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #667eea;">
                <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
            </svg>
            Forgot Password
        </h1>
        <p>Reset your password</p>
    </div>

    <p class="forgot-password-text">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="success-message" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="error-message mt-2" />
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>

        <div style="text-align: center; margin-top: 1.5rem;">
            <a class="auth-link" href="{{ route('login') }}">{{ __('Back to login') }}</a>
        </div>
    </form>
</x-guest-layout>
