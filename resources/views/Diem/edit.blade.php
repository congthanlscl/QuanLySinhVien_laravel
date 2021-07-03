@extends('layout.layout')

@section('content')
    
    {{-- <div class="container"> --}}

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route("diem.update", ["diem" => $diem->id]) }}" method="post">

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
                                        <label for="student_id">Sinh viên</label>
                                        @csrf
                                        @method('put')
                                        <select class="form-control" disabled name="student_id" id="student_id">
                                            @foreach ($sinhviens as $sinhvien)
                                                <option value="{{ $sinhvien->id }}" {{ $sinhvien->id == $diem->student_id ? "selected" : "" }}>{{ $sinhvien->fullname }}</option>
                                            @endforeach
                                        </select>
                                        @error('student_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="score">Điểm số</label>
                                        <input type="text" name="score" id="score" class="form-control" value="{{ $diem->score }}" placeholder="Nhập điểm">
                                        @error('score')
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