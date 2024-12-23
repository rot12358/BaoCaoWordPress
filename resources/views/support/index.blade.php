@extends('support.master')
@section('support')
<div class="container mt-5">
    <form action="{{ route('support.send') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên của bạn">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập địa chỉ email của bạn">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại của bạn">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ của bạn">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Ý Kiến Của Mọi Người</label>
            <textarea class="form-control" id="message" name="message" rows="5"
                placeholder="Nhập thông tin bạn muốn hỗ trợ"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
@endsection