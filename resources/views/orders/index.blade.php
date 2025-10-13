@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Quản lý đơn hàng</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>Email</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'Chưa có tên' }}</td>
                    <td>{{ $order->user->email ?? '-' }}</td>
                    <td>{{ number_format($order->total, 0, ',', '.') }} VND</td>
                    <td>
                        <span class="badge 
                            @if($order->status == 'pending') bg-warning
                            @elseif($order->status == 'processing') bg-info
                            @elseif($order->status == 'completed') bg-success
                            @elseif($order->status == 'cancelled') bg-danger
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">Chi tiết</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Thanh phân trang -->
    <div class="d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
</div>
@endsection
 

