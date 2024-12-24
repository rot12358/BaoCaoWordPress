@extends('master.master')

@section('profile')
<section style="background-color: #121214;">
    <div class="container py-5">
        <h2 class="text-white">Danh sách đơn hàng</h2>

        @if($orders->isEmpty())
            <p class="text-white">Bạn chưa có đơn hàng nào.</p>
        @else
            <table class="table table-dark table-striped mt-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tổng giá</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ number_format($order->gia, 0, ',', '.') }}.00 VND</td>
                            <td>
                                    <class="badge d-flex align-items-center gap-2 
                                        @if($order->status == 'đang xử lý') bg-warning 
                                        @elseif($order->status == 'xử lý') bg-info 
                                        @elseif($order->status == 'chờ giao') bg-primary 
                                        @elseif($order->status == 'đang giao') bg-secondary 
                                        @elseif($order->status == 'Đã đến' || $order->status == 'hoàn thành') bg-success 
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
                            </td>
                            <td>
                                <!-- Liên kết đến chi tiết đơn hàng -->
                                <a href="{{ route('profile.orderDetails', $order->id) }}" class="btn btn-primary btn-sm">Xem chi
                                    tiết</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</section>
@endsection