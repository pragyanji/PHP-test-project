<x-guest-layout>
    <div class="auth-title">
        <h1>🔐 Login</h1>
        <p>Welcome back to My App</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="success-message" :status="session('status')" />

    <form method="POST" action="{{ route('login.user') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="error-message mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="error-message mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="checkbox-group">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me">{{ __('Remember me') }}</label>
        </div>

        <div class="form-actions">
            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('user.forgot-password') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif

            <button type="submit" class="btn-submit">
                {{ __('Log in') }}
            </button>
        </div>

        <div style="text-align: center; margin-top: 1.5rem; font-size: 0.9rem;">
            {{ __('No account?') }} <a class="auth-link" href="{{ route('user.register') }}">{{ __('Register here') }}</a>
        </div>
    </form>
</x-guest-layout>
