@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Chi Tiết Đơn Hàng</h2>

    <!-- Thông tin đơn hàng -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Thông Tin Đơn Hàng</h5>
        </div>
        <div class="card-body">
            <p><strong>ID Đơn Hàng:</strong> {{ $order->id }}</p>
            <p><strong>Khách Hàng:</strong> {{ $order->orderCustomer->lastname }} {{ $order->orderCustomer->firstname }}</p>
            <p><strong>Địa Chỉ Giao Hàng:</strong> {{ $order->orderCustomer->address }}</p>
            <p><strong>Số Điện Thoại:</strong> {{ $order->orderCustomer->phone }}</p>
            <p><strong>Phương Thức Thanh Toán:</strong> {{ $order->paymentMethod->method }}</p>
            <p><strong>Ngày Tạo:</strong> {{ $order->created_at }}</p>
            <p><strong>Trạng Thái:</strong>
                @switch($order->status)
                    @case(0) Đã hủy @break
                    @case(1) Đã nhận đơn @break
                    @case(2) Đang vận chuyển @break
                    @case(3) Đã giao @break
                    @default
                        Không xác định
                @endswitch
            </p>
            <p><strong>Trạng Thái Thanh Toán:</strong>
            @if ($order->status_payment == 0)
                    Thất bại
                @elseif ($order->status_payment == 1)
                    Đang xử lí
                @else
                    Thành công
            @endif
            </p>
            <p><strong>Phí Vận Chuyển:</strong> {{ number_format($order->shipping_fee, 0, ',', '.') }} VNĐ</p>
        </div>
    </div>

    <!-- Chi tiết sản phẩm -->
    <div class="card">
        <div class="card-header">
            <h5>Danh Sách Sản Phẩm</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Giá</th>
                        <th>Tổng Sản Phẩm</th>
                        <th>Tổng Cộng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($item->price, 0, ',', '.') }} VNĐ</td>
                                        <td>{{ number_format($item->quantity * $item->price, 0, ',', '.') }} VNĐ</td>
                                        <td>{{ number_format($order->orderItems->sum(function ($item) {
                        return $item->quantity * $item->price; }) + $order->shipping_fee, 0, ',', '.') }} VNĐ</td>
                                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('admin.qldonhang.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay Lại
        </a>
    </div>
</div>
@endsection
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
