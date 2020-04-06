<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resume;
use App\Tag;
use App\ResumeTag;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resumes = Resume::all();
        return view('index_resume', ['resumes' => $resumes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('create_resume', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 要刪除某資料時用 post 方法進來這裡再轉給 destory() 處理
        if ($request->input('delete')){
            $this->destroy($request->input('delete'));
        }
        else {
            $resume = $request->input('resume');
            $resume_content = $request->input('resume_content');
            $newResume = new Resume();
            $newResume->resume = $resume;
            $newResume->resume_content = $resume_content;
            $newResume->save();
            
            $inputs = $request->input();
            foreach($inputs as $key => $value){
                if($key == "resume" || $key == "resume_content"){
                    continue;
                }
                $newResumeTag = new ResumeTag();
                $newResumeTag->resume_id = $newResume->id;
                $newResumeTag->tag_id = $value;
                $newResumeTag->save();
            }
    
            $resumes = Resume::all();
            return view('index_resume', ['resumes' => $resumes]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // edit 的表單用 get 方法進來這裡再轉給 update() 處理
        if($request->all()){
            $this->update($request, $id);
        }
        else {
            $resume = Resume::find($id);
            return view('show_resume', ['resume' => $resume]);
        }
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
        $tags = Tag::all();
        return view('edit_resume' ,['id' => $id, 'resume' => $resume, 'tags' => $tags]);
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
        $resume = $request->input('resume');
        $resume_content = $request->input('resume_content');
        $oldResume = Resume::find($id);
        $oldResume->resume = $resume;
        $oldResume->resume_content = $resume_content;
        $oldResume->save();

        $newResumeTag = ResumeTag::where("resume_id", $id);
        $newResumeTag->delete();

        $inputs = $request->input();
        foreach($inputs as $key => $value){
            if($key == "resume" || $key == "resume_content"){
                continue;
            }
            $newResumeTag = new ResumeTag();
            $newResumeTag->resume_id = $id;
            $newResumeTag->tag_id = $value;
            $newResumeTag->save();
        }

        // update 多繞一步，無法直接 return view 或者 Resume::find($id)
        echo "<a href='/resumes/$id'>go back</a>";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newResume = Resume::find($id);
        $newResume->delete();

        $newResumeTag = ResumeTag::where("resume_id", $id);
        $newResumeTag->delete();
        
        // destory 多繞一步，無法直接 return view 或者 Resume::all()
        echo "<a href='/resumes'>go back to resumes</a>";
    }
}
