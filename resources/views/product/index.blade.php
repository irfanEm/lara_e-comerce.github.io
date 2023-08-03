<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Product</title>
</head>
<body>
    @foreach ($products as $product)
        <p>Nama : {{ $product->name }}</p>
        <img src="{{ url('storage/'.$product->image) }}" alt="product" height="100px">
        <form action="{{ route('product.detail', $product) }}" method="get">
            <button>detail produk</button>
        </form>
        <form action="{{ route('product.edit', $product) }}" method="get">
            <button type="submit">edit produk</button>
        </form>
        <form action="{{ route('product.delete', $product) }}" method="post">
            @method('delete')
            @csrf
            <button type="submit">hapus</button>
        </form>
    @endforeach
</body>
</html>
