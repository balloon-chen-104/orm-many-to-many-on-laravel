<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resume;
use App\Tag;
use App\ResumeTag;
use Redirect;

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
        return view('resume.index', ['resumes' => $resumes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('resume.create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        return Redirect::to('resumes')->with('success', 'Resume stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $resume = Resume::find($id);
        return view('resume.show', ['resume' => $resume]);
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
        return view('resume.edit' ,['id' => $id, 'resume' => $resume, 'tags' => $tags]);
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
            if($key =="_method" || $key == "resume" || $key == "resume_content"){
                continue;
            }
            $newResumeTag = new ResumeTag();
            $newResumeTag->resume_id = $id;
            $newResumeTag->tag_id = $value;
            $newResumeTag->save();
        }

        return Redirect::to("resumes/$id")->with('success', 'Resume updated successfully');
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
        
        return Redirect::to('resumes')->with('success', 'Resume deleted successfully');
    }
}
