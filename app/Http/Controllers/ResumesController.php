<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resume;
use App\Tag;
use Redirect;

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
