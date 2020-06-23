<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MrOrderRequest extends FormRequest
{

    public function rules()
    {

        switch($this->method()) {
            case 'POST':
                return [
                    'ms_user_id' => 'required|exists:users,id',
                    'ms_publish_id' => 'required|exists:ms_publishes,id',
                    'total_amount' => 'required',
                    'days' => 'required|integer',
                ];
                break;
            case 'PATCH':
                //确认完成订单
                if(strstr($this->path(),'api/v1/mr-orders/complete')){
                    return [
                        'status' => 'required',

                    ];
                }
                //评价订单
                if(strstr($this->path(),'api/v1/mr-orders/review')){
                    return [
                        'review' => 'required',
                        'rating' => 'required',

                    ];
                }
                return [
                    'total_amount' => 'required',
                    'days' => 'required|integer',
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'total_amount' => '总金额',
            'days' => '天数',
            //'user_id' => '女神',
        ];
    }
}
