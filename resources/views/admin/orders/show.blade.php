<!-- resources/views/admin/orders/show.blade.php -->

@extends('admin.app')

@section('content')
<div class="container">
    <h2>Order Details</h2>
    <div class="mb-3">
        <h4>Order ID: {{ $order->id }}</h4>
        <p>User: {{ $order->user->name }}</p>
        <p>Status:
            <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : 'success' }}">
                {{ ucfirst($order->status) }}
            </span>
        </p>
        <p>Total Price: {{ number_format($order->gia, 2) }} VND</p>
    </div>

    <h4>Order Items</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->post->tentruyen }}</td> <!-- Hiển thị tên sản phẩm -->
                    <td>{{ $item->quantity }}</td> <!-- Số lượng -->
                    <td>{{ number_format($item->gia, 2) }} VND</td> <!-- Giá mỗi sản phẩm -->
                    <td>{{ number_format($item->quantity * $item->gia, 2) }} VND</td> <!-- Tổng tiền cho sản phẩm -->
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
</div>
@endsection