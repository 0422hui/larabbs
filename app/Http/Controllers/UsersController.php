<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['expect'=>[]]);
    }
    public function show(User $user)
    {
        return view('users.show',compact('user' ));
    }
    public function edit(User $user)
    {
        $this->authorize('update',$user);//调用授权方法 update 在policy中定义了，后面传递的参数是该方法中的第二个参数
        return view('users.edit',compact('user'));
    }
    public function update(UserRequest $request, User $user,ImageUploadHandler $uploader)
    {
        //dd($request->avatar);
        $this->authorize('update',$user);
        $data=$request->all();
        if($request->avatar){
            $result=$uploader->save($request->avatar,'avatars',$user->id,416);
            if($result){
                $data['avatar']=$result['path'];
            }
        }
        $user->update($data);
        return redirect()->route('users.show', compact('user'))->with('success', '个人资料更新成功！');
    }
}
