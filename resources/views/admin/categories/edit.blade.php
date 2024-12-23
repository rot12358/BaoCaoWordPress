@extends('admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">Cập nhật danh mục</div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card-body">
                @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('categories.update', $cate->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="theloaitruyen" class="form-label">Tên danh mục</label>
                        <input type="text" name="theloaitruyen" value="{{ $cate->theloaitruyen }}" class="form-control" id="theloaitruyen" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="is_active" class="form-label">Kích hoạt</label>
                        <select class="form-select" name="is_active" id="is_active" aria-label="Default select example">
                            <option value="1" {{ $cate->is_active == 1 ? 'selected' : '' }}>Kích hoạt</option>
                            <option value="0" {{ $cate->is_active == 0 ? 'selected' : '' }}>Không kích hoạt</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
