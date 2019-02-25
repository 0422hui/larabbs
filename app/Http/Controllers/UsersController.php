<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
class UsersController extends Controller
{
    public function show(User $user)
    {
        return view('users.show',compact('user' ));
    }
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }
    public function update(UserRequest $request, User $user,ImageUploadHandler $uploader)
    {
        //dd($request->avatar);
        $data=$request->all();
        if($request->avatar){
            $result=$uploader->save($request->avatar,'avatars',$user->id);
            if($result){
                $data['avatar']=$result['path'];
            }
        }
        $user->update($request->all());
        return redirect()->route('users.show', compact('user'))->with('success', '个人资料更新成功！');
    }
}