<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSpecializedRequest extends FormRequest
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
            'ten_nganh' => [
                'required', 'max:100',
                Rule::unique('nganh')->ignore($this->specialized),
            ],
            'code' => 'required|max:20', 
        ];
    }

    public function messages()
    {
        return [
            'ten_nganh.required' => 'Tên chuyên ngành là trường bắt buộc.', 
            'ten_nganh.max' => 'Tên chuyên ngành không được dài quá :max ký tự.', 
            'ten_nganh.unique' => 'Chuyên ngành đã tồn tại.', 
            'code.required' => 'Mã chuyên ngành là trường bắt buộc.', 
            'code.max' => 'Mã chuyên ngành không được dài quá :max ký tự.', 
        ];
    }
}
