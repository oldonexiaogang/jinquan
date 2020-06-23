<?php

namespace App\Http\Controllers\Api;

use App\Models\Avatar;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Handlers\ImageUploadHandler;
use App\Http\Resources\AvatarResource;
use App\Http\Requests\Api\AvatarRequest;

class AvatarsController extends Controller
{
    public function store(AvatarRequest $request, ImageUploadHandler $uploader, Avatar $avatar)
    {
        $user = $request->user();

        $size = $request->type == 'avatar' ? 416 : 1024;
        $result = $uploader->save($request->avatar,'avatar',$user->id, $size);

        $avatar->url = $result['url'];

        $avatar->user_id = $user->id;
        $avatar->save();

        return new AvatarResource($avatar);
    }
}
