@extends('master.master')
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
                                    <p class="mb-0">Password</p>
                                </div>
                                <div class="col-sm-9">
                                    <div class="d-flex align-items-center">
                                        <input type="password" id="password" class="form-control" maxlength="8" placeholder="Enter new password" style="background-color: transparent; border: none; color: white;">
                                        <button type="button" id="togglePassword" class="btn btn-sm btn-outline-light ms-2">Show</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-3">
                                    <p class="mb-0"></p>
                                </div>
                                <div class="col-sm-9">
                                    <button type="button" id="savePassword" class="btn btn-sm btn-outline-light">Save Password</button>
                                </div>
                            </div>

                            <script>
                                document.getElementById('togglePassword').addEventListener('click', function() {
                                    const passwordField = document.getElementById('password');
                                    const isHidden = passwordField.type === 'password';
                                    passwordField.type = isHidden ? 'text' : 'password';
                                    this.textContent = isHidden ? 'Hide' : 'Show';
                                });

                                document.getElementById('savePassword').addEventListener('click', function() {
                                    const passwordField = document.getElementById('password');
                                    const newPassword = passwordField.value;

                                    if (newPassword.length === 8) {
                                        // Send new password to server (AJAX or form submission logic goes here)
                                        alert('Password saved successfully!');
                                    } else {
                                        alert('Password must be 8 characters long.');
                                    }
                                });
                            </script>
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