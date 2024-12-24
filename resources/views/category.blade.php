@extends('master.master')

@section('sachtruyen')
<div class="section-stories-hot mb-5">
    <div class="container">
        <!-- Banner Section -->
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- First slide -->
                <div class="carousel-item active">
                    <img src="{{ asset('images/banner.jpg') }}" alt="Banner 1" class="img-fluid w-100 custom-banner">
                </div>
                <!-- Second slide -->
                <div class="carousel-item">
                    <img src="{{ asset('images/banner2.jpg') }}" alt="Banner 2" class="img-fluid w-100 custom-banner">
                </div>
                <!-- Third slide -->
                <div class="carousel-item">
                    <img src="{{ asset('images/banner3.jpg') }}" alt="Banner 3" class="img-fluid w-100 custom-banner">
                </div>
            </div>

            <!-- Pagination dots -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <!-- Left and right carousel controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="row mb-3">
            <div class="head-title-global d-flex justify-content-between align-items-center">
                <div class="col-6 col-md-4 col-lg-4 head-title-global__left d-flex align-items-center">
                    <h2 class="me-2 mb-0">
                        <a href="#" class="text-decoration-none text-white fs-3 fw-bold story-name" title="Truyện Hot">
                            Sách Hot
                        </a>
                    </h2>
                    <i class="fa-solid fa-fire-flame-curved text-danger"></i>
                </div>
            </div>
        </div>
        <div class="category-section mb-4">
            <!-- Loop through each category -->
            @foreach($categories as $category)
            <div class="row g-4">
                <!-- Loop through all posts in each category -->
                @foreach($category->posts as $post)
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
                                    <p class="text-white mb-2"><strong>Tác giả:</strong> {{ $post->tacgia }}</p>
                                    <p class="text-white mb-2"><strong>Thể loại:</strong> {{ $post->theloai }}</p>

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
            @endforeach

        </div>
        <div class="row mb-3">
            <div class="head-title-global d-flex justify-content-between align-items-center">
                <div class="col-6 col-md-4 col-lg-4 head-title-global__left d-flex align-items-center">
                    <h2 class="me-2 mb-0">
                        <a href="#" class="text-decoration-none text-white fs-3 fw-bold story-name" title="Truyện Hot">
                            Sách Mới
                        </a>
                    </h2>
                    <i class="fa-solid fa-fire-flame-curved text-danger"></i>
                </div>
            </div>
        </div>
        <div class="category-section mb-4">
            <!-- Loop through each category -->
            @foreach($categories as $category)
            <div class="row g-4">
                <!-- Loop through all posts in each category -->
                @foreach($category->posts as $post)
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
            @endforeach
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/filterCategory.js') }}"></script>
@endsection

@section('styles')
@endsection