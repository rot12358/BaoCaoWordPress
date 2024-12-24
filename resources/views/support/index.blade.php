@extends('support.master')
@section('support')
<div class="container mt-5">
    <div class="row">
        <!-- Map Section -->
        <div class="col-md-6">
            <h5>Bản đồ vị trí</h5>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4937.389498902532!2d107.58516307606092!3d16.457689128919668!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3141a147ba6bdbff%3A0x2e605afab4951ad9!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEPDtG5nIG5naGnhu4dwIEh14bq_!5e1!3m2!1svi!2s!4v1735038203840!5m2!1svi!2s"
                width="600" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        <!-- Contact Form Section -->
        <div class="col-md-6">
            <h5>Liên hệ</h5>
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
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Nhập thông tin bạn muốn hỗ trợ"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Gửi</button>
            </form>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
@endsection