<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    // CREATE ROLES
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title'=>'required|min:2',
                    'body'=>'required|min:3',
                    'category'=>'numeric',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }

    public function messages()
    {
        return [
            'title.min'=>'标题内容至少3个字',// Validation messages''
            'body.min'=>'文章内容至少三个字',
        ];
    }
}
