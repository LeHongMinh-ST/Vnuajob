<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employer;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
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
        $companies = Company::select('id','name','is_active')->where('is_active',1)->get();
        return view('backend.post.index')->with([
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
            ->editColumn('date_public',function($post){
                if($post->date_public) return $post->date_public;
                else return 'Đang cập nhật';
            })
            ->editColumn('vacancy',function($post){
                if($post->vacancy) return $post->vacancy;
                else return 'Đang cập nhật';
            })
            ->editColumn('company_id',function($post){
                $company = Company::findOrFail($post->company_id);
                return $company->name;
            })

            ->editColumn('user_created_id',function($post){
                $user['name'] = 'Đang cập nhật';
                if ($post->user_created_table == 1){
                    $user = User::findOrFail($post->user_created_id);
                }

                if ($post->user_created_table == 0){
                    $user = Employer::findOrFail($post->user_created_id);
                }
                return $user['name'];
            })

            ->editColumn('status',function($post){
                $string = '';
                if($post->status == 0)
                    $string .= '<span class="badge badge-warning">Vẫn còn vị trí</span>';
                if ($post->status == 1)
                    $string .= '<span class="badge badge-success">Đã hết</span>';
                return $string;
            })
            ->editColumn('is_active', function ($post)  {
                $string ='';
                if($post->is_active == 1)
                    $string .='<label class="switcher-control switcher-control-success switcher-control-lg"><input type="checkbox" class="switcher-input" checked="" data-id="'.$post->id.'"> <span class="switcher-indicator"></span> <span class="switcher-label-on"><i class="fas fa-check"></i></span> <span class="switcher-label-off"><i class="fas fa-times"></i></span></label>';
                else
                    $string .='<label class="switcher-control switcher-control-success switcher-control-lg"><input type="checkbox" class="switcher-input" data-id="'.$post->id.'"> <span class="switcher-indicator"></span> <span class="switcher-label-on"><i class="fas fa-check"></i></span> <span class="switcher-label-off"><i class="fas fa-times"></i></span></label>';

                return $string;
            })
            ->addColumn('action', function ($post) {
                $string = '';
                $string .= '<a data-id="' . $post->id . '"  class="btn btn-sm btn-icon btn-secondary btn-edit"  title="chỉnh sửa"><i class="fa fa-pencil-alt"></i></a>';
                $string .= '<a href="" data-id="' . $post->id . '" class="btn btn-sm btn-icon btn-secondary btn-delete" title="xóa"> <i class="far fa-trash-alt"></i></a>';
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
        //
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
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
