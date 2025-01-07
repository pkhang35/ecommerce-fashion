@extends('layouts.admin') 

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Sửa danh mục</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.qldanhmuc.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Tên danh mục</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $category->name) }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}" required readonly>
                </div>

                <div class="form-group">
                    <label for="image">Ảnh</label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Hiện</option>
                        <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="parent_id">Danh mục cha</label>
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="">--Chọn danh mục cha--</option>
                        @foreach($categories as $parentCategory)
                            <option value="{{ $parentCategory->id }}" {{ old('parent_id', $category->parent_id) == $parentCategory->id ? 'selected' : '' }}>
                                {{ $parentCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>
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
