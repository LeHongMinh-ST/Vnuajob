<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::select('id','name','is_active')->where('is_active',1)->get();
        return view('backend.employer.index')->with([
            'companies'=>$companies
        ]);
    }

    public function getData()
    {
        $employers = Employer::all();
        return $this->createDataTable($employers);
    }

    public function createDataTable($employers)
    {
        return DataTables::of($employers)
            ->editColumn('phone',function($employer){
                if($employer->phone) return $employer->phone;
                else return 'Đang cập nhật';
            })

            ->editColumn('company_id',function($employer){
                $company = Company::findOrFail($employer->company_id);
                return $company->name;
            })
            ->editColumn('is_active', function ($employer)  {
                $string ='';
                if($employer->is_active == 1)
                    $string .='<label class="switcher-control switcher-control-success switcher-control-lg"><input type="checkbox" class="switcher-input" checked="" data-id="'.$employer->id.'"> <span class="switcher-indicator"></span> <span class="switcher-label-on"><i class="fas fa-check"></i></span> <span class="switcher-label-off"><i class="fas fa-times"></i></span></label>';
                else
                    $string .='<label class="switcher-control switcher-control-success switcher-control-lg"><input type="checkbox" class="switcher-input" data-id="'.$employer->id.'"> <span class="switcher-indicator"></span> <span class="switcher-label-on"><i class="fas fa-check"></i></span> <span class="switcher-label-off"><i class="fas fa-times"></i></span></label>';

                return $string;
            })
            ->addColumn('action', function ($employer) {
                $string = '';
                $string .= '<a data-id="' . $employer->id . '"  class="btn btn-sm btn-icon btn-secondary btn-edit"  title="chỉnh sửa"><i class="fa fa-pencil-alt"></i></a>';
                $string .= '<a href="" data-id="' . $employer->id . '" class="btn btn-sm btn-icon btn-secondary btn-delete" title="xóa"> <i class="far fa-trash-alt"></i></a>';
                return $string;
            })
            ->addIndexColumn()
            ->rawColumns(['is_active', 'action','title'])
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
                'name'      => 'required|max:100',
                'email'     => 'required|email|max:100',
                'title'     => 'required|max:100',
                'company_id'=>'required'
            ]);

            if(!$validate) return false;

            $input['password'] = Hash::make(env('ADMIN_PASSWORD',12345678));

            $empoloyer = Employer::create($input);

            if ($empoloyer){
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

            $employer = Employer::findOrFail($id);
            if($employer->is_active == 1) $output['is_active'] = 0;
            else $output['is_active'] = 1;

            $success = $employer->update($output);

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
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function show(Employer $employer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employer = Employer::findOrFail($id);

        return response()->json([
            'error' =>false,
            'employer'  =>$employer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();
        try{

            $empoloyer = Employer::findOrFail($id);

            $validate= Validator::make($request->all(),[
                'name'      => 'required|max:100',
                'email'     => 'required|email|max:100',
                'title'     => 'required|max:100',
                'company_id'=> 'required'
            ]);

            if(!$validate) return false;


            $empoloyer = $empoloyer->update($input);

            if ($empoloyer){
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
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employer = Employer::findOrFail($id);
        $success = $employer->delete();
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
