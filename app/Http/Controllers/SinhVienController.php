<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LopHoc;
use App\Models\Sinhvien;

class SinhVienController extends Controller
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
        $sinhvien = new Sinhvien;

        $keyword = $request->keyword;
        $class   = $request->class;
        if(!empty($keyword)){

            $sinhvien = $sinhvien->where("fullname", "like", "%".$keyword."%");
        }

        if(!empty($class)){

            $sinhvien = $sinhvien->where("class_id", $class);
        }
        $sinhviens = $sinhvien->paginate($this->per_page);
        $lop_hocs = LopHoc::all();
        
        $data = [
            "title"     => "Danh sách sinh viên",
            'sinhviens' => $sinhviens,
            'lop_hocs'  => $lop_hocs
        ];
        return view("SinhVien.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lop_hocs = Lophoc::all();
        $data = [
            "title"    => "Thêm sinh viên",
            "lop_hocs" => $lop_hocs,
        ];

        return view("SinhVien.create", $data);
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
            'id'         => 'required|unique:sinhviens,id|numeric',
            'full_name'  => 'required',
            'address'    => 'required',
            'class_id'   => 'required',
            'birthday'   => 'required',
        ],
        [
            'id.unique'          => 'Mã sinh viên đã tồn tại',
            'id.numeric'         => 'Mã sinh viên phải là ký tự số',   
            'id.required'        => 'Mã sinh viên là cần thiết',
            'full_name.required' => 'Tên sinh viên là cần thiết',
            'address.required'   => 'Địa chỉ là cần thiết',
            'birthday'           => 'Ngày sinh là cần thiết',
        ]);

        $avatar = "";

        if($request->hasFile('avatar')){

            $extension = $request->avatar->extension();

            $filepath = "img/user";
            $filename = $request->id. "." . $extension;
            $avatar = $filepath . "/" . $filename;

            $avatar_upload = $request->file('avatar');
            $avatar_upload->move($filepath, $filename);
        }

        $sinhvien = [
            'id' => $request->id,
            'fullname' => $request->full_name,
            'address' => $request->address,
            'class_id' => $request->class_id,
            'birthday' => date("Y-m-d", strtotime(str_replace("/", "-", $request->birthday)))
        ];

        if(!empty($avatar)){
            $sinhvien["avatar"] = $avatar;
        }

        Sinhvien::create($sinhvien);

        return redirect()->route('sinhvien.create')->with('msg', 'Thêm sinh viên thành công !');

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
        $sinhvien = Sinhvien::find($id);
        $lop_hocs = Lophoc::all();
        $data = [
            "title"    => "Cập nhật sinh viên",
            "sinhvien" => $sinhvien,
            'lop_hocs' => $lop_hocs
        ];

        return view("SinhVien.edit", $data);
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
            'id'         => 'required',
            'full_name'  => 'required',
            'address'    => 'required',
            'class_id'   => 'required',
            'birthday'   => 'required',
        ],
        [
            'id.required'        => 'Mã sinh viên là cần thiết',
            'full_name.required' => 'Tên sinh viên là cần thiết',
            'address.required'   => 'Địa chỉ là cần thiết',
            'class_id.required'  => 'Lớp học là cần thiết',
            'birthday'           => 'Ngày sinh là cần thiết',
        ]);

        $avatar = "";

        $old_sinhvien = Sinhvien::find($id); 

        if($request->hasFile('avatar')){

            $extension = $request->avatar->extension();

            $filepath = "img/user";
            $filename = $request->id. "." . $extension;
            $avatar = $filepath . "/" . $filename;

            $avatar_upload = $request->file('avatar');

            if (file_exists(public_path($old_sinhvien->avatar)) && strpos($old_sinhvien->avatar, "default-user-image") == false ) {   
                unlink(public_path($old_sinhvien->avatar));
            }

            $avatar_upload->move($filepath, $filename);
        }

        $sinhvien = [
            'fullname' => $request->full_name,
            'address' => $request->address,
            'class_id' => $request->class_id,
            'birthday' => date("Y-m-d", strtotime(str_replace("/", "-", $request->birthday)))
        ];

        if(!empty($avatar)){
            $sinhvien["avatar"] = $avatar;
        }

        Sinhvien::where("id", $id)->update($sinhvien);

        return redirect()->route('sinhvien.edit', ["sinhvien" => $id])->with('msg', 'Cập nhật sinh viên thành công !');
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

        $sinhvien = Sinhvien::find($id);
        if (file_exists(public_path($sinhvien->avatar)) && strpos($sinhvien->avatar, "default-user-image") == false) {   
            unlink(public_path($sinhvien->avatar));
        }
        $sinhvien->delete();

        return response()->json([
            'st'  => 'success',
            'txt' => 'Xoá thành công'
        ]);
    }
}
