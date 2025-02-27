@extends('layouts.admin')
@section('content')
@if (session('success'))
<button class="alert alert-success" id="success-message">
    {{ session('success') }}
</button>
@endif
<h1 class="h3 mb-0 text-gray-800">Quản lí bình luận</h1>
<hr>
<div class="d-flex justify-content-between">
    <a href="#" class="btn btn-success btn-icon-split mb-3" onclick="generatePDF()">
        <span class="icon text-white-50">
            <i class="fas fa-print"></i>
        </span>
        <span class="text">In Danh Sách</span>
    </a>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Bảng bình luận</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ID sản phẩm</th>
                        <th>ID người dùng</th>
                        <th>Nội dung</th>
                        <th>Đánh giá</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                    @if($comment->status != 0)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->product_id }}</td>
                        <td>{{ $comment->account_id }}</td>
                        <td>{{ $comment->content }}</td>
                        <td>{{ $comment->rating }}</td>
                        <td>{{ $comment->created_at }}</td>
                        <td>
                            <div class="d-flex">
                                <form action="{{ route('admin.qlbinhluan.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-icon-split mr-2" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i> Xóa
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endif
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

<script>
    @if(session('success'))
    setTimeout(function() {
        document.getElementById('success-message').style.display = 'none';
    }, 3000);
    @endif
</script>
@endsection