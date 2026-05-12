<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>

<body>
    @if (session('success'))
        <div style="color:green;margin-bottom:1rem;">
            {{ session('success') }}
        </div>
    
    @endif
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <h1>Products</h1>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <button style="margin-right:0.5rem;">
                            <a href="{{ route('products.edit', $product) }}" style="margin-right:0.5rem;">Update</a>
                        </button>
                        <form action="{{ route('products.delete', $product) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <button style="margin: 10px;"><a href="{{ url('/') }}">Back to Home</a></button>
        </tbody>
    </table>
</body>

</html>