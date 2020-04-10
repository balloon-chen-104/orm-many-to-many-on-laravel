<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Resume;
use Redirect;
use Illuminate\Support\Facades\Redis;

class TagsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Check for correct user
        if(auth()->user()->id !== 1){
            return redirect('/resumes')->with('error', '權限不足');
        }
        
        $tags = Tag::orderBy('created_at', 'desc')->paginate(10);
        return view('tags.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Check for correct user
        if(auth()->user()->id !== 1){
            return redirect('/resumes')->with('error', '權限不足');
        }

        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'tag' => 'required'
            ],
            [
                'tag.required' => '標籤名稱不可為空'
            ]
        );

        $tag = $request->input('tag');
        $newTag = Tag::create(['tag' => $tag]);
        return Redirect::to('tags')->with('success', '標籤建立成功！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // Check for correct user
        if(auth()->user()->id !== 1){
            return redirect('/resumes')->with('error', '權限不足');
        }

        $tag = Tag::find($id);
        $resumes = Resume::all();
        return view('tags.show', ['tag' => $tag, 'resumes' => $resumes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Check for correct user
        if(auth()->user()->id !== 1){
            return redirect('/resumes')->with('error', '權限不足');
        }
        
        $tag = Tag::find($id);
        return view('tags.edit' ,['id' => $id, 'tag' => $tag]);
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
        // 使用 redis 讓 redis 過期
        Redis::flushall();
        // 使用 redis 結束

        $this->validate($request,
            [
                'tag' => 'required'
            ],
            [
                'tag.required' => '標籤名稱不可為空'
            ]
        );
        
        $tag = $request->input('tag');
        $oldTag = Tag::find($id);
        $oldTag->tag = $tag;
        $oldTag->save();
        // $oldTag = Tag::create(['tag' => $tag]);

        return Redirect::to("tags")->with('success', '標籤更新成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 使用 redis 讓 redis 過期
        Redis::flushall();
        // 使用 redis 結束

        $oldTag = Tag::find($id);
        $oldTag->resumes()->detach();
        $oldTag->delete();
        
        return Redirect::to('tags')->with('success', '標籤刪除成功！');
    }
}
