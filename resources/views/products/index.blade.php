<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
</head>
<body>
    <h1>Product {{ $id }}</h1>
    <a href="{{ route('products-index', ['id' => $id <= 1 ? 1 : $id - 1]) }}">- Product</a>
    <a href="{{ route('products-index', ['id' => $id >= 10 ? 10 : $id + 1]) }}">+ Product</a>
</body>
</html>