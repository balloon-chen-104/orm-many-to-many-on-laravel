<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resume;
use App\Tag;
use Redirect;
use Illuminate\Support\Facades\Redis;

class ResumesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 使用 redis
        if(Redis::exists("resumes")){
            $redis_message =  '快取存在，直接載入資料';
            $resumes = json_decode(Redis::get("resumes"));
        }
        else {
            $redis_message = "快取過期，連回資料庫加載";
            $resumes = Resume::orderBy('created_at', 'desc')->get();
            foreach($resumes as $resume){
                $resume->tags;
                $resume->user;
            }
            Redis::set("resumes", json_encode($resumes));
            Redis::expire("resumes", 600);
        }
        return view('resumes.index', ['resumes' => $resumes, 'redis_message' => $redis_message]);
        // 使用 redis 結束
        
        $resumes = Resume::orderBy('created_at', 'desc')->paginate(5);
        return view('resumes.index', ['resumes' => $resumes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('resumes.create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 使用 redis 讓 redis 過期
        Redis::del("resumes");
        // 使用 redis 結束

        $this->validate($request,
            [
                'resume' => 'required',
                'resume_content' => 'required'
            ],
            [
                'resume.required' => '標題欄不可為空',
                'resume_content.required' => '內文欄不可為空'
            ]
        );
        
        $resume = $request->input('resume');
        $resume_content = $request->input('resume_content');
        $user_id = auth()->user()->id;
        $tags = $request->input();
        array_shift($tags);
        array_shift($tags);
        array_shift($tags);

        // $newResume = new Resume;
        // $newResume->resume = $resume;
        // $newResume->resume_content = $resume_content;
        // $newResume->save();
        // $newResume->tags()->attach($tags);
        // $newResume->save();

        $newResume = Resume::create(['resume' => $resume, 'resume_content' => $resume_content, 'user_id' => $user_id]);
        $newResume->tags()->attach($tags);
        $newResume->save();
        
        return Redirect::to('resumes')->with('success', '履歷建立成功！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // 使用 redis
        if(Redis::exists("resume/$id")){
            $redis_message =  '快取存在，直接載入資料';
            $resume = json_decode(Redis::get("resume/$id"));
        }
        else {
            $redis_message = "快取過期，連回資料庫加載";
            $resume = Resume::find($id);
            $resume->tags;
            $resume->user;
            Redis::set("resume/$id", json_encode($resume));
            Redis::expire("resume/$id", 600);
        }
        return view('resumes.show', ['resume' => $resume, 'redis_message' => $redis_message]);
        // 使用 redis 結束

        $resume = Resume::find($id);
        return view('resumes.show', ['resume' => $resume]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resume = Resume::find($id);

        // Check for correct user
        if(auth()->user()->id !== $resume->user_id && auth()->user()->id != 1){
            return redirect('/resumes')->with('error', '權限不足');
        }

        $tags = Tag::all();
        return view('resumes.edit' ,['id' => $id, 'resume' => $resume, 'tags' => $tags]);
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
        Redis::del("resume/$id");
        Redis::del("resumes");
        // 使用 redis 結束

        $this->validate($request,
            [
                'resume' => 'required',
                'resume_content' => 'required'
            ],
            [
                'resume.required' => '標題欄不可為空',
                'resume_content.required' => '內文欄不可為空'
            ]
        );
        
        $resume = $request->input('resume');
        $resume_content = $request->input('resume_content');
        $tags = $request->input();
        array_shift($tags);
        array_shift($tags);
        array_shift($tags);
        array_pop($tags);

        $oldResume = Resume::find($id);
        $oldResume->resume = $resume;
        $oldResume->resume_content = $resume_content;
        $oldResume->tags()->sync($tags);
        $oldResume->save();

        return Redirect::to("resumes/$id")->with('success', '履歷更新成功！');
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
        Redis::del("resume/$id");
        Redis::del("resumes");
        // 使用 redis 結束

        $oldResume = Resume::find($id);

        // Check for correct user
        if(auth()->user()->id !== $oldResume->user_id && auth()->user()->id != 1){
            return redirect('/resumes')->with('error', '權限不足');
        }

        $oldResume->tags()->detach();
        $oldResume->delete();
        
        return Redirect::to('resumes')->with('success', '履歷刪除成功！');
    }
}
