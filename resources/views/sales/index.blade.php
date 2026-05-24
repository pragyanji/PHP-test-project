<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales History — IMS</title>
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

        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        h1 {
            font-size: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0;
        }

        .success-message {
            background: #d1fae5;
            border-left: 4px solid #10b981;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            color: #065f46;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .table-wrapper {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.95rem;
        }

        td {
            padding: 1.25rem 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        tbody tr:hover {
            background-color: #f9fafb;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-receipt {
            background: #f3f4f6;
            color: #374151;
            border: 1.5px solid #e5e7eb;
            padding: 0.45rem 0.9rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: all 0.3s ease;
        }

        .btn-receipt:hover {
            background: #e5e7eb;
            color: #1f2937;
            border-color: #d1d5db;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #666;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .empty-state p {
            font-size: 1.1rem;
            color: #4b5563;
            margin-bottom: 1.5rem;
        }

        .pagination-container {
            margin-top: 2rem;
            padding: 1rem 0;
        }
    </style>
</head>

<body>
    @includeIf('common.base')

    <div class="container">
        <div class="header-section">
            <h1 style="display: flex; align-items: center; gap: 0.75rem;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="url(#salesHeaderGradient)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                    <defs>
                        <linearGradient id="salesHeaderGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#667eea" />
                            <stop offset="100%" stop-color="#764ba2" />
                        </linearGradient>
                    </defs>
                    <line x1="18" y1="20" x2="18" y2="10"></line>
                    <line x1="12" y1="20" x2="12" y2="4"></line>
                    <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
                <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Sales History</span>
            </h1>
            <a href="{{ route('sales.create') }}" class="btn-primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Record New Sale
            </a>
        </div>

        @if (session('success'))
            <div class="success-message">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink: 0;">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if ($sales->count() > 0)
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity Sold</th>
                            <th>Unit Price</th>
                            <th>Total Revenue</th>
                            <th>Transaction Date</th>
                            <th style="text-align: right; padding-right: 1.5rem;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>
                                    <strong>{{ $sale->product ? $sale->product->name : 'Deleted Product' }}</strong>
                                </td>
                                <td>
                                    <span style="background: #e0e7ff; padding: 0.25rem 0.75rem; border-radius: 20px; font-weight: 600;">
                                        {{ $sale->quantity }}
                                    </span>
                                </td>
                                <td>Rs. {{ number_format($sale->price_at_sale, 2) }}</td>
                                <td><strong>Rs. {{ number_format($sale->total_price, 2) }}</strong></td>
                                <td style="color: #6b7280;">{{ $sale->created_at->format('M d, Y h:i A') }}</td>
                                <td style="text-align: right; padding-right: 1.5rem;">
                                    <a href="{{ route('sales.receipt', $sale->id) }}" class="btn-receipt">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                        Receipt
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($sales->hasPages())
                <div class="pagination-container">
                    {{ $sales->links() }}
                </div>
            @endif
        @else
            <div class="table-wrapper">
                <div class="empty-state">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 1.5rem;">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <p>No sale records found in the database.</p>
                    <a href="{{ route('sales.create') }}" class="btn-primary">Record Your First Sale</a>
                </div>
            </div>
        @endif
    </div>
</body>

</html>
