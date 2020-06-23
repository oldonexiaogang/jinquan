<?php

namespace App\Http\Requests\Api;



class AvatarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules['avatar'] = 'required|mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200';

        return $rules;
    }

    public function messages()
    {
        return [
            'avatar.dimensions' => '图片的清晰度不够，宽和高需要 200px 以上',
        ];
    }
}
