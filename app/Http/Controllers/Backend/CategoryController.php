<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Facuty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psy\Util\Str;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.category.index');
    }


    public function getData()
    {
        $categories = Category::all();
        $user_login = Auth::user();
        return DataTables::of($categories)
            ->editColumn('parent',function ($category){
                if (!empty($category->parent_id)){
                    $parent= Category::where('id', $category->parent_id)->first();
                    return $parent->name;
                }
                return '';
            })
            ->addColumn('action', function ($category) {
                return '<a data-id="' . $category->id . '" class="btn btn-primary btn-icon btn-edit" title="Sửa thông tin"><i class="fas fa-edit"></i></a>
                        <a data-id="' . $category->id . '" class="btn btn-danger btn-icon btn-delete" title="Xóa"><i class="fas fa-trash"></i></a>';
            })
            ->addIndexColumn()
            ->rawColumns(['is_active', 'action','parent'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $options='';
        foreach ($categories as $category){
            $options.='<option value="'.$category->id.'">'.$category->name.'</option>';
        }
        return response()->json([
            'options'=>$options
        ]);
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
        $data['slug']=\Illuminate\Support\Str::slug($request->get('name')).time();
        $data['user_created_id']= Auth::id();
        $data['is_active']=1;
        $category=Category::create($data);
        DB::commit();
        return response()->json([
            'error'=>false,
            'message'=>'Thêm mới thành công danh mục '.$category->name
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this_category=Category::where('id',$id)->first();
        $categories = Category::all();
        $options='';
        foreach ($categories as $category){
            if($category->id == $this_category->parent_id){
                $options.='<option value="'.$category->id.'" selected>'.$category->name.'</option>';

            }else{
                $options.='<option value="'.$category->id.'">'.$category->name.'</option>';

            }
        }
        return response()->json([
            'category'=>$this_category,
            'options'=>$options
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $category= Category::where('id',$id)->first();
        $data=$request->all();
        $data['slug']=\Illuminate\Support\Str::slug($request->get('name')).time();
        $category->update($data);
        DB::commit();
        return response()->json([
            'error'=>false,
            'message'=>'Thêm mới thành công danh mục '.$category->name
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::where('id',$id)->first();
        $name = $category->name;
        $sons = Category::where('parent_id', $id)->get();
        foreach ($sons as $son){
            $son->parent_id = null;
            $son->save();
        }
        $category->delete();
        return response()->json([
            'error'=>false,
        ]);
    }
}
