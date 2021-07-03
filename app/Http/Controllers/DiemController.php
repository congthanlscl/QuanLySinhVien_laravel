<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diem;
use App\Models\Sinhvien;

class DiemController extends Controller
{

    private $per_page = 2;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $keyword = $request->keyword;
        $diem = new Diem;

        if(!empty($keyword)){
            $diem = $diem->where("student_id", $keyword);
        }

        $diems = $diem->paginate($this->per_page);
        
        $data = [
            "title"    => "Danh sách điểm sinh viên",
            'diems' => $diems
        ];

        return view("Diem.index", $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sinhviens = Sinhvien::all();

        $data = [
            "sinhviens" => $sinhviens,
            "title"     => "Thêm điểm sinh viên",
        ];

        return view("Diem.create", $data);
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

        $validated = $request->validate([
            'student_id' => 'required',
            'score'  => 'required|numeric|max:10|min:0',
        ],
        [
            'student_id.required' => 'Sinh viên là cần thiết',
            'score.required'      => 'Điểm là cần thiết',
            'score.numeric'       => 'Điểm phải là số',
            'score.max'           => 'Điểm tối đa là 10',
            'score.min'           => 'Điểm tối thiểu là 0',
        ]);
        
        $diem = [
            'score'      => $request->score,
            "student_id" => $request->student_id,
        ];
        Diem::create($diem);

        return redirect()->route("diem.create")->with("msg", "Thêm thành công");
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

        $sinhviens = Sinhvien::all();
        $diem = Diem::find($id);
        $data = [
            "title"     => "Cập nhật lớp học",
            "diem"      => $diem,
            'sinhviens' => $sinhviens
        ];

        return view("Diem.edit", $data);
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

        $validated = $request->validate([
            'score'  => 'required|numeric|max:10|min:0',
        ],
        [
            'score.required'      => 'Điểm là cần thiết',
            'score.numeric'       => 'Điểm phải là số',
            'score.max'           => 'Điểm tối đa là 10',
            'score.min'           => 'Điểm tối thiểu là 0',
        ]);
        
        $diem = [
            'score'      => $request->score,
        ];
        Diem::where("id", $id)->update($diem);

        return redirect()->route("diem.edit", ["diem" => $id])->with("msg", "Cập nhật thành công");
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

        
        $diem = Diem::find($id);
        $diem->delete();

        return response()->json([
            'st'  => 'success',
            'txt' => 'Xoá thành công'
        ]);
    }
}
