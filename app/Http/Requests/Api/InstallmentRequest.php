<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class InstallmentRequest extends FormRequest
{

    public function rules()
    {
        switch($this->method()) {
            case 'POST':
                return [

                    'mr_order_id' => 'required|exists:mr_orders,id',
                    'mr_user_id' => 'required|exists:users,id',
                    'total_amount' => 'required|min:1',
                    'amount' => 'required|min:0',

                ];
                break;
            case 'PATCH':
                return [
                    'mr_order_id' => 'required|exists:mr_orders,id',
                    'mr_user_id' => 'required|exists:users,id',
                    'total_amount' => 'required|min:1',
                    'amount' => 'required|min:0',


                    //'user_id' => 'exists:users,id',
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'amount' => '邀请付款金额',

        ];
    }
}
