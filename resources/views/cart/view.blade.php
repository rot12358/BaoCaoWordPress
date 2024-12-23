@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Giỏ hàng</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($cartItems as $item)
                        <tr>
                            <td>{{ $item->post->tentruyen }}</td>
                            <td>
                                <img src="{{ $item->post->anhgioithieu }}" alt="{{ $item->post->tentruyen }} "
                                    style="width: 100px; height: auto;">
                            </td>
                            <td>
                                <!-- Cập nhật số lượng sản phẩm trong giỏ hàng -->
                                <form method="POST" action="{{ route('cart.updateQuantity', $item->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-group" style="max-width: 150px;">
                                        <button type="submit" name="action" value="decrease"
                                            class="btn btn-secondary btn-sm">-</button>
                                        <input type="number" name="quantity" value="{{ $item->quantity }}"
                                            class="form-control text-center" min="1" style="width: 60px;" readonly>
                                        <button type="submit" name="action" value="increase"
                                            class="btn btn-secondary btn-sm">+</button>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <!-- Tính giá tiền sản phẩm -->
                                @php 
                                                                                            $itemTotal = $item->post->gia * $item->quantity;
                                    $total += $itemTotal;
                                @endphp
                                {{ number_format($itemTotal, 0, ',', '.') }} VND
                            </td>
                            <td>
                                <!-- Xóa sản phẩm khỏi giỏ hàng -->
                                <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Nút thanh toán -->
    <div class="d-flex justify-content-start">
        <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg">Thanh toán</a>
    </div>
</div>
@endsection