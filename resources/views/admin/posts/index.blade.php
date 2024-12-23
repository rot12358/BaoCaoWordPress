@extends('admin.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Liệt kê Truyện</div>

                <div class="card-body">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên truyện</th>
                                <th scope="col">Thể loại</th>
                                <th scope="col">Thông tin giới thiệu</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Tác giả</th>
                                <th scope="col">NXB</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $count = 1 @endphp
                            @foreach($posts as $post)
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
                                <td>
                                    <a href="{{ route('post.edit', [$post->id]) }}" class="btn btn-primary">Sửa</a>
                                    <form action="{{ route('post.destroy', [$post->id]) }}" method="POST" style="display:inline-block;">
                                        @method("DELETE")
                                        @csrf
                                        <button class="btn btn-danger" onclick="return confirm('Bạn muốn xoá truyện này?');">Xoá</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
