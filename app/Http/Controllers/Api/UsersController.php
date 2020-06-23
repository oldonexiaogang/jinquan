<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\MsPublish;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Requests\Api\UserRequest;
use Illuminate\Auth\AuthenticationException;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $verifyData = \Cache::get($request->verification_key);

        if (!$verifyData) {
            abort(403, '验证码已失效');
        }

        if (!hash_equals($verifyData['code'], $request->verification_code)) {
            // 返回401
            throw new AuthenticationException('验证码错误');
        }
        $user = User::create([
            'username' => $request->username,
            'tel' => $verifyData['tel'],
            'password' => bcrypt($request->password),
        ]);
        //创建关联接单信息数据
        $ms_publish = MsPublish::create([
            'user_id' => $user->id,
            'is_show'=>0
        ]);

        // 清除验证码缓存
        \Cache::forget($request->verification_key);

        return new UserResource($user);
    }

    public function show(User $user, Request $request)
    {
        return new UserResource($user);
    }

    public function me(Request $request)
    {
        return (new UserResource($request->user()))->showSensitiveFields();
    }

    public function update(UserRequest $request)
    {
        $user = $request->user();

        $attributes = $request->only(['name',  'info']);
        //dd($request->name);

        $user->update($attributes);

        return (new UserResource($user))->showSensitiveFields();
    }
}
