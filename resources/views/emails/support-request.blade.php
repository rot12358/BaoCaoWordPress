<!-- resources/views/emails/support-request.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Request</title>
</head>
<body>
    <p>Xin chào,</p>

    <p>Bạn nhận được một yêu cầu hỗ trợ từ:</p>

    <ul>
        <li><strong>Họ và tên:</strong> {{ $name }}</li>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Số điện thoại:</strong> {{ $phone }}</li>
        <li><strong>Địa chỉ:</strong> {{ $address }}</li>
    </ul>

    <p>Vui lòng xem xét và xử lý yêu cầu này.</p>

    <p>Trân trọng,</p>
    <p>Đội ngũ hỗ trợ</p>
</body>
</html>
