<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — My App</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: #333;
        }

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

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        .hero {
            background: white;
            padding: 4rem 2rem;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 3rem;
            text-align: center;
        }

        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 0.5rem;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .profile-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            padding: 2rem;
        }

        .profile-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(102, 126, 234, 0.2);
        }

        .profile-card h3 {
            font-size: 0.9rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .profile-card p {
            font-size: 1.3rem;
            color: #1f2937;
            font-weight: 600;
            word-break: break-word;
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #1f2937;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 1rem;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.4);
        }

        .logout-btn {
            background: linear-gradient(135deg, #f93b1d 0%, #ea1e63 100%);
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(249, 59, 29, 0.4);
        }

        footer {
            background: #1f2937;
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 3rem;
        }
    </style>
</head>

<body class="antialiased">
    @includeIf('common.base')

    <div class="container">
        <div class="hero">
            <h1>👋 Welcome, {{ auth()->user()->name }}!</h1>
            <p>Here's your account information</p>
        </div>

        <h2 class="section-title">📋 Your Profile Information</h2>
        <div class="profile-grid">
            <div class="profile-card">
                <h3>Full Name</h3>
                <p>{{ auth()->user()->name }}</p>
            </div>
            <div class="profile-card">
                <h3>Email Address</h3>
                <p>{{ auth()->user()->email }}</p>
            </div>
            <div class="profile-card">
                <h3>Member Since</h3>
                <p>{{ auth()->user()->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" style="margin-top: 2rem;">
            @csrf
            <button type="submit" class="logout-btn">
                🚪 Logout
            </button>
        </form>
    </div>

    <footer>
        <p>&copy; 2026 My App. All rights reserved. | Built with ❤️ using Laravel & Blade</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
