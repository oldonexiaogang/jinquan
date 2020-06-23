<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MsTrafficInfoRequest;
use App\Http\Resources\MsTrafficInfoResource;
use App\Models\MsTrafficInfo;
use Illuminate\Http\Request;

class MsTrafficInfosController extends Controller
{
    //
    public function store(MsTrafficInfoRequest $request, MsTrafficInfo $msTrafficInfo)
    {
        //检测是否已提交过
       /* if($res = MsTrafficInfo::query()->where('order_id',$request->order_id)->first()){
            return response()->json([
                'code' => 101,
                'msg' => '已有发布，不可重复',
            ], 403);
        }*/
        $msTrafficInfo->fill($request->all());
        $msTrafficInfo->ms_user_id = $request->user()->id;
        $msTrafficInfo->save();

        return new MsTrafficInfoResource($msTrafficInfo);
    }

    public function update(MsTrafficInfoRequest $request, MsTrafficInfo $msTrafficInfo)
    {
        $this->authorize('update', $msTrafficInfo);

        $msTrafficInfo->update($request->all());
        return new MsTrafficInfoResource($msTrafficInfo);
    }
}
