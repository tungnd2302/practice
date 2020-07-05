<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionSuiteRequest extends FormRequest
{
    private $table            = 'questionSuite';
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
        $condName  = "bail|required|between:5,100|unique:$this->table,name";

        if(!empty($id)){ // edit
            $condName  .= ",$id";
        }
        return [
            'name'        => $condName,
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
            'name'          => 'Tên chức vụ',
        ];
    }
}
