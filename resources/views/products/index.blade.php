<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home — My App</title>
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
    <nav>
        <div>
            <a href="{{ url('/') }}" class="logo"> My App</a>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/product/create') }}">Create Product</a></li>
                <li><a href="{{ url('/product/details') }}">Products</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="hero">
            <h1>Welcome to My App</h1>
            <p>Discover amazing products and manage your collection with ease. Browse our carefully curated selection of premium items.</p>
            <a href="{{ url('/product/create') }}" class="cta-button">+ Create New Product</a>
        </div>
        <div id="calendar-widget">
            <iframe id="nciframe" class="calendar-iframe" src="https://www.ashesh.com.np/calendar-widget/calendar.php?tithi=1&api=5643a506" frameborder="0"
                marginwidth="0" marginheight="0"
                allowtransparency="true"></iframe>
        </div>
        <section>
            <h2 class="section-title">✨ Featured Products</h2>
            <p class="section-subtitle">Check out our latest collection and find what you're looking for</p>
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-image">📱</div>
                    <div class="product-content">
                        <h3>Premium Electronics</h3>
                        <p>High quality product with excellent features and outstanding performance. Perfect for tech enthusiasts.</p>
                        <a href="{{ url('/product/details') }}">View Details →</a>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">👔</div>
                    <div class="product-content">
                        <h3>Fashion Collection</h3>
                        <p>Premium selection for your everyday needs. Stylish, comfortable, and durable clothing for all occasions.</p>
                        <a href="{{ url('/product/details') }}">View Details →</a>
                    </div>
                </div>
                <div class="product-card">
                    <div class="product-image">⚡</div>
                    <div class="product-content">
                        <h3>Innovation Hub</h3>
                        <p>Trusted by thousands of satisfied customers worldwide. Experience cutting-edge products and services.</p>
                        <a href="{{ url('/product/details') }}">View Details →</a>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h2 class="section-title">🎯 Why Choose Us?</h2>
            <div class="features">
                <div class="feature-box">
                    <div class="feature-icon">✓</div>
                    <h4>Quality Assured</h4>
                    <p>Every product is carefully selected and quality checked to ensure customer satisfaction.</p>
                </div>
                <div class="feature-box">
                    <div class="feature-icon">🚚</div>
                    <h4>Fast Delivery</h4>
                    <p>Quick and reliable shipping to get your products to you as fast as possible.</p>
                </div>
                <div class="feature-box">
                    <div class="feature-icon">💬</div>
                    <h4>24/7 Support</h4>
                    <p>Our dedicated support team is always here to help with any questions or concerns.</p>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <p>&copy; 2026 My App. All rights reserved. | Built with ❤️ using Laravel & Blade</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
