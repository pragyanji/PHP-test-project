<x-guest-layout>
    <div class="auth-title">
        <h1>🔑 Forgot Password</h1>
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
