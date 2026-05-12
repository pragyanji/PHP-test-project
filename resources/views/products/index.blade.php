<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home — My App</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="antialiased">
    <div
        style="max-width:900px;margin:0 auto;padding:2rem;font-family:system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;">
        <h1 style="font-size:1.75rem;margin-bottom:0.5rem;">Welcome to My App</h1>
        <p style="color:#6b7280;margin-bottom:1rem;">A simple home page built with Blade.</p>
        <hr style="margin:1.5rem 0;border:none;border-top:1px solid #e5e7eb">

        <section>
            <h2 style="font-size:1.25rem;margin-bottom:0.5rem;">Quick Links</h2>
            <ul style="padding-left:1.25rem;color:#374151">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/product/create') }}">Create Product</a></li>
                <li><a href="{{ url('/product/details') }}">Products Details</a></li>
                <li><a href="{{ url('/user/login') }}">Login</a></li>
                <li><a href="{{ url('/user/register') }}">Register</a></li>
            </ul>
        </section>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
