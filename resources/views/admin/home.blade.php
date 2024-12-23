@extends('admin.app')

@section('content')
<div class="card-body d-flex flex-column">
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="mt-4 flex-grow-1 d-flex flex-column align-items-center justify-content-center">
        <h5 class="text-center">Chào mừng bạn đến với hệ thống quản trị Admin</h5>
        <p class="text-center text-muted">Sử dụng menu trên để điều hướng và quản lý hệ thống.</p>
    </div>
</div>
@endsection