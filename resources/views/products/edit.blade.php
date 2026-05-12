<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Edit</title>
</head>

<body>
    <h1>Edit Product</h1>
    {{-- form to edit an existing product --}}
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $product->name }}" required><br><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required>{{ $product->description }}</textarea><br><br>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" value="{{ $product->price }}" required><br><br>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="{{ $product->quantity }}" required><br><br>
        <input type="submit" value="Update Product">
    </form>
</body>

</html>