<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'name'            => 'required|unique:role|min:5|max:100',
        ];
    }

    public function messages()
    {
        return [
            'unique'    => ':attribute đã tồn tại',
            'max'       => ':attribute không được lớn hơn :max',
            'min'       => ':attribute không được nhỏ hơn :max',
            'required'  => ':attribute không được để trống',
        ];
    }

    public function attributes()
    {
        return [
            'name'          => 'Tên chức vu',
        ];
    }
}
