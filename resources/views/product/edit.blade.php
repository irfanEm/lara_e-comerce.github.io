<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit {{ $product->name }}</title>
</head>
<body>
    <form action="{{ route('product.update', $product) }}" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <input type="text" name="name" id="name" placeholder="Nama" value="{{ $product->name }}"><br>
        <input type="text" name="description" id="description" placeholder="Deskripsi" value="{{ $product->description }}"><br>
        <input type="number" name="price" id="price" placeholder="price" value="{{ $product->price }}"><br>
        <input type="number" name="stock" id="stock" placeholder="stock" value="{{ $product->stock }}"><br>
        <img src="{{ url('storage/'.$product->image) }}" alt="" height="150px">
        <input type="file" name="image" id="image"><br>
        <button type="submit">update</button>
    </form>
</body>
</html>
