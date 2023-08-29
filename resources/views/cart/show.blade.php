<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Keranjang</title>
</head>
<body>
    @if($errors->any())
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
    @endif
    @foreach($carts as $cart)
      <img src="{{ url('storage/'.$cart->product->image) }}" alt="{{ $cart->product }}" height="100px">
      <p>Nama : {{ $cart->product->name }}</p>
      <br>
      <form action="{{ route('edit_cart', $cart) }}" method="post">
        @method('patch')
        @csrf
        <input type="number" name="amount" value={{ $cart->amount }}>
        <button type="submit">edit keranjang</button>
      </form>
      <form action="{{ route('hapus_cart', $cart) }}" method="post">
          @method('delete')
          @csrf
          <button type="submit">hapus</button>
      </form>
      <form action="{{ route('checkout') }}" method="post">
        @csrf
        <button type="submit">checkout</button>
      </form>
    @endforeach
</body>
</html>
