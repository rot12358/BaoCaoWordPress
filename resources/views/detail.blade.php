@extends('layouts.master')

@section('detail')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8" style="width:80%;">
            <div class="card shadow-sm">
                <div class="row no-gutters">
                    <!-- Left side: Image -->
                    <div class="col-md-4">
                        <img src="{{ asset($anhgioithieu) }}" alt="{{ $post->tentruyen }}" class="img-fluid img-custom">
                    </div>

                    <!-- Right side: Book details -->
                    <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title mb-3">{{ $post->tentruyen }}</h2>

                            <!-- Book Details (Vertical alignment) -->
                            <div class="mb-3">
                                <p class="card-text"><strong>Tác giả:</strong> {{ $post->tacgia }}</p>
                                <p class="card-text"><strong>Thể loại:</strong> {{ $post->theloai }}</p>
                                <p class="card-text"><strong>Nhà Xuất Bản:</strong> {{ $post->nxb }}</p>
                                <p class="card-text"><strong>Giá:</strong> {{ $post->gia }} VND</p>
                            </div>
                            <hr>
                            <!-- Short Description -->
                            <p class="card-text text-white mb-4">{{ $post->thongtingioithieu }}</p>

                            <!-- Buttons Section -->
                            <div class="mt-4 d-flex justify-content-start">
                                <!-- Add to cart button -->
                                <form method="POST" action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary mr-2">Mua Sách Giấy</button>
                                </form>

                                <!-- Read book button -->
                                <a href="{{ route('show.show', ['id' => $post->id]) }}" class="btn btn-success">
                                    <i class="fas fa-book-open"></i> Đọc sách
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="category-section mt-5">
            <h3>Có thể bạn thích</h3>
            <div class="row g-4">
                @foreach($relatedPosts as $relatedPost)
                <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                    <div class="card h-100 shadow-sm position-relative custom-card" style="border: none;">
                        <a href="{{ route('detail.show', ['id' => $relatedPost->id]) }}" class="text-decoration-none">
                            <div class="image-container position-relative">
                                <img src="{{ asset($relatedPost->anhgioithieu) }}" alt="{{ $relatedPost->tentruyen }}" class="card-img-top img-fluid custom-image">

                                <!-- Price tag -->
                                <div class="price-tag position-absolute">
                                    <b class="text-white bg-dark p-1">{{ $relatedPost->gia }} Đ</b>
                                </div>

                                <div class="hover-info position-absolute p-3">
                                    <b class="text-white">Tác giả: {{ $relatedPost->tacgia }}</b>
                                    <!-- Add to Cart form -->
                                    <form method="POST" action="{{ route('cart.add') }}">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $relatedPost->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                                    </form>
                                </div>
                            </div>
                        </a>
                        <div class="card-body d-flex flex-column">
                            <a href="{{ route('detail.show', ['id' => $relatedPost->id]) }}" class="card-title text-white text-truncate">
                                {{ $relatedPost->tentruyen }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection