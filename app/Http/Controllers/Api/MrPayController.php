<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ImgVideoRequest;
use App\Http\Resources\MrPayResource;
use App\Models\Installment;
use Illuminate\Http\Request;

class MrPayController extends Controller
{
    //
    public function pay(ImgVideoRequest $request, Installment $installment)
    {
        //$this->authorize('pay', $installment);
        //检测提交的总价及付款金额是否对应
        if($installment->total_amount==$request->total_amount && $installment->amount==$request->amount){
            $installment->is_pay = 1;
        }
        $installment->save();
        return new MrPayResource($installment);
    }
}
