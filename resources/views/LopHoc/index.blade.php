@extends('layout.layout')

@section('content')
    
    {{-- <div class="container"> --}}

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-group">
                        @csrf
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="keyword">Tìm kiếm theo tên lớp : </label>
                                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Nhập từ khoá" aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> Tìm kiếm</button>
                                <a class="btn btn-secondary" href="{{ route("lophoc.index") }}">Làm mới</a>
                            </div>
                            <div class="form-group float-right">
                                <a href="{{ route("lophoc.create") }}" class="btn btn-primary">Thêm lớp học</a>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-inverse">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên lớp học</th>
                                    <th>Giảng viên</th>
                                    <th>Tuỳ chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lop_hocs as $key => $lop_hoc)
                                    <tr>
                                        <td scope="row">{{ $key + 1 }}</td>
                                        <td>{{ $lop_hoc->class_name }}</td>
                                        <td>{{ $lop_hoc->lecturers }}</td>
                                        <td>
                                            <a href="{{ route('lophoc.edit', ['lophoc' => $lop_hoc->id]) }}" class="btn btn-info">Chỉnh sửa</a>
                                            <button type="button" data-url="{{ route('lophoc.destroy', ['lophoc' => $lop_hoc->id]) }}" data-redirect="{{ route('lophoc.index') }}" data-confirm="Xoá lớp học {{ $lop_hoc->class_name }}" class="btn btn-danger btn-delete-item">Xoá</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $lop_hocs->links() }}
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}
@endsection