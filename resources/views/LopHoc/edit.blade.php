@extends('layout.layout')

@section('content')
    
    {{-- <div class="container"> --}}

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route("lophoc.update", ["lophoc" => $lop_hoc->id]) }}" method="post">

                    <div class="card">
                        <div class="card-header">
                            @if (Session::has('msg'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('msg') }}
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="class_name">Tên lớp</label>
                                        @csrf
                                        @method("put")
                                        <input type="text" name="class_name" id="class_name" readonly class="form-control" value="{{ $lop_hoc->class_name }}" placeholder="Nhập tên lớp học" aria-describedby="helpId">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="lecturers">Giảng viên</label>
                                        <input type="text" name="lecturers" id="lecturers" class="form-control" value="{{ $lop_hoc->lecturers }}" placeholder="Nhập tên giảng viên" aria-describedby="helpId">
                                        @error('lecturers')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    {{-- </div> --}}
@endsection