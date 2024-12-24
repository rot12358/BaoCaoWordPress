@extends('admin.app')

@section('content')
<div class="container">
    <h2>Danh sách người dùng</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Hành động</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
        @php $count = 1 @endphp
            @foreach ($users as $user)
            <tr>
                <td>{{ $count++ }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    @if ($user->role !== 'admin')
                    <form action="{{ route('admin.makeAdmin', $user->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-primary">Cấp Quyền Admin</button>
                    </form>
                    @else
                    <form action="{{ route('admin.makeUser', $user->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-warning">Hạ Thành User</button>
                    </form>
                    @endif
                </td>
                <td>
                    <!-- Thêm nút Xóa -->
                    <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa tài khoản này không?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection