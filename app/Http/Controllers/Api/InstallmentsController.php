<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\InstallmentRequest;
use App\Http\Resources\InstallmentResource;
use App\Models\Installment;
use App\Models\MrOrder;
use Illuminate\Http\Request;

class InstallmentsController extends Controller
{
    //
    public function store(InstallmentRequest $request, Installment $installment)
    {
        //检测是否付款已到最大值
        $res = MrOrder::query()->where('id',$request->order_id)->first();
        if($res && $res->total_amount == $res->amount){
            return response()->json([
                'code' => 101,
                'msg' => '付款已全部结束',
            ], 403);
        }
        $installment->fill($request->all());
        $installment->ms_user_id = $request->user()->id;
        $installment->save();

        return new InstallmentResource($installment);
    }

    public function update(InstallmentRequest $request, Installment $installment)
    {
        $this->authorize('update', $installment);

        $installment->update($request->all());
        return new InstallmentResource($installment);
    }

    public function destroy(Installment $installment){

        $this->authorize('update', $installment);
        $installment->delete();

        return response(null, 204);
    }
}
