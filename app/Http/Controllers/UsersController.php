<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Redirect;

class UsersController extends Controller
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // Check for correct user
        if(auth()->user()->id != $id && auth()->user()->id != 1){
            return redirect('/resumes')->with('error', '權限不足');
        }

        $user = User::find($id);
        $users = User::all();
        return view('user.show', ['user' => $user, 'users' => $users]);
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
        if(auth()->user()->id != $id && auth()->user()->id != 1){
            return redirect('/resumes')->with('error', '權限不足');
        }
        
        $user = User::find($id);
        return view('user.edit' ,['user' => $user]);
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
                'birthday' => 'required',
                'phoneNumber' => 'required'
            ],
            [
                'birthday.required' => '生日不可為空',
                'phoneNumber.required' => '電話不可為空'
            ]
        );

        $birthday = $request->input('birthday');
        $phoneNumber = $request->input('phoneNumber');
        $oldUser = User::find($id);
        if($birthday)
            $oldUser->birthday = $birthday;
        if($phoneNumber)
            $oldUser->phoneNumber = $phoneNumber;
        $oldUser->save();

        $id = (auth()->user()->id == 1) ? 1 : $id;
        return Redirect::to("user/$id")->with('success', '資料更新成功！');
    }
}
