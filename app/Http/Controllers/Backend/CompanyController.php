<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Facuty;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.company.index');

    }


    public function getData()
    {
        $companys = Company::all();
        $user_login = Auth::user();
        return DataTables::of($companys)
            ->editColumn('logo',function ($company){
                return '<img src="/storage/'.$company->logo.'" style="width: 150px;" >';
            })
            ->addColumn('action', function ($company) {
                return '<a data-id="' . $company->id . '" class="btn btn-primary btn-icon btn-edit" title="Sửa thông tin"><i class="fas fa-edit"></i></a>
                          <a data-id="' . $company->id . '" class="btn btn-danger btn-icon btn-delete" title="Xóa"><i class="fas fa-trash"></i></a>';
            })
            ->addIndexColumn()
            ->rawColumns(['is_active', 'action','logo'])
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
        $input  = $request->all();

        try {

            $validate= Validator::make($request->all(),[
                'name'      => 'required|max:100',
                'email'     => 'required|email|max:100',
                'website'   => 'required|max:100',
                'address'   => 'required|max:100',
                'file'      => 'required|max:10000|mimes:jpg,png,jpeg'
            ]);

            if(!$validate) return false;

            $logo = '';

            if($request->hasFile('file')){
                $nameFile = Carbon::now()->timestamp;
                Storage::putFileAs('public/companies',$request->file('file'),$nameFile . '.' . pathinfo($request->file->getClientOriginalName(), PATHINFO_EXTENSION));
                $logo = 'companies/' . $nameFile . '.' . pathinfo($request->file->getClientOriginalName(), PATHINFO_EXTENSION);
            }

            $input['logo'] = $logo;

            $company = Company::create($input);

            if($company){
                $message = 'Tạo mới thành công';
                return response()->json([
                    'error'     =>false,
                    'message'   =>$message,
                    'company'   =>$company
                ]);
            }


        }catch (\Exception $e){
            $message = 'Tạo công ty thất bại!';
            return response()->json([
                'error'     =>true,
                'message'   =>$e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company=Company::where('id',$id)->first();
        return response()->json([
            'company'=>$company
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input  = $request->all();
        try {

            $validate= Validator::make($request->all(),[
                'name'      => 'required|max:100',
                'email'     => 'required|email|max:100',
                'website'   => 'required|max:100',
                'address'   => 'required|max:100',
//                'file'      => 'required|max:10000|mimes:jpg,png,jpeg'
            ]);

            if(!$validate) return false;

            $logo = '';

            if($request->hasFile('file')){
                $nameFile = Carbon::now()->timestamp;
                Storage::putFileAs('public/companies',$request->file('file'),$nameFile . '.' . pathinfo($request->file->getClientOriginalName(), PATHINFO_EXTENSION));
                $logo = 'companies/' . $nameFile . '.' . pathinfo($request->file->getClientOriginalName(), PATHINFO_EXTENSION);
            }

            $input['logo'] = $logo;
            $company= Company::where('id', $id)->first();
            DB::beginTransaction();
            $result = $company->update($input);
            DB::commit();
            if($result){
                $message = 'Cập nhật thành công';
                return response()->json([
                    'error'     =>false,
                    'message'   =>$message,
                    'company'   =>$company
                ]);
            }


        }catch (\Exception $e){
            $message = 'Cập nhật công ty thất bại!';
            return response()->json([
                'error'     =>true,
                'message'   =>$e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company=Company::where('id',$id)->first();
        $name = $company->name;
        $company->delete();
        return response()->json([
            'name'=>$name
        ]);
    }
}
