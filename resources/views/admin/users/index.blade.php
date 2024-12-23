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
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if ($user->role !== 'admin')
                            <form action="{{ route('admin.makeAdmin', $user->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-primary">Cấp Quyền Admin</button>
                            </form>
                        @else
                            <form action="{{ route('admin.makeUser', $user->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-warning">Hạ Thành User</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection