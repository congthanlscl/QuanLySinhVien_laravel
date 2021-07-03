@extends('layout.layout')

@section('content')
    
    {{-- <div class="container"> --}}

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route("sinhvien.update", ["sinhvien" => $sinhvien->id]) }}" method="post" enctype="multipart/form-data">

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
                                        <label for="id">Mã sinh viên</label>
                                        @csrf
                                        @method("put")
                                        <input type="text" name="id" id="id" class="form-control" value="{{ $sinhvien->id }}" readonly placeholder="Nhập mã sinh viên">
                                        @error('id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="full_name">Tên sinh viên</label>
                                        <input type="text" name="full_name" id="full_name" value="{{ $sinhvien->fullname }}" class="form-control" placeholder="Nhập tên sinh viên">
                                        @error('full_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="address">Địa chỉ</label>
                                        <input type="text" name="address" id="address" value="{{ $sinhvien->address }}" class="form-control" placeholder="Nhập địa chỉ sinh viên">
                                        @error('address')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="class_id">Lớp học</label>
                                        <select class="form-control select2" name="class_id" id="class_id">
                                            @foreach ($lop_hocs as $lop_hoc)
                                                <option value="{{ $lop_hoc->id }}" {{ ($lop_hoc->id  ===  $sinhvien->class_id) ? "selected" : "" }}>{{ $lop_hoc->class_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="birthday">Ngày sinh</label>
                                        <div class="input-group">
                                            <input type="text" name="birthday" id="birthday" class="form-control datetimepicker-input" data-target="#birthday">
                                            <div class="input-group-append" data-target="#birthday" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                        @error('birthday')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="avatar">Ảnh đại diện</label>
                                        <input type="file" class="form-control-file" name="avatar" id="avatar" placeholder="Chọn ảnh đại diện">
                                        @error('avatar')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>

            $(document).ready(function(){

                $('#birthday').datetimepicker({
                    date:new Date('{{ $sinhvien->birthday }}'),
                    format: 'DD/MM/YYYY'
                });

            })
        </script>
    {{-- </div> --}}
@endsection