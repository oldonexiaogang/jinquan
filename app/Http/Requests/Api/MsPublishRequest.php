<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MsPublishRequest extends FormRequest
{

    public function rules()
    {


        switch($this->method()) {
            case 'POST':
                return [
                    'price' => 'required|min:99',
                    //'user_id' => 'required|exists:users,id',
                    'is_show' => 'required|boolean',
                ];
                break;
            case 'PATCH':
                return [
                    'price' => 'required',
                    'is_show' => 'required|boolean',
                    //'user_id' => 'exists:users,id',
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'price' => '价格',
            'is_show' => '是否展示',
            //'user_id' => '女神',
        ];
    }
}
