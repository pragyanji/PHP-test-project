<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product App</title>
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
            border-bottom: none;
        }

        .nav-dropdown a:hover,
        .nav-dropdown-logout:hover {
            background: #f3f4f6;
            color: #667eea;
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
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
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
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.4);
        }

        .section-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #1f2937;
            margin-top: 2rem;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 2.5rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(102, 126, 234, 0.2);
        }

        .product-image {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            font-weight: bold;
        }

        .product-content {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-card h3 {
            font-size: 1.3rem;
            margin-bottom: 0.75rem;
            color: #1f2937;
        }

        .product-card p {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
            flex: 1;
            line-height: 1.6;
        }

        .product-card a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .product-card a:hover {
            color: #764ba2;
            transform: translateX(5px);
        }

        /* Calendar widget styles */
        #calendar-widget {
            max-width: 1200px;
            margin: 0 auto 1.5rem; /* reduced bottom spacing to remove empty gap */
            padding: 0 2rem;
            display: flex;
            justify-content: center;
        }

        .calendar-iframe {
            width: 100%;
            max-width: 1000px;
            height: 720px; /* tuned height to fit content without large empty area */
            min-height: 520px;
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            display: block;
            overflow: hidden; /* no internal scrolling */
            background: white;
        }

        @media (max-width: 1024px) {
            .calendar-iframe {
                height: 520px;
            }
        }

        @media (max-width: 640px) {
            .calendar-iframe {
                height: 420px;
            }
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .feature-box {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .feature-box h4 {
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
            color: #1f2937;
        }

        .feature-box p {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.6;
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
            <h1>Welcome to IMS</h1>
            <h2>Inventory Management System (IMS)</h2>
            <p>Discover amazing products and manage your collection with ease. Browse our carefully curated selection of premium items.</p>
            <a href="{{ url('/product/create') }}" class="cta-button">+ Create New Product</a>
        </div>
        <div id="calendar-widget">
            <iframe id="nciframe" class="calendar-iframe" src="https://www.ashesh.com.np/calendar-widget/calendar.php?tithi=1&api=5643a506" frameborder="0"
                marginwidth="0" marginheight="0"
                allowtransparency="true"></iframe>
        </div>
        <section>
            <h2 class="section-title" style="display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #667eea;">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                Featured Products
            </h2>
            <p class="section-subtitle">Check out our latest collection and find what you're looking for</p>
            <?php $featuredProducts = \App\Models\Product::orderBy('id', 'desc')->take(4)->get(); ?>
            <div class="products-grid">
                @if($featuredProducts->count() > 0)
                    @foreach($featuredProducts as $product)
                        <div class="product-card">
                            <div class="product-image">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color: #667eea;">
                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                </svg>
                            </div>
                            <div class="product-content">
                                <h3>{{ $product->name }}</h3>
                                <p>{{ Str::limit($product->description, 80) }}</p>
                                <p style="margin-top:8px;font-weight:700;">Rs. {{ number_format($product->price, 2) }} · Qty: {{ $product->quantity }}</p>
                                <a href="{{ route('products.product_details') }}">View Details →</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="product-card">
                        <div class="product-image">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color: #667eea;">
                                <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                                <line x1="12" y1="18" x2="12.01" y2="18"></line>
                            </svg>
                        </div>
                        <div class="product-content">
                            <h3>Premium Electronics</h3>
                            <p>High quality product with excellent features and outstanding performance. Perfect for tech enthusiasts.</p>
                            <a href="{{ url('/product/details') }}">View Details →</a>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-image">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color: #667eea;">
                                <path d="M20.38 3.46L16 2.14a1 1 0 0 0-1.07.24L11 6h8l1.38-2.54a.5.5 0 0 0-.62-.73zM3 10v11a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V10H3z"></path>
                            </svg>
                        </div>
                        <div class="product-content">
                            <h3>Fashion Collection</h3>
                            <p>Premium selection for your everyday needs. Stylish, comfortable, and durable clothing for all occasions.</p>
                            <a href="{{ url('/product/details') }}">View Details →</a>
                        </div>
                    </div>
                    <div class="product-card">
                        <div class="product-image">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color: #667eea;">
                                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                            </svg>
                        </div>
                        <div class="product-content">
                            <h3>Innovation Hub</h3>
                            <p>Trusted by thousands of satisfied customers worldwide. Experience cutting-edge products and services.</p>
                            <a href="{{ url('/product/details') }}">View Details →</a>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>

    <footer>
        <p>&copy; 2026 IMS. All rights reserved. | Built using Laravel & Blade</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
