@extends('admin.app')

@section('content')
<div class="card-body d-flex flex-column">
    @if(session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Danh sách tài khoản</h6>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên người dùng</th>
                                <th scope="col">Email</th>
                                <th scope="col">Vai trò</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $count = 1 @endphp
                            @foreach ($users as $user )
                            <tr>
                                <th scope="row">{{$count++}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Đơn hàng đã đặt</h6>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên tài khoản</th>
                                <th scope="col">Tài khoản</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Trạng thái đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $count = 1 @endphp
                            @foreach ($orders as $order )
                            <tr>
                                <th scope="row">{{$count++}}</th>
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->user->email}}</td>
                                <td>{{ number_format($order->gia, 2) }} VND</td>
                                <td>{{$order->status}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Người dùng và đơn hàng đã đặt</h6>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên người dùng</th>
                                <th scope="col">Email</th>
                                <th scope="col">Đơn mua</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $count = 1 @endphp
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $count++ }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->orders_count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Danh mục</h6>
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $count = 1 @endphp
                            @foreach ($cate as $cate )
                            <tr>
                                <th scope="row">{{$count++}}</th>
                                <td>{{$cate->theloaitruyen}}</td>
                                <td>
                                    @if($cate->is_active==0)
                                    <span class="text-danger text">Không kích hoạt</span>
                                    @else
                                    <span class="text-success text">Kích hoạt</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Sản Phẩm</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên Truyện</th>
                                    <th scope="col">Thể loại</th>
                                    <th scope="col">Thông tin giới thiệu</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Tác giả</th>
                                    <th scope="col">NXB</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Danh mục</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1 @endphp
                                @foreach ($posts as $post )
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $post->tentruyen }}</td>
                                    <td>{{ $post->theloai }}</td>
                                    <td>{{ $post->thongtingioithieu }}</td>
                                    <td>{{ $post->gia }}</td>
                                    <td>{{ $post->tacgia }}</td>
                                    <td>{{ $post->nxb }}</td>
                                    <td><img src="{{ asset($post->anhgioithieu) }}" alt="image" style="width: 100px;"></td>
                                    <td>{{ $post->category->theloaitruyen }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->


    <!-- Footer Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded-top p-4">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-sm-start">
                    &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                </div>
                <div class="col-12 col-sm-6 text-center text-sm-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
</div>
<!-- Content End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
</div>
@endsection