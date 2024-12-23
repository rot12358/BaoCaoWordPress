@extends('layouts.master')

@section('content1')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <a href="/" class="btn btn-secondary mb-4">Quay lại</a>
            <h2 class="card-title">{{ $post->tentruyen }}</h2>
            <p class="card-text mb-4">{{ $post->thongtingioithieu }}</p>
            <p class="card-text text-end"><strong>Tác giả:</strong> {{ $post->tacgia }}</p>
            <p class="card-text text-end"><strong>Nhà Xuất Bản:</strong> {{ $post->nxb }}</p>
        </div>
    </div>
</div>

@endsection