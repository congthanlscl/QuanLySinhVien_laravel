@extends('layout.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header header-group">
                    @csrf
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="keyword">Tìm kiếm theo tên sinh viên: </label>
                            <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Nhập từ khoá" aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <select class="form-control select2" name="class" id="class">
                                <option value="">Chọn tất cả</option>
                                @foreach ($lop_hocs as $lop_hoc)
                                    <option value="{{ $lop_hoc->id }}">{{ $lop_hoc->class_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"> Tìm kiếm</button>
                            <a class="btn btn-secondary" href="{{ route("sinhvien.index") }}">Làm mới</a>
                        </div>
                        <div class="form-group float-right">
                            <a href="{{ route("sinhvien.create") }}" class="btn btn-primary">Thêm sinh viên</a>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>STT</th>
                                <th>Mã sinh viên</th>
                                <th>Ảnh</th>
                                <th>Họ và tên</th>
                                <th>Ngày sinh</th>
                                <th>Quê quán</th>
                                <th>Lớp</th>
                                <th>Tuỳ chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sinhviens as $key => $sinhvien)
                                <tr>
                                    <td scope="row">{{ $key }}</td>
                                    <td>{{ $sinhvien->id }}</td>
                                    <td id="show-image-modal" data-toggle="modal" data-target="#modelId" data-src="{{ $sinhvien->avatar }}"><img height="50px" src="{{ $sinhvien->avatar }}" alt=""></td>
                                    <td>{{ $sinhvien->fullname }}</td>
                                    <td>{{ date("m-d-Y", strtotime($sinhvien->birthday)) }}</td>
                                    <td>{{ $sinhvien->address }}</td>
                                    <td>{{ $sinhvien->lop_hocs->class_name }}</td>
                                    <td>
                                        <a href="{{ route('sinhvien.edit', ['sinhvien' => $sinhvien->id]) }}" class="btn btn-info">Chỉnh sửa</a>
                                        <button type="button" data-url="{{ route('sinhvien.destroy', ['sinhvien' => $sinhvien->id]) }}" data-redirect="{{ route('sinhvien.index') }}" data-confirm="Xoá sinh viên {{ $sinhvien->fullname }}" class="btn btn-danger btn-delete-item">Xoá</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $sinhviens->links() }}
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ảnh đại diện</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <img src="" id="avatar" width="100%" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>

        $(document).ready(function(){

            $(document).on("click", "#show-image-modal", function(e){

                let src = $(this).attr("data-src");
                console.log(src);

                $("img#avatar").attr("src", src);
            })
        })
    </script>
@endsection