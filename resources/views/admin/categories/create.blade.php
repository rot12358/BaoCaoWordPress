@extends('admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header"><h1>Thêm danh mục</h1></div><br>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                </div>

                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="tendanhmuc" class="form-label">Tên danh mục</label>
                        <input type="text" name="theloaitruyen" value="{{ old('theloaitruyen') }}" class="form-control" id="tendanhmuc" aria-describedby="tendanhmucHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail" class="form-label">Kích hoạt</label>
                        <select class="form-select" name="is_active" aria-label="Default select example">
                            <option value="1" selected>Kích hoạt</option>
                            <option value="0">Không kích hoạt</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark">Thêm</button>
                </form>
            </div>
        </div>
    </div>
@endsection