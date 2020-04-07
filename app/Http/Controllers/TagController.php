<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Resume;
use App\ResumeTag;
use Redirect;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tag.index', ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = $request->input('tag');
        $newTag = new Tag();
        $newTag->tag = $tag;
        $newTag->save();
        return Redirect::to('tags')->with('success', 'Tag stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $tag = Tag::find($id);
        $resumes = Resume::all();
        return view('tag.show', ['tag' => $tag, 'resumes' => $resumes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('tag.edit' ,['id' => $id, 'tag' => $tag]);
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
        $tag = $request->input('tag');
        $oldTag = Tag::find($id);
        $oldTag->tag = $tag;
        $oldTag->save();

        return Redirect::to("tags")->with('success', 'Tag updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newTag = Tag::find($id);
        $newTag->delete();

        $newResumeTag = ResumeTag::where("tag_id", $id);
        $newResumeTag->delete();
        
        return Redirect::to('tags')->with('success', 'Tag deleted successfully');
    }
}
