<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LopHoc;

class LopHocController extends Controller
{

    // sadasdsadsadsadsadsa
    private $per_page = 2;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index(Request $request)
    {
        //

        $lop_hoc = new LopHoc;
        $keyword = $request->keyword;
        if($keyword){
            $lop_hocs = $lop_hoc->where("class_name", "like", "%".$keyword."%")->paginate($this->per_page);
        }
        else{
            $lop_hocs = $lop_hoc->paginate($this->per_page);
        }


        $data = [
            "title"    => "Danh sách lớp học",
            'lop_hocs' => $lop_hocs
        ];

        return view("LopHoc.index", $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            "title" => "Thêm lớp học"
        ];

        return view("LopHoc.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'class_name' => 'required|unique:lop_hocs,class_name',
            'lecturers'  => 'required',
        ],
        [
            'class_name.unique'   => 'Tên lớp học đã tồn tại',
            'class_name.required' => 'Tên lớp học là cần thiết',
            'lecturers.required'  => 'Giảng viên là cần thiết',
        ]);
        
        $lop_hoc = [
            'class_name' => $request->class_name,
            "lecturers" => $request->lecturers,
        ];
        LopHoc::create($lop_hoc);

        return redirect()->route("lophoc.create")->with("msg", "Thêm thành công");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
        $lop_hoc = LopHoc::find($id);
        $data = [
            "title"   => "Cập nhật lớp học",
            "lop_hoc" => $lop_hoc
        ];

        return view("LopHoc.edit", $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        request()->validate([
            'lecturers' => 'required',
        ],
        [
            'lecturers.required' => 'Giảng viên là cần thiết',
        ]);
        
        $lop_hoc = [
            "lecturers" => $request->lecturers,
        ];
        LopHoc::where("id", $id)->update($lop_hoc);

        return redirect()->route("lophoc.edit", ["lophoc" => $id])->with("msg", "Cập nhật thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $lop_hoc = LopHoc::find($id);
        $lop_hoc->delete();

        return response()->json([
            'st'  => 'success',
            'txt' => 'Xoá thành công'
        ]);
    }
}
