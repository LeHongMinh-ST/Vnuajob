<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Facuty;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class FacutyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.facuty.index');
    }

    public function getData()
    {
        $facutys = Facuty::all();
        $user_login = Auth::user();
        return DataTables::of($facutys)
            ->addColumn('count_student' ,function($facuty){
                $count= Student::where('facuty_id',$facuty->id)->get()->count();
                return $count;
            })
            ->addColumn('action', function ($facuty) {
                return '<a data-id="' . $facuty->id . '" class="btn btn-primary btn-icon btn-edit" title="Sửa thông tin"><i class="fas fa-edit"></i></a>
                          <a data-id="' . $facuty->id . '" class="btn btn-danger btn-icon btn-delete" title="Xóa"><i class="fas fa-trash"></i></a>';
            })
            ->addIndexColumn()
            ->rawColumns(['is_active', 'action'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $data=$request->all();
        $data['is_active']=1;
        $facuty=Facuty::create($data);
        DB::commit();
        return response()->json([
            'error'=>false,
            'message'=>'Thêm mới thành công một khoa'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facuty  $facuty
     * @return \Illuminate\Http\Response
     */
    public function show(Facuty $facuty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facuty  $facuty
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facuty=Facuty::where('id',$id)->first();
        return response()->json([
            'facuty'=>$facuty
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facuty  $facuty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $data=$request->all();
        $facuty=Facuty::where('id',$id)->first();
        $facuty->update($data);
        DB::commit();
        return response()->json([
            'error'=>true,
            'message'=>'Cập nhật thành công thông tin khoa '.$facuty['name']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facuty  $facuty
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $facuty=Facuty::where('id',$id)->first();
        $name = $facuty->name;
        $facuty->delete();
        return response()->json([
            'name'=>$name
        ]);
    }
}
