@extends('layouts.admin')
@section('content')
<h1 class="h3 mb-0 text-gray-800">Quản lí danh mục</h1>
<hr>
<div class="d-flex justify-content-between">
    <a href="{{ route('admin.qldanhmuc.create') }}" class="btn btn-success btn-icon-split mb-3">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Thêm danh mục</span>
    </a>
    <a href="#" class="btn btn-success btn-icon-split mb-3" onclick="generatePDF()">
        <span class="icon text-white-50">
            <i class="fas fa-print"></i>
        </span>
        <span class="text">In Danh Sách</span>
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Bảng danh mục</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Tên danh mục cha</th>
                        <th>Hình ảnh</th>
                        <th>Trạng Thái</th>
                        <th>Thời gian tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorys as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->parent ? $category->parent->name : 'Không có' }}</td>
                            <td>
                                @if($category->image)
                                    <img src="{{ asset($category->image) }}" alt="Hình ảnh" style="width: 100px; height: 100px; object-fit: cover;">
                                @else
                                    Không có
                                @endif
                            </td>
                            
                            <td>{{ $category->status }}</td>
                            <td>{{ $category->created_at }}</td>
                        
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('admin.qldanhmuc.edit', $category->id) }}"
                                        class="btn btn-primary btn-icon-split mr-2">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i> Sửa
                                        </span>
                                    </a>
                                    <form action="{{ route('admin.qldanhmuc.destroy', $category->id) }}" method="POST"
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