@extends('admin.app')

@section('content')
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Tài Khoản Mới</title>

    <!-- Thêm link đến Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEJr7YyJPXzv9J8eN6GoL0Lu7vv9D7Zk5ZwA6zUsMZGqv7fjxuK2z3E1QUw1I" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tạo Tài Khoản Mới</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Họ và Tên</label>
                <input type="text" id="name" name="name" class="form-control" required value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                    required>
                @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Tạo Tài Khoản</button>
        </form>

        <div class="mt-3">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary w-100">Quay lại danh sách người dùng</a>
        </div>
    </div>

    <!-- Thêm script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pzjw8f+ua7Kw1TIq0iCzP0zVQYvE5zH3p8U7/Tkt7YfUfq5quK2Y5+5TQtFhn9fz"
        crossorigin="anonymous"></script>
</body>

</html>
@endsection