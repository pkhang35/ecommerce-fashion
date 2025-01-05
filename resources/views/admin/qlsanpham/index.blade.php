@extends('layouts.admin')
@section('content')
    <h1 class="h3 mb-0 text-gray-800">Quản lí sản phẩm</h1>
    <hr>
    <div class="d-flex justify-content-between">
        <a href="{{ route('products.create') }}" class="btn btn-success btn-icon-split mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Thêm sản phẩm</span>
        </a>

        <a href="#" class="btn btn-success btn-icon-split mb-3" onclick="generatePDF()">
            <span class="icon text-white-50">
                <i class="fas fa-print"></i>
            </span>
            <span class="text">In Danh Sách</span>
        </a>
    </div>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bảng sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Màu sắc</th>
                            <th>Size</th>
                            <th>Số lượng</th>
                            <th>Trạng Thái </th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Màu sắc</th>
                            <th>Size</th>
                            <th>Số lượng</th>
                            <th>Trạng Thái </th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? 'Không có danh mục' }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    @foreach ($product->details as $detail)
                                        {{ $detail->color->color_name ?? 'Không có màu' }},
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($product->details as $detail)
                                        {{ $detail->size->size_name ?? 'Không có kích thước' }},
                                    @endforeach
                                </td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->status }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-primary btn-icon-split mr-2">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-edit"></i> Sửa
                                            </span>
                                        </a>

                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="btn btn-info btn-icon-split mr-2">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-eye"></i> Xem
                                            </span>
                                        </a>

                                        <button class="btn btn-danger btn-icon-split toggle-status"
                                            data-id="{{ $product->id }}" data-status="{{ $product->status }}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                                {{ $product->status == 1 ? 'Xóa' : 'Hiển thị' }}
                                            </span>
                                        </button>
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
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script>
        $(document).on('click', '.toggle-status', function() {
            var productId = $(this).data('id');
            var status = $(this).data('status');
            var button = $(this);

            if (confirm('Bạn có chắc chắn muốn thay đổi trạng thái sản phẩm này không?')) {
                $.ajax({
                    url: '/products/' + productId + '/toggle-status',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        // Cập nhật trạng thái nút và ẩn/hiện sản phẩm trong giao diện
                        button.text(response.status == 1 ? 'Ẩn' : 'Hiển thị');
                        button.toggleClass('btn-warning btn-success');
                        if (response.status == 0) {
                            button.closest('tr').fadeOut();
                        } else {
                            button.closest('tr').fadeIn();
                        }
                        alert(response.message);
                    },
                    error: function(xhr, status, error) {
                        alert('Đã xảy ra lỗi. Vui lòng thử lại.');
                    }
                });
            }
        });
    </script>
@endsection
