<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_category = Category::all();
        $companies = Company::all();
        return view('backend.post.index')->with([
            'list_category'=>$list_category,
            'companies'=>$companies
        ]);
    }

    public function getData()
    {
        $posts = Post::all();
        return $this->createDataTable($posts);
    }

    public function createDataTable($posts)
    {
        return DataTables::of($posts)
            ->editColumn('phone',function($post){
                if($post->phone) return $post->phone;
                else return 'Đang cập nhật';
            })
            ->editColumn('is_active', function ($post)  {
                $string ='';
                if($post->is_active == 1)
                    $string .='<label class="switcher-control switcher-control-success switcher-control-lg"><input type="checkbox" class="switcher-input" checked="" data-id="'.$post->id.'"> <span class="switcher-indicator"></span> <span class="switcher-label-on"><i class="fas fa-check"></i></span> <span class="switcher-label-off"><i class="fas fa-times"></i></span></label>';
                else
                    $string .='<label class="switcher-control switcher-control-success switcher-control-lg"><input type="checkbox" class="switcher-input" data-id="'.$post->id.'"> <span class="switcher-indicator"></span> <span class="switcher-label-on"><i class="fas fa-check"></i></span> <span class="switcher-label-off"><i class="fas fa-times"></i></span></label>';

                return $string;
            })
            ->editColumn('status',function ($post){
                if ($post->status == 0) return 'Chưa đủ số lượng';
                else return 'Đã đủ số lượng';
            })
            ->editColumn('date_public',function ($post){
                if ($post->date_public == null) return 'Đang cập nhật';
                else return $post->date_public;
            })
            ->editColumn('job_nature',function ($post){
                if ($post->job_nature == null) return 'Đang cập nhật';
                else return $post->job_nature;
            })
            ->editColumn('company_id',function ($post){
                if ($post->company_id == null) return 'Đang cập nhật';
                else return $post->company_id;
            })
            ->editColumn('salary',function ($post){
                if ($post->salary == null) return 'Đang cập nhật';
                else return $post->salary;
            })
            ->editColumn('vacancy',function ($post){
                if ($post->vacancy == null) return 'Đang cập nhật';
                else return $post->vacancy;
            })

            ->addColumn('action', function ($post) {
                $string = '';
                $string .= '<a data-id="' . $post->id . '"  class="btn btn-sm btn-icon btn-secondary btn-edit"  title="chỉnh sửa"><i class="fa fa-pencil-alt"></i></a>';
                $string .= '<a href="" data-id="' . $post->id . '" class="btn btn-sm btn-icon btn-secondary btn-delete" title="xóa"> <i class="far fa-trash-alt"></i></a>';
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
        $list_category = Category::all();
        $companies = Company::all();
        return view('backend.post.create')->with([
            'list_category'=>$list_category,
            'companies'=>$companies
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
        $input = $request->all();

        try {
//            $validate = Validator::make($request->all(),[
//
//            ]);

            if (Auth::guard('user')->user()!=null){
                $input['user_id'] = Auth::guard('user')->user()->id;
                $input['user_table'] = 0;
            }

            if (Auth::guard('employer')->user()!=null){
                $input['user_id'] = Auth::guard('employer')->user()->id;
                $input['user_table'] = 1;
            }

            $post = Post::create($input);

            if ($post){
                $messgae = 'Tạo mới thành công';
                return response()->json([
                    'error'      =>false,
                    'message'    =>$messgae
                ]);
            }

        }catch (\Exception $e){
            $messgae = 'Có một lỗi gì đó';
            return response()->json([
               'error'      =>true,
               'message'    =>$e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return response()->json([
            'error' =>false,
            'post'  =>$post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();
//        dd($input);
        try {
            $post = Post::findOrFail($id);
//            $validate = Validator::make($request->all(),[
//
//            ]);

            $post = $post->update($input);

            if ($post){
                $message = 'Cập nhật thành công';
                return response()->json([
                    'error'      =>false,
                    'message'    =>$message
                ]);
            }

        }catch (\Exception $e){
            $message = 'Có một lỗi gì đó';
            return response()->json([
                'error'      =>true,
                'message'    =>$e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $success = $post->delete();
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
    public function getAddress($id){
        $company= Company::where('id',$id)->first();
        return response()->json([
            'address'=>$company->address
        ]);
    }


    public function changeStatus($id)
    {
        $output = [];
        try {

            $post = Post::findOrFail($id);
            if($post->is_active == 1) $output['is_active'] = 0;
            else $output['is_active'] = 1;

            $success = $post->update($output);

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
}
