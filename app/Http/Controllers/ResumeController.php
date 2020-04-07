<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resume;
use App\Tag;
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
        $tags = $request->input();
        array_shift($tags);
        array_shift($tags);

        // $newResume = new Resume;
        // $newResume->resume = $resume;
        // $newResume->resume_content = $resume_content;
        // $newResume->save();
        // $newResume->tags()->attach($tags);
        // $newResume->save();

        $newResume = Resume::create(['resume' => $resume, 'resume_content' => $resume_content]);
        $newResume->tags()->attach($tags);
        $newResume->save();
        
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
        $tags = $request->input();
        array_shift($tags);
        array_shift($tags);
        array_shift($tags);

        $oldResume = Resume::find($id);
        $oldResume->resume = $resume;
        $oldResume->resume_content = $resume_content;
        $oldResume->tags()->sync($tags);
        $oldResume->save();

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
        $oldResume = Resume::find($id);
        $oldResume->tags()->detach();
        $oldResume->delete();
        
        return Redirect::to('resumes')->with('success', 'Resume deleted successfully');
    }
}
