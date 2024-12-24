@extends('admin.app')

@section('content')
<div class="container">
    <h2>Tổng danh sách đơn hàng </h2>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tài khoản</th>
                <th>Tên Tài Khoản</th>
                <th>Tổng tiền</th>
                <th>Trạng thái đơn hàng</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 1 @endphp
            @foreach($orders as $order)
            <tr>
                <td>
                    {{ $count++ }}
                </td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->user->email }}</td>
                <td>{{ number_format($order->gia, 2) }} VND</td>
                <td>
                    <!-- Dropdown để chọn trạng thái -->
                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="đang xử lý" {{ $order->status == 'đang xử lý' ? 'selected' : '' }}>Đang xử lý
                            </option>
                            <option value="xử lý" {{ $order->status == 'xử lý' ? 'selected' : '' }}>Xử lý</option>
                            <option value="chờ giao" {{ $order->status == 'chờ giao' ? 'selected' : '' }}>Chờ giao
                            </option>
                            <option value="đang giao" {{ $order->status == 'đang giao' ? 'selected' : '' }}>Đang giao
                            </option>
                            <option value="đã đến" {{ $order->status == 'đã đến' ? 'selected' : '' }}>Đã đến</option>
                            <option value="hoàn thành" {{ $order->status == 'hoàn thành' ? 'selected' : '' }}>Hoàn thành
                            </option>
                            <option value="thất bại" {{ $order->status == 'thất bại' ? 'selected' : '' }}>Thất bại
                            </option>
                        </select>
                    </form>
                <td> <a href="{{ route('admin.orders.show', $order->id) }}">Xem Thêm</td>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection