@extends('layouts.admin')
@section('content')
<h1>Chỉnh Sửa Đơn Hàng</h1>
<form action="{{ route('admin.qldonhang.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
            <label for="order_customer_id">Tài Khoản</label>
            <select class="form-control" name="order_customer_id" required>
                @foreach ($orderCustomers as $orderCustomer)
                    <option value="{{ $orderCustomer->id }}"
                        {{ $order->order_customer_id == $orderCustomer->id ? 'selected' : '' }}>
                        {{ $orderCustomer->lastname }} {{ $orderCustomer->firstname }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Địa chỉ -->
        <div class="form-group">
            <label for="address">Địa Chỉ</label>
            <select class="form-control" name="address" required>
                @foreach ($orderCustomers as $orderCustomer)
                    <option value="{{ $orderCustomer->address }}"
                        {{ $order->address == $orderCustomer->address ? 'selected' : '' }}>
                        {{ $orderCustomer->address }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Số điện thoại -->
        <div class="form-group">
            <label for="phone">Số Điện Thoại</label>
            <select class="form-control" name="phone" required>
                @foreach ($orderCustomers as $orderCustomer)
                    <option value="{{ $orderCustomer->phone }}"
                        {{ $order->phone == $orderCustomer->phone ? 'selected' : '' }}>
                        {{ $orderCustomer->phone }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Phương thức thanh toán -->
        <div class="form-group">
            <label for="payment_method_id">Phương Thức Thanh Toán</label>
            <select class="form-control" name="payment_method_id" required>
                @foreach ($paymentMethods as $paymentMethod)
                    <option value="{{ $paymentMethod->id }}"
                        {{ $order->payment_method_id == $paymentMethod->id ? 'selected' : '' }}>
                        {{ $paymentMethod->method }}
                    </option>
                @endforeach
            </select>
        </div>

    <div class="form-group">
        <label for="status">Trạng Thái</label>
        <select class="form-control" name="status" required>
            <option value="Đã nhận đơn" {{ $order->status == 'Đã nhận đơn' ? 'selected' : '' }}>Đã nhận đơn</option>
            <option value="Đang vận chuyển" {{ $order->status == 'Đang vận chuyển' ? 'selected' : '' }}>Đang vận chuyển</option>
            <option value="Đã giao" {{ $order->status == 'Đã giao' ? 'selected' : '' }}>Đã giao</option>
            <option value="Đã hủy" {{ $order->status == 'Đã hủy' ? 'selected' : '' }}>Đã hủy</option>
        </select>
    </div>

    <div class="form-group">
        <label for="status_payment">Trạng Thái Thanh Toán</label>
        <select class="form-control" name="status_payment" required>
            <option value="Đang xử lí" {{ $order->status_payment == 'Đang xử lí' ? 'selected' : '' }}>Đang xử lí</option>
            <option value="Thành công" {{ $order->status_payment == 'Thành công' ? 'selected' : '' }}>Thanh toán thành công</option>
            <option value="Thất bại" {{ $order->status_payment == 'Thất bại' ? 'selected' : '' }}>Thanh toán thất bại</option>
        </select>
    </div>

    <div class="form-group">
        <label for="shipping_fee">Phí Vận Chuyển</label>
        <input type="number" step="0.01" name="shipping_fee" class="form-control"
            value="{{ old('shipping_fee', $order->shipping_fee) }}" required>
    </div>

    <div class="form-group">
        <label for="total">Tổng</label>
        <input type="number" step="0.01" name="total" class="form-control" value="{{ old('total', $order->total) }}"
            required>
    </div>

    <button type="submit" class="btn btn-primary">Cập Nhật Đơn Hàng</button>
</form>
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
