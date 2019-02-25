<?php
namespace App\Handlers;
class ImageUploadHandler
{   //只有以下后缀名的图片文件才能上传
    protected $allowed_ext=['png','jpg','gif','jpeg'];

    public function save($file,$folder,$file_prefix)
    {   //构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        $folder_name="uploade/images/$folder/".date('Ym/d',time());

        $upload_path=public_path().'/'.$folder_name;

        $extension=strtolower($file->getClientOriginalExtension())?:png;

        $filename=$file_prefix.'_'.time().'_'.str_random(10);
        // 如果上传的不是图片将终止操作
        if(!in_array($extension,$this->allowed_ext)){
            return;
        }
        else{
            // 将图片移动到我们的目标存储路径中
            $file->move($upload_path,$filename);
            return[
                'path'=>config('app.url')."/$folder_name/$filename"
            ];
        }

    }
}
