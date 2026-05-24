<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — IMS</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f0f2f5;
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

        /* ─── Dashboard Layout ─── */
        .dashboard {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* ─── Welcome Banner ─── */
        .welcome-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 2.5rem 3rem;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 50%;
        }

        .welcome-banner::after {
            content: '';
            position: absolute;
            bottom: -60%;
            right: 15%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.04);
            border-radius: 50%;
        }

        .welcome-text h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .welcome-text p {
            font-size: 1rem;
            opacity: 0.85;
        }

        .welcome-date {
            text-align: right;
            font-size: 0.9rem;
            opacity: 0.8;
            z-index: 1;
        }

        .welcome-date .date-big {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        /* ─── Stats Grid ─── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 14px;
            padding: 1.5rem;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }

        .stat-card .stat-value {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1f2937;
            line-height: 1;
            margin-bottom: 0.35rem;
        }

        .stat-card .stat-label {
            font-size: 0.85rem;
            color: #6b7280;
            font-weight: 500;
        }

        .stat-icon.purple { background: #ede9fe; color: #7c3aed; }
        .stat-icon.blue { background: #dbeafe; color: #2563eb; }
        .stat-icon.green { background: #d1fae5; color: #059669; }
        .stat-icon.amber { background: #fef3c7; color: #d97706; }
        .stat-icon.rose { background: #ffe4e6; color: #e11d48; }
        .stat-icon.teal { background: #ccfbf1; color: #0d9488; }

        /* ─── Two Column Layout ─── */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .panel {
            background: white;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .panel-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .panel-header h2 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1f2937;
        }

        .panel-header a {
            font-size: 0.85rem;
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
            padding: 0;
            border-bottom: none;
        }

        .panel-header a:hover {
            color: #764ba2;
        }

        /* ─── Recent Products Table ─── */
        .recent-table {
            width: 100%;
            border-collapse: collapse;
        }

        .recent-table th {
            text-align: left;
            padding: 0.75rem 1.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #9ca3af;
            font-weight: 600;
            background: #fafafa;
        }

        .recent-table td {
            padding: 0.9rem 1.5rem;
            font-size: 0.9rem;
            border-top: 1px solid #f3f4f6;
            color: #374151;
        }

        .recent-table tbody tr {
            transition: background 0.15s ease;
        }

        .recent-table tbody tr:hover {
            background: #f9fafb;
        }

        .product-name {
            font-weight: 600;
            color: #1f2937;
        }

        .price-tag {
            font-weight: 700;
            color: #059669;
        }

        .qty-badge {
            display: inline-block;
            background: #e0e7ff;
            color: #4338ca;
            padding: 0.2rem 0.7rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .qty-badge.low {
            background: #fee2e2;
            color: #dc2626;
        }

        .empty-table {
            text-align: center;
            padding: 2.5rem 1.5rem;
            color: #9ca3af;
        }

        .empty-table p {
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
        }

        /* ─── Quick Actions Panel ─── */
        .quick-actions {
            padding: 1.25rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.9rem 1rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.25s ease;
            border: 1.5px solid #e5e7eb;
            color: #374151;
        }

        .action-btn:hover {
            border-color: #667eea;
            background: #f5f3ff;
            color: #667eea;
            transform: translateX(4px);
        }

        .action-btn .action-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .action-icon.purple { background: #ede9fe; }
        .action-icon.blue { background: #dbeafe; }
        .action-icon.green { background: #d1fae5; }
        .action-icon.rose { background: #ffe4e6; }

        /* ─── Profile Section ─── */
        .profile-section {
            padding: 1.25rem 1.5rem;
        }

        .profile-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.85rem 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .profile-item:last-child {
            border-bottom: none;
        }

        .profile-item .profile-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .profile-item .profile-detail {
            flex: 1;
        }

        .profile-item .profile-label {
            font-size: 0.75rem;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }

        .profile-item .profile-value {
            font-size: 0.95rem;
            color: #1f2937;
            font-weight: 600;
        }

        /* ─── Footer ─── */
        footer {
            background: #1f2937;
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 1rem;
        }

        footer p {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* ─── Responsive ─── */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .welcome-banner {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
                padding: 2rem;
            }

            .welcome-date {
                text-align: center;
            }
        }

        /* ─── Animations ─── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stat-card, .panel {
            animation: fadeUp 0.4s ease forwards;
        }

        .stat-card:nth-child(1) { animation-delay: 0.05s; }
        .stat-card:nth-child(2) { animation-delay: 0.1s; }
        .stat-card:nth-child(3) { animation-delay: 0.15s; }
        .stat-card:nth-child(4) { animation-delay: 0.2s; }
        .stat-card:nth-child(5) { animation-delay: 0.25s; }
        .stat-card:nth-child(6) { animation-delay: 0.3s; }
    </style>
</head>

<body>
    @includeIf('common.base')

    <?php
        $totalProducts = \App\Models\Product::count();
        $totalValue = \App\Models\Product::selectRaw('SUM(price * quantity) as total')->value('total') ?? 0;
        $totalStock = \App\Models\Product::sum('quantity');
        $lowStock = \App\Models\Product::where('quantity', '<=', 5)->count();
        $recentProducts = \App\Models\Product::orderBy('created_at', 'desc')->take(5)->get();
        $totalRevenue = \App\Models\Sale::sum('total_price') ?? 0;
        $totalItemsSold = \App\Models\Sale::sum('quantity') ?? 0;
        $recentSales = \App\Models\Sale::with('product')->orderBy('id', 'desc')->take(5)->get();
    ?>

    <div class="dashboard">
        {{-- Welcome Banner --}}
        <div class="welcome-banner">
            <div class="welcome-text">
                <h1>Welcome back, {{ auth()->user()->name }}!</h1>
                <p>Here's what's happening with your inventory today.</p>
            </div>
            <div class="welcome-date">
                <div class="date-big">{{ now()->format('d') }}</div>
                <div>{{ now()->format('F Y') }}</div>
            </div>
        </div>

        {{-- Stats Grid --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon purple">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
                <div class="stat-value">{{ number_format($totalProducts) }}</div>
                <div class="stat-label">Total Products</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon blue">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"></line>
                        <line x1="12" y1="20" x2="12" y2="4"></line>
                        <line x1="6" y1="20" x2="6" y2="14"></line>
                    </svg>
                </div>
                <div class="stat-value">{{ number_format($totalStock) }}</div>
                <div class="stat-label">Items in Stock</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="6" width="20" height="12" rx="2"></rect>
                        <circle cx="12" cy="12" r="2"></circle>
                        <line x1="6" y1="12" x2="6" y2="12"></line>
                        <line x1="18" y1="12" x2="18" y2="12"></line>
                    </svg>
                </div>
                <div class="stat-value">Rs. {{ number_format($totalValue, 0) }}</div>
                <div class="stat-label">Inventory Value</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon amber">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                </div>
                <div class="stat-value">{{ number_format($lowStock) }}</div>
                <div class="stat-label">Low Stock (≤ 5)</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon teal">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                </div>
                <div class="stat-value">Rs. {{ number_format($totalRevenue, 0) }}</div>
                <div class="stat-label">Total Revenue</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon rose">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                </div>
                <div class="stat-value">{{ number_format($totalItemsSold) }}</div>
                <div class="stat-label">Total Items Sold</div>
            </div>
        </div>

        {{-- Two Column: Recent Products + Sidebar --}}
        <div class="dashboard-grid">
            {{-- Recent Products --}}
            <div class="panel">
                <div class="panel-header">
                    <h2 style="display: flex; align-items: center;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.5rem;">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="9" y1="9" x2="15" y2="9"></line>
                            <line x1="9" y1="13" x2="15" y2="13"></line>
                            <line x1="9" y1="17" x2="15" y2="17"></line>
                        </svg>Recent Products
                    </h2>
                    <a href="{{ route('products.product_details') }}">View All &rarr;</a>
                </div>
                @if($recentProducts->count() > 0)
                    <table class="recent-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Added</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentProducts as $product)
                                <tr>
                                    <td class="product-name">{{ $product->name }}</td>
                                    <td class="price-tag">Rs. {{ number_format($product->price, 2) }}</td>
                                    <td>
                                        <span class="qty-badge {{ $product->quantity <= 5 ? 'low' : '' }}">
                                            {{ $product->quantity }}
                                        </span>
                                    </td>
                                    <td style="color: #9ca3af; font-size: 0.85rem;">{{ $product->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-table">
                        <p style="margin-bottom: 1rem;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #9ca3af;">
                                <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                            </svg>
                        </p>
                        <span>No products yet. Create your first one!</span>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                {{-- Quick Actions --}}
                <div class="panel">
                    <div class="panel-header">
                        <h2 style="display: flex; align-items: center;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.5rem;">
                                <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                            </svg>Quick Actions
                        </h2>
                    </div>
                    <div class="quick-actions">
                        <a href="{{ route('products.create') }}" class="action-btn">
                            <span class="action-icon purple" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 6px; background: #ede9fe; color: #7c3aed;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </span>
                            Add New Product
                        </a>
                        <a href="{{ route('sales.create') }}" class="action-btn">
                            <span class="action-icon rose" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 6px; background: #ffe4e6; color: #e11d48;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                            </span>
                            Record a Sale
                        </a>
                        <a href="{{ route('products.product_details') }}" class="action-btn">
                            <span class="action-icon blue" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 6px; background: #dbeafe; color: #2563eb;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="9" y1="9" x2="15" y2="9"></line>
                                    <line x1="9" y1="13" x2="15" y2="13"></line>
                                </svg>
                            </span>
                            View All Products
                        </a>
                        <a href="{{ route('profile.edit') }}" class="action-btn">
                            <span class="action-icon green" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 6px; background: #d1fae5; color: #059669;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </span>
                            Edit Profile
                        </a>
                    </div>
                </div>

                {{-- Account Info --}}
                <div class="panel">
                    <div class="panel-header">
                        <h2 style="display: flex; align-items: center;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.5rem;">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>Your Account
                        </h2>
                    </div>
                    <div class="profile-section">
                        <div class="profile-item">
                            <div class="profile-icon" style="color: #667eea; background: #f3e8ff; border-radius: 8px; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </div>
                            <div class="profile-detail">
                                <div class="profile-label">Full Name</div>
                                <div class="profile-value">{{ auth()->user()->name }}</div>
                            </div>
                        </div>
                        <div class="profile-item">
                            <div class="profile-icon" style="color: #2563eb; background: #e0f2fe; border-radius: 8px; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </div>
                            <div class="profile-detail">
                                <div class="profile-label">Email</div>
                                <div class="profile-value">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                        <div class="profile-item">
                            <div class="profile-icon" style="color: #059669; background: #d1fae5; border-radius: 8px; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                            </div>
                            <div class="profile-detail">
                                <div class="profile-label">Member Since</div>
                                <div class="profile-value">{{ auth()->user()->created_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Sales Panel --}}
        <div class="panel" style="margin-bottom: 2rem;">
            <div class="panel-header">
                <h2 style="display: flex; align-items: center;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.5rem;">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    Recent Sales
                </h2>
                <a href="{{ route('sales.index') }}">View All &rarr;</a>
            </div>
            @if($recentSales->count() > 0)
                <table class="recent-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty Sold</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentSales as $sale)
                            <tr>
                                <td class="product-name">{{ $sale->product ? $sale->product->name : 'Deleted Product' }}</td>
                                <td>
                                    <span class="qty-badge">{{ $sale->quantity }}</span>
                                </td>
                                <td style="color: #6b7280;">Rs. {{ number_format($sale->price_at_sale, 2) }}</td>
                                <td class="price-tag">Rs. {{ number_format($sale->total_price, 2) }}</td>
                                <td style="color: #9ca3af; font-size: 0.85rem;">{{ $sale->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-table">
                    <p style="margin-bottom: 0.5rem;">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #9ca3af;">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </p>
                    <span>No sales recorded yet. <a href="{{ route('sales.create') }}" style="color: #667eea; font-weight: 600;">Record one now &rarr;</a></span>
                </div>
            @endif
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} IMS. All rights reserved. | Built using Laravel & Blade</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
