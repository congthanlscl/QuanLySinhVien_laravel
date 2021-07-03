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
                                <label for="keyword">Tìm kiếm theo mã sinh viên : </label>
                                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Nhập mã sinh viên" aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> Tìm kiếm</button>
                                <a class="btn btn-secondary" href="{{ route("diem.index") }}">Làm mới</a>
                            </div>
                            <div class="form-group float-right">
                                <a href="{{ route("diem.create") }}" class="btn btn-primary">Thêm điểm sinh viên</a>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-inverse">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>STT</th>
                                    <th>Mã sinh viên</th>
                                    <th>Tên sinh viên</th>
                                    <th>Điểm</th>
                                    <th>Tuỳ chọn</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($diems as $key => $diem)
                                    <tr>
                                        <td scope="row">{{ $key + 1 }}</td>
                                        <td>{{ $diem->sinhvien->id }}</td>
                                        <td>{{ $diem->sinhvien->fullname }}</td>
                                        <td>{{ $diem->score }}</td>
                                        <td>
                                            <a href="{{ route('diem.edit', ['diem' => $diem->id]) }}" class="btn btn-info">Chỉnh sửa</a>
                                            <button type="button" data-url="{{ route('diem.destroy', ['diem' => $diem->id]) }}" data-redirect="{{ route('diem.index') }}" data-confirm="Xoá điểm sinh viên {{ $diem->sinhvien->fullname }}" class="btn btn-danger btn-delete-item">Xoá</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $diems->links() }}
                    </div>
                </div>
            </div>
        </div>
    {{-- </div> --}}
@endsection