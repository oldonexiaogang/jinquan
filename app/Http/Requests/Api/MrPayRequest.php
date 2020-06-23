<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MrPayRequest extends FormRequest
{
    public function rules()
    {
        switch($this->method()) {

            case 'PATCH':
                return [
                    'total_amount' => 'required',
                    'amount' => 'required',
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'total_amount' => '总金额',
            'amount' => '本次付款金额',
            //'user_id' => '女神',
        ];
    }
}
