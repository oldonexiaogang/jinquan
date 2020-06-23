<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MrOrderRequest;
use App\Http\Resources\MrOrderResource;
use App\Models\MrOrder;
use App\Models\JinquanLog;
use App\Models\User;
use Illuminate\Http\Request;

class MrOrdersController extends Controller
{
    //
    public function store(MrOrderRequest $request, MrOrder $mrOrder)
    {
        //金主金权余额减少，冻结金额增加
        $user = User::find($request->user->id);
        $new_total_jinquan = $user->total_jinquan-$mrOrder->total_amount;
        if($new_total_jinquan<0){
            return response()->json([
                'code' => 101,
                'msg' => '余额不足',
            ], 403);
        }
        $user->total_jinquan = $new_total_jinquan;
        $user->frozen_jinquan = $user->frozen_jinquan+$mrOrder->total_amount;
        $user->save();

        //平台冻结资金记录

        $jinquanlog = new JinquanLog();
        $jinquanlog->user_id = $mrOrder->mr_user_id;
        $jinquanlog->amount = $mrOrder->total_amount;
        $jinquanlog->type = 'frozen';

        $jinquanlog->save();

        //创建订单
        $mrOrder->fill($request->all());
        $mrOrder->mr_user_id = $request->user()->id;
        $mrOrder->save();


        return new MrOrderResource($mrOrder);
    }

    public function update(MrOrderRequest $request, MrOrder $mrOrder){

        $this->authorize('update', $mrOrder);

        //修改订单，冻结金额改变
        //金主金权余额减少，冻结金额增加
        $change_jinquan = $request->total_amount-$mrOrder->total_amount;
        $user = User::find($request->user->id);
        $new_total_jinquan = $user->total_jinquan-$change_jinquan;
        if($new_total_jinquan<0){
            return response()->json([
                'code' => 101,
                'msg' => '余额不足',
            ], 403);
        }
        $user->total_jinquan = $new_total_jinquan;
        $user->frozen_jinquan = $user->frozen_jinquan+$change_jinquan;
        $user->save();

        //平台冻结资金

        $jinquanlog = new JinquanLog();
        $jinquanlog->user_id = $mrOrder->mr_user_id;
        $jinquanlog->amount = $change_jinquan;
        $jinquanlog->type = 'frozen';

        $jinquanlog->save();

        $mrOrder->update($request->all());


        return new MrOrderResource($mrOrder);
    }

    public function show(MrOrder $mrOrder){
        //$this->authorize('show', $mrOrder);
        return new MrOrderResource($mrOrder);
    }

    //金主完成订单
    public function complete(MrOrderRequest $request, MrOrder $mrOrder){

        $this->authorize('update', $mrOrder);
        //检测订单已支付与总金额是否相等
        if($mrOrder->total_amount !=$mrOrder->amount){
            return response()->json([
                'code' => 101,
                'msg' => '支付未完成',
            ], 403);
        }

        $mrOrder->status = 'complete';
        $mrOrder->save();
        return new MrOrderResource($mrOrder);

    }

    //金主评价订单

    public function review(MrOrderRequest $request, MrOrder $mrOrder){
        $this->authorize('review', $mrOrder);
        //检测订单已支付与总金额是否相等
        if($mrOrder->total_amount !=$mrOrder->amount){
            return response()->json([
                'code' => 101,
                'msg' => '支付未完成',
            ], 403);
        }
        if($mrOrder->status !='complete'){
            return response()->json([
                'code' => 101,
                'msg' => '订单未确认完成',
            ], 403);
        }

        $mrOrder->review = $request->review;
        $mrOrder->rating = $request->rating;
        $mrOrder->save();
        return new MrOrderResource($mrOrder);
    }


}

