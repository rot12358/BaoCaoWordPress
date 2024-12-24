@extends('master.master')

@section('content')
<div class="container">
    <div class="mb-4">
        <a href="{{route('cart.view')}}" class="btn btn-primary btn-lg">
            <i class="bi bi-arrow-left-circle"></i> Quay lại giỏ hang
        </a>
    </div>
    <h2>Thanh toán</h2>
    <div class="row">
        <!-- Cột bên trái chứa thông tin người dùng -->
        <div class="col-md-6">
            <form method="POST" action="{{ route('checkout.placeOrder') }}">
                @csrf
                <!-- Thêm các trường thông tin người dùng -->
                <div class="mb-3">
                    <label for="name" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <!-- Nút thanh toán -->
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-success">Thanh Toán Đơn Hàng</button>
                </div>
            </form>
        </div>
        <!-- Cột bên phải chứa bảng sản phẩm trong giỏ hàng -->
        <div class="col-md-6">
            <h4>Chi tiết đơn hàng</h4>
            <table class="table table-dark table-striped mt-4">
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
                                                        <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                            class="form-control text-center" min="1" style="width: 60px;" readonly>
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
                <div class="col-12 text-end">
                    <h4>Tổng tiền: {{ number_format($total, 0, ',', '.') }} VND</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection