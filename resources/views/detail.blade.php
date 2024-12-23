@extends('layouts.master')

@section('detail')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/" class="btn btn-secondary mb-4">Quay lại</a>

            <div class="card shadow-sm">
                <div class="row no-gutters">
                    <!-- Left side: Image -->
                    <div class="col-md-4">
                        <img src="{{ asset($post->anhgioithieu) }}" alt="image" class="img-fluid img-custom">
                    </div>

                    <!-- Right side: Book details -->
                    <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title mb-3">{{ $post->tentruyen }}</h2>
                            <div class="d-flex justify-content-between">
                                <p class="card-text"><strong>Tác giả:</strong> {{ $post->tacgia }}</p>
                                <p class="card-text"><strong>Nhà Xuất Bản:</strong> {{ $post->nxb }}</p>
                            </div>
                            <p class="card-text text-white mb-4">{{ $post->thongtingioithieu }}</p>
                            <div class="mt-4 d-flex justify-content-between">
                                <!-- Add to cart button -->
                                <form method="POST" action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
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
    </div>
</div>


@endsection