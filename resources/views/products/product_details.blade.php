<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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

        h1 {
            font-size: 2rem;
            margin-bottom: 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .success-message {
            background: #d1fae5;
            border-left: 4px solid #10b981;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            color: #065f46;
            font-weight: 500;
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

        .action-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        button,
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: none;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-update {
            background: #3b82f6;
            color: white;
        }

        .btn-update:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

        .btn-delete:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(220, 38, 38, 0.3);
        }

        .back-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin-top: 2rem;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(102, 126, 234, 0.4);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #666;
        }

        .empty-state p {
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <nav>
        <div>
            <a href="{{ url('/') }}" class="logo">🚀 My App</a>
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
        <h1>📦 Products</h1>

        @if (session('success'))
            <div class="success-message">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if ($products->count() > 0)
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td><strong>{{ $product->name }}</strong></td>
                                <td>{{ Str::limit($product->description, 50) }}</td>
                                <td><strong>${{ number_format($product->price, 2) }}</strong></td>
                                <td>
                                    <span style="background: #e0e7ff; padding: 0.25rem 0.75rem; border-radius: 20px; font-weight: 600;">
                                        {{ $product->quantity }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-update">Edit</a>
                                        <form action="{{ route('products.delete', $product) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="table-wrapper">
                <div class="empty-state">
                    <p>📭 No products found</p>
                    <a href="{{ url('/product/create') }}" class="back-button">Create First Product</a>
                </div>
            </div>
        @endif

        <a href="{{ url('/') }}" class="back-button">← Back to Home</a>
    </div>
</body>

</html>
