<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            }

            .auth-container {
                width: 100%;
                max-width: 450px;
                padding: 2rem;
            }

            .auth-card {
                background: white;
                border-radius: 15px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                padding: 3rem 2rem;
            }

            .auth-logo {
                text-align: center;
                margin-bottom: 2rem;
            }

            .auth-logo a {
                display: inline-block;
                text-decoration: none;
            }

            .auth-title {
                text-align: center;
                margin-bottom: 2rem;
            }

            .auth-title h1 {
                font-size: 1.75rem;
                margin-bottom: 0.5rem;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .auth-title p {
                color: #666;
                font-size: 0.95rem;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 600;
                color: #1f2937;
                font-size: 0.9rem;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"],
            input[type="number"] {
                width: 100%;
                padding: 0.75rem;
                border: 2px solid #e5e7eb;
                border-radius: 8px;
                font-family: inherit;
                font-size: 0.95rem;
                transition: all 0.3s ease;
            }

            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="password"]:focus,
            input[type="number"]:focus {
                outline: none;
                border-color: #667eea;
                box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            }

            .checkbox-group {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin-bottom: 1.5rem;
            }

            input[type="checkbox"] {
                width: 18px;
                height: 18px;
                cursor: pointer;
                accent-color: #667eea;
            }

            .checkbox-group label {
                margin: 0;
                font-weight: normal;
                color: #666;
                cursor: pointer;
            }

            .form-actions {
                display: flex;
                gap: 1rem;
                align-items: center;
                justify-content: space-between;
                margin-top: 2rem;
                flex-wrap: wrap;
            }

            .btn-submit {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                padding: 0.75rem 2rem;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                font-size: 0.95rem;
            }

            .btn-submit:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 15px rgba(102, 126, 234, 0.4);
            }

            .auth-link {
                color: #667eea;
                text-decoration: none;
                font-weight: 600;
                font-size: 0.9rem;
                transition: all 0.3s ease;
            }

            .auth-link:hover {
                color: #764ba2;
            }

            .forgot-password-text {
                font-size: 0.85rem;
                color: #666;
                line-height: 1.6;
                margin-bottom: 1.5rem;
            }

            .error-message {
                background: #fee2e2;
                border-left: 4px solid #ef4444;
                color: #991b1b;
                padding: 0.75rem;
                border-radius: 6px;
                margin-bottom: 1.5rem;
                font-size: 0.9rem;
            }

            .success-message {
                background: #d1fae5;
                border-left: 4px solid #10b981;
                color: #065f46;
                padding: 0.75rem;
                border-radius: 6px;
                margin-bottom: 1.5rem;
                font-size: 0.9rem;
            }
        </style>
    </head>
    <body>
        <div class="auth-container">
            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
