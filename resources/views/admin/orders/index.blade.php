<!-- resources/views/admin/orders/index.blade.php -->

@extends('admin.app')

@section('content')
<div class="container">
    <h2>Order Management</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}">{{ $order->id }}</a>
                        <!-- Liên kết đến trang chi tiết -->
                    </td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ number_format($order->gia, 2) }} VND</td>
                    <td>
                        <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : 'success' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-primary">
                                {{ $order->status == 'pending' ? 'Mark as Finished' : 'Mark as Pending' }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection