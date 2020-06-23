<?php

namespace App\Http\Requests\Api;

class ImgVideoRequest extends FormRequest
{
    public function rules()
    {

        $rules = [];
        switch($this->path()) {
            case 'api/v1/store':
                $rules = [
                    'type' => 'required|string|in:img,video',
                    'is_show'=>'required|boolean',
                    'url'=>'required',
                ];
                if ($this->type == 'img') {
                    $rules['url'] = 'required|mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200';
                }
                break;
            case 'api/v1/update':
                //$userId = auth('api')->id();

                $rules = [
                    'type' => 'required|string|in:img,video',
                    'is_show'=>'required|boolean',
                    'url'=>'required',
                ];
                break;
            case 'api/v1/collection-ms-img-videos':
                $rules = [
                    'img_video_id'=>'required',
                ];
                break;
        }

        return $rules;

    }

    public function messages()
    {
        return [
            'url.dimensions' => '图片的清晰度不够，宽和高需要 200px 以上',
        ];
    }
}
