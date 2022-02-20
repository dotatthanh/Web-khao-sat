<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
            'name' => 'required|max:10', 
            'content' => 'required|max:255', 
            'type' => 'required', 
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Cách chọn đáp án là trường bắt buộc.', 
            'name.required' => 'Tên câu hỏi là trường bắt buộc.', 
            'name.max' => 'Tên câu hỏi không được dài quá :max ký tự.', 
            'content.required' => 'Nội dung là trường bắt buộc.', 
            'content.max' => 'Nội dung không được dài quá :max ký tự.', 
        ];
    }
}
