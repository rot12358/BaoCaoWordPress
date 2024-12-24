@extends('master.master')
@section('profile')
<section style="background-color: #121214;">
    <div class="container py-5">
        <h2 class="text-white">Chi tiết đơn hàng #{{ $order->id }}</h2>
        <p class="text-white"><strong>Ngày đặt hàng:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        <p class="text-white"><strong>Tổng giá:</strong> {{ number_format($order->gia, 0, ',', '.') }}.00 VND</p>
        <p class="text-white"><strong>Trạng thái:</strong>
            <class="badge d-flex align-items-center gap-2
                @if($order->status == 'đang xử lý') bg-warning
                @elseif($order->status == 'xử lý') bg-info
                @elseif($order->status == 'chờ giao') bg-primary
                @elseif($order->status == 'đang giao') bg-secondary
                @elseif($order->status == 'đã đến' || $order->status == 'hoàn thành') bg-success
                @elseif($order->status == 'thất bại') bg-danger
                @else bg-dark
                @endif">
                <i class="fa 
                    @if($order->status == 'đang xử lý') fa-clock 
                    @elseif($order->status == 'xử lý') fa-spinner fa-spin 
                    @elseif($order->status == 'chờ giao') fa-truck 
                    @elseif($order->status == 'đang giao') fa-shipping-fast 
                    @elseif($order->status == 'đã đến') fa-check-circle 
                    @elseif($order->status == 'hoàn thành') fa-trophy 
                    @elseif($order->status == 'thất bại') fa-times-circle 
                    @else fa-question-circle 
                    @endif"></i>
                {{ ucfirst($order->status) }}
                </span>
        </p>

        <h4 class="text-white">Danh sách sản phẩm</h4>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->post_id }}</td>
                    <td>{{ $item->post->tentruyen }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->gia, 0, ',', '.') }}.00 VND</td>
                    <td>{{ number_format($item->quantity * $item->gia, 0, ',', '.') }}.00 VND</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('profile.orders') }}" class="btn btn-secondary">Quay lại</a>
    </div>
</section>
@endsection