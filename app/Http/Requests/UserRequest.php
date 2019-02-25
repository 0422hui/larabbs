<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
            'email' => 'required|email',
            'introduction' => 'max:80',
            'avatar' =>'mimes:jpeg,bmp,png,jpg,gif|dimensions:min_width=208,min_height=208',
        ];
    }
    public function messages()
    {
         return[
             'avatar.mines'=>'请上传：jpeg,bmp,png,jpg,gif类型的文件',
             'avatar.dimensions'=>'请上传宽高超过208的图片',
            'name.required'=>'已经有人注册了这个用户名了哦，请换一个',
            'name.regex'=>'用户名只能支持英文、数字、横杠和下划线哦',
            'name.between'=>'用户名要介于 3 - 25 个字符之间。',
            'name.required'=>'请输入用户名，让别人认识你哦',
        ];
    }
}

// return[
//     'name.required'=>'已经有人注册了这个用户名了哦，请换一个',
//     'name.regex'=>'用户名只能支持英文、数字、横杠和下划线哦',
//     'name.between'=>'用户名要介于 3 - 25 个字符之间。',
//     'name.required'=>'请输入用户名，让别人认识你哦',
// ];
