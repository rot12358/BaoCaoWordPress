@extends('layouts.master')

@section('comment')

<div class="tentruyen">
    <a href="/">Quay lại</a>
    <h5 class="card-title" style="margin:30px 0;">Tên Truyện: {{ $post->tentruyen }}</h5>
    <div>
        <p class="card-text" style="max-width: 1600px;display:flex;margin:10px 15px">{{ $post->thongtingioithieu }}</p>
        <p class="card-text text-end"><strong>Tác giả:</strong> {{ $post->tacgia }}</p>
        <p class="card-text text-end"><strong>Nhà Xuất Bản:</strong> <span style="padding-right: 50px;">{{ $post->nxb }}</span></p>

        <!-- Comments Section -->
        <div class="comments">
            <h5>Comments</h5>
            @foreach($post->comments as $comment)
                <div class="comment">
                    <p><strong>{{ $comment->author }}</strong></p>
                    <p>{{ $comment->content }}</p>
                    <p class="text-muted">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>

        <!-- Add Comment Form -->
        <div class="add-comment">
            <h5>Add a Comment</h5>
            <form method="POST" action="{{ route('comments.store') }}">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="mb-3">
                    <label for="author" class="form-label">Name</label>
                    <input type="text" name="author" class="form-control" id="author" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Comment</label>
                    <textarea name="content" class="form-control" id="content" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection
