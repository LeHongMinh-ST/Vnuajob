<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Facuty;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Facuty::select('id','name','is_active')->where('is_active',1)->get();

        return view('backend.student.index')->with([
            'faculties'=>$faculties
        ]);
    }

    public function getData()
    {
        $students = Student::all();
        return $this->createDataTable($students);
    }

    public function createDataTable($students)
    {
        return DataTables::of($students)
            ->editColumn('home_town',function($student){
                if($student->home_town) return $student->home_town;
                else return 'Đang cập nhật';
            })
            ->editColumn('class',function($student){
                if($student->class) return $student->class;
                else return 'Đang cập nhật';
            })
            ->editColumn('facuty_id',function($student){
                $faculty = Facuty::findOrFail($student->facuty_id);
                return $faculty->name;
            })
            ->editColumn('phone',function($student){
                if($student->phone) return $student->phone;
                else return 'Đang cập nhật';
            })
            ->editColumn('status',function($student){
                $string = '';
                if($student->status == 0)
                    $string .= '<span class="badge badge-warning">Chưa tìm được việc</span>';
                if ($student->status == 1)
                    $string .= '<span class="badge badge-success">Đã tìm được việc</span>';
                return $string;
            })
            ->editColumn('is_active', function ($student)  {
                $string ='';
                if($student->is_active == 1)
                    $string .='<label class="switcher-control switcher-control-success switcher-control-lg"><input type="checkbox" class="switcher-input" checked="" data-id="'.$student->id.'"> <span class="switcher-indicator"></span> <span class="switcher-label-on"><i class="fas fa-check"></i></span> <span class="switcher-label-off"><i class="fas fa-times"></i></span></label>';
                else
                    $string .='<label class="switcher-control switcher-control-success switcher-control-lg"><input type="checkbox" class="switcher-input" data-id="'.$student->id.'"> <span class="switcher-indicator"></span> <span class="switcher-label-on"><i class="fas fa-check"></i></span> <span class="switcher-label-off"><i class="fas fa-times"></i></span></label>';

                return $string;
            })
            ->addColumn('action', function ($student) {
                $string = '';
                $string .= '<a data-id="' . $student->id . '"  class="btn btn-sm btn-icon btn-secondary btn-edit"  title="chỉnh sửa"><i class="fa fa-pencil-alt"></i></a>';
                $string .= '<a href="" data-id="' . $student->id . '" class="btn btn-sm btn-icon btn-secondary btn-delete" title="xóa"> <i class="far fa-trash-alt"></i></a>';
                return $string;
            })
            ->addIndexColumn()
            ->rawColumns(['is_active', 'action', 'status'])
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
        $input = $request->all();
        try{

            $validate= Validator::make($request->all(),[
                'name'              => 'required|max:100',
                'email'             => 'required|email|max:100',
                'student_code'      => 'required|max:100',
                'facuty_id'         => 'required|max:100',
            ]);

            if(!$validate) return false;

            $input['password'] = Hash::make(env('ADMIN_PASSWORD',12345678));

            $student = Student::create($input);

            if ($student){
                $message = 'Tạo mới thành công';
                return response()->json([
                    'error'     =>false,
                    'message'   =>$message
                ]);
            }

        }catch (\Exception $e) {
            $message = 'Có 1 lỗi gì đó! chờ dev fix';
            return response()->json([
                'error'      =>true,
                'message'    =>$message
            ]);
        }
    }

    public function changeStatus($id)
    {
        $output = [];
        try {

            $student = Student::findOrFail($id);
            if($student->is_active == 1) $output['is_active'] = 0;
            else $output['is_active'] = 1;

            $success = $student->update($output);

            if($success){
                $message = 'Thay đổi trạng thái thành công';
                return response()->json([
                    'error'     =>false,
                    'message'   =>$message,
                ]);
            }

        } catch (\Exception $e) {
            $message = 'Thay đổi trạng thái thất bại';
            return response()->json([
                'error'     =>true,
                'message'   =>$message,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);

        return response()->json([
            'error' =>false,
            'student'  =>$student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();
        try{
            $student = Student::findOrFail($id);
            $validate= Validator::make($request->all(),[
                'name'              => 'required|max:100',
                'email'             => 'required|email|max:100',
                'student_code'      => 'required|max:100',
                'facuty_id'         => 'required|max:100',
            ]);

            if(!$validate) return false;

            $student = $student->update($input);

            if ($student){
                $message = 'Cập nhật thành công';
                return response()->json([
                    'error'     =>false,
                    'message'   =>$message
                ]);
            }

        }catch (\Exception $e) {
            $message = 'Có 1 lỗi gì đó! chờ dev fix';
            return response()->json([
                'error'      =>true,
                'message'    =>$message
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $success = $student->delete();
        if($success){
            $message = 'Xóa thành công!';
            return response()->json([
                'error'     => false,
                'message'   => $message
            ]);
        }else{
            $message = 'Xóa thất bại!';
            return response()->json([
                'error'     => true,
                'message'   => $message
            ]);
        }
    }
}
