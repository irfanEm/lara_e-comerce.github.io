<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produk</title>
</head>
<body>
<form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" id="name" placeholder="Nama"><br>
    <input type="text" name="description" id="description" placeholder="Deskripsi"><br>
    <input type="number" name="price" id="price" placeholder="price"><br>
    <input type="number" name="stock" id="stock" placeholder="stock"><br>
    <input type="file" name="image" id="image"><br>
    <button type="submit">tambah</button>
</form>
</body>
</html>
