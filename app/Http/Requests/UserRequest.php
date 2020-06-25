<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    private $table            = 'users';
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
        $id = $this->id;
        $condUsername  = "bail|required|between:5,100|unique:$this->table,username";

        if(!empty($id)){ // edit
            $condUsername  .= ",$id";
        }
        // die;
        return [
            'username'        => $condUsername,
            'fullname'        => 'required'
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
            'username'          => 'Username',
        ];
    }
}
