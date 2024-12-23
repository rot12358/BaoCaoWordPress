@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Thanh toán</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Tên Truyện</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->post->tentruyen }}</td>
                            <td>
                                <img src="{{ $item->post->anhgioithieu }}" alt="{{ $item->post->tentruyen }}"
                                    style="width: 100px; height: auto;">
                            </td>
                            <td>
                                <!-- Form để tăng hoặc giảm số lượng -->
                                <form method="POST" action="{{ route('checkout.updateQuantity', $item->id) }}">
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
                                <!-- Hiển thị giá của sản phẩm với số lượng -->
                                @php 
                                                            $itemTotal = $item->post->gia * $item->quantity;
                                    $total += $itemTotal;
                                @endphp
                                {{ number_format($itemTotal, 0, ',', '.') }} VND
                            </td>
                        </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Hiển thị tổng tiền của tất cả sản phẩm -->
    <div class="row">
        <div class="col-12 text-right">
            <h4>Tổng tiền: {{ number_format($total, 0, ',', '.') }} VND</h4>
        </div>
    </div>

    <!-- Form đặt hàng -->
    <form method="POST" action="{{ route('checkout.placeOrder') }}">
        @csrf
        <button type="submit" class="btn btn-success">Hoàn tất</button>
    </form>
</div>
@endsection