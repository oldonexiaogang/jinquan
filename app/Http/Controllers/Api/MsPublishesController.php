<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MsPublish;
use App\Http\Resources\MsPublishResource;
use App\Http\Requests\Api\MsPublishRequest;

class MsPublishesController extends Controller
{
    //
    public function store(MsPublishRequest $request, MsPublish $msPublish)
    {
        //检测是否已发布过
        if($res = MsPublish::query()->where('user_id',$request->user()->id)->first()){
            return response()->json([
                'code' => 101,
                'msg' => '已有发布，不可重复',
            ], 403);
        }
        $msPublish->fill($request->all());
        $msPublish->user_id = $request->user()->id;
        $msPublish->save();

        return new MsPublishResource($msPublish);
    }

    public function update(MsPublishRequest $request, MsPublish $msPublish)
    {
        $this->authorize('update', $msPublish);

        $msPublish->update($request->all());
        return new MsPublishResource($msPublish);
    }
}
