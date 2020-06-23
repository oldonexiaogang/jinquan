<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MsTrafficInfoRequest extends FormRequest
{

    public function rules()
    {

        switch($this->method()) {
            case 'POST':
                return [
                    'transportation' => 'required|in:airplane,high_speed_railway,taxi,other',
                    'ms_publish_id' => 'required|exists:ms_publishes,id',
                    //'order_id' => 'required|exists:orders,id',
                    'code' => 'required',
                    'money' => 'required',

                ];
                break;
            case 'PATCH':
                return [
                    'transportation' => 'required|in:airplane,high_speed_railway,taxi,other',
                    'code' => 'required',
                    'money' => 'required',
                    'ms_publish_id' => 'required|exists:ms_publishes,id',
                    //'order_id' => 'required|exists:orders,id',
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'transportation' => '交通工具',
            'money' => '金额、费用',
            'code' => '交通班次、号码',
            //'user_id' => '女神',
        ];
    }
}
