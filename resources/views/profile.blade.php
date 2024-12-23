@extends('layouts.master')
@section('profile')
<section style="background-color: #121214;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                            alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">{{$user->name}}</h5>
                        <p class="text-white mb-1">Full Stack Developer</p>
                        <p class="text-white mb-4">Bay Area, San Francisco, CA</p>
                        <div class="d-flex justify-content-center mb-2">
                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary">Follow</button>
                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-outline-primary ms-1">Message</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-white mb-0" style="color: white;">{{$user->name}}</p>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-white mb-0">{{$user->email}}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">SĐT</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ old('phone', $user->phone) }}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Địa Chỉ</p>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" name="address" class="form-control"
                                        value="{{ old('address', $user->address) }}">
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection