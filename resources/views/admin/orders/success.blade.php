<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng thành công</title>
</head>
<body>
    @if(session('success'))
        <script>
            // Hiển thị thông báo và chuyển hướng
            alert("{{ session('success') }}");
            window.location.href = "{{ route('profile.orders') }}"; // Trở về trang chủ
        </script>
    @else
        <p>Không có thông báo nào để hiển thị.</p>
    @endif
</body>
</html>
