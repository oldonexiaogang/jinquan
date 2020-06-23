<?php

namespace App\Http\Controllers\Api;

use App\Models\ImgVideo;
use App\Models\User;
use App\Models\Collection;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Handlers\ImageUploadHandler;
use App\Http\Resources\ImgVideoResource;
use App\Http\Requests\Api\ImgVideoRequest;
use SebastianBergmann\CodeCoverage\TestFixture\C;

class ImgVideosController extends Controller
{
    public function store(ImgVideoRequest $request, ImageUploadHandler $uploader, ImgVideo $image)
    {
        $user = $request->user();
        if($request->type=='video'){
            $size = '';
        }else{
            $size = 1024;
        }
        $result = $uploader->save($request->url, Str::plural($request->type), $user->id, '');

        $image->url = $result['url'];
        $image->type = $request->type;
        $image->user_id = $user->id;
        $image->is_show = $request->is_show;
        $image->save();

        return new ImgVideoResource($image);
    }

    public function update(ImgVideoRequest $request, ImgVideo $imgVideo)
    {
        $this->authorize('update', $imgVideo);

        $imgVideo->update($request->all());
        return new ImgVideoResource($imgVideo);
    }

    public function destroy(ImgVideo $imgVideo){

        $imgVideo->delete();

        return response(null, 204);
    }

    //女神自己所有视频
    public function index(ImgVideoRequest $request){

        $imgVideo = ImgVideo::query()->where('user_id',$request->user()->id)->get();
        return new ImgVideoResource($imgVideo);
    }

    //指定女神所有视频
    public function msindex(User $user){
        $imgVideo = ImgVideo::query()->where('user_id',$user->id)->get();
        return new ImgVideoResource($imgVideo);
    }

    //收藏
    public function collection(ImgVideoRequest $request){
        $user = $request->user();
        $collection = new Collection();
        $collection->user_id = $user->id;
        $collection->img_video_id = $request->img_video_id;
        $collection->save();
        return new ImgVideoResource($collection);
    }

    //取消收藏
    public function uncollection(Collection $collection){
        //$this->authorize('destroy', $collection);

        $collection->delete();

        return response(null, 204);
    }


}
