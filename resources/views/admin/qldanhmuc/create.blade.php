@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <h1 class="h3 mb-4 text-gray-800">Thêm danh mục</h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.qldanhmuc.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Tên danh mục</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                            required>
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug') }}"
                            required readonly>
                    </div>

                    <div class="form-group">
                        <label for="image">Ảnh</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Hiện</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Ẩn</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="parent_id">Danh mục cha</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="">--Chọn danh mục cha--</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        <a href="{{ route('admin.qldanhmuc.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay Lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('name').addEventListener('input', function() {
            var name = this.value;
            var slug = name
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/đ/g, 'd');
            document.getElementById('slug').value = slug;
        });
    </script>
@endsection
