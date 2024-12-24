@extends('master.master')

@section('sanpham')
<div class="container">
    <div class="row g-3"> <!-- Khoảng cách giữa các sản phẩm -->
        @foreach($posts as $post)
        <div class="col-12 col-sm-6 col-md-4 col-lg-2">
            <div class="card h-100 shadow-sm position-relative custom-card" style="border: none;">
                <a href="{{ route('detail.show', ['id' => $post->id]) }}" class="text-decoration-none">
                    <div class="image-container position-relative">
                        <img src="{{ $post->anhgioithieu }}" alt="{{ $post->tentruyen }}" class="card-img-top img-fluid custom-image">

                        <!-- Price tag -->
                        <div class="price-tag position-absolute">
                            <b class="text-white bg-dark p-1">{{ $post->gia }} Đ</b>
                        </div>

                        <div class="hover-info position-absolute p-3">
                            <b class="text-white">Tác giả: {{ $post->tacgia }}</b>
                            <!-- Add to Cart form -->
                            <form method="POST" action="{{ route('cart.add') }}">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                            </form>
                        </div>
                    </div>
                </a>
                <div class="card-body d-flex flex-column">
                    <a href="{{ route('detail.show', ['id' => $post->id]) }}" class="card-title text-white text-truncate">
                        {{ $post->tentruyen }}
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection