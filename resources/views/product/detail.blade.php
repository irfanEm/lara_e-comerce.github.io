<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail {{ $product->name }}</title>
</head>
<body>
  <p>Nama : {{ $product->name }}</p>
  <p>Deskripsi : {{ $product->description }}</p>
  <p>Harga : {{ $product->price }}</p>
  <p>Stok : {{ $product->stock }}</p>
  <img src="{{ url('storage/'.$product->image) }}" alt="{{ $product->name }}" height="150px">
  <form action="{{ route('add_to_cart', $product) }}" method="post">
    @csrf
    <input type="number" name="amount" value=1>
    <button type="submit">Masukan ke Keranjang</button>
  </form>
</body>
</html>
