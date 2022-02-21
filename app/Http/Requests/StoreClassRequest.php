<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClassRequest extends FormRequest
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
            'ten_lop' => [
                'required', 'max:100',
                Rule::unique('lop')->ignore($this->classes),
            ],
            'code' => 'required|max:20', 
            'specialized_id' => 'required', 
        ];
    }

    public function messages()
    {
        return [
            'ten_lop.required' => 'Tên lớp là trường bắt buộc.', 
            'ten_lop.max' => 'Tên lớp không được dài quá :max ký tự.', 
            'ten_lop.unique' => 'Lớp đã tồn tại.', 
            'specialized_id.required' => 'Chuyên ngành là trường bắt buộc.', 
            'code.required' => 'Mã lớp là trường bắt buộc.', 
            'code.max' => 'Mã lớp không được dài quá :max ký tự.', 
        ];
    }
}
