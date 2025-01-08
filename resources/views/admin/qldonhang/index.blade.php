@extends('layouts.admin')
@section('content')
<h1 class="h3 mb-0 text-gray-800">Quản lí Đơn Hàng</h1>
<hr>
<div class="d-flex justify-content-between">
    <a href="#" class="btn btn-success btn-icon-split mb-3">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Thêm đơn hàng</span>
    </a>
    <a href="#" class="btn btn-success btn-icon-split mb-3 ">
        <span class="icon text-white-50">
            <i class="fas fa-print"></i>
        </span>
        <span class="text">In Danh Sách</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Bảng Đơn Hàng</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tài Khoản</th>
                        <th>Trạng Thái</th>
                        <th>Trạng Thái Thanh Toán</th>
                        <th>Phí vận chuyển</th>
                        <th>Tổng</th>
                        <th>Thời Gian Tạo</th>
                        <th>Thời Gian Vận Chuyển</th>
                        <th>Thời Gian Hoàn Thành</th>
                        <th>Thời Gian Hủy</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->orderCustomer->lastname }}</td>
                                        <td>
                                            @switch($order->status)
                                                @case(1) Đã nhận đơn @break
                                                @case(2) Đang vận chuyển @break
                                                @case(3) Đã giao @break
                                                @case(0) Đã hủy @break
                                                @default
                                                Không xác định
                                            @endswitch
                                        </td>
                                        <td>{{ $order->status_payment == 0 ? 'Thất bại' : ($order->status_payment == 1 ? 'Đang xử lí' : 'Thành công') }}</td>
                                        <td>{{ number_format($order->shipping_fee, 0,',', '.') }} VNĐ</td>
                                        <td>{{ number_format($order->orderItems->sum(function ($item) { return $item->quantity * $item->price; }) + $order->shipping_fee, 0, ',', '.') }} VNĐ</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->delivery_at }}</td>
                                        <td>{{ $order->completed_at }}</td>
                                        <td>{{ $order->canceled_at }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('admin.qldonhang.edit', $order->id) }}"
                                                    class="btn btn-primary btn-icon-split mr-2">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-edit"></i> Sửa
                                                    </span>
                                                </a>
                                                <form action="{{ route('admin.qldonhang.destroy', $order->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-icon-split mr-2"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-trash"></i> Xóa
                                                        </span>
                                                    </button>
                                                </form>
                                                <a href="{{ route('admin.qldonhang.show', $order->id) }}"
                                                    class="btn btn-info btn-icon-split mr-2">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-info-circle"></i> ChiTiết
                                                    </span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('js/demo/datatables-demo.js')}}"></script>
@endsection
