<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
 use Illuminate\Contracts\Validation\Validator;
 use Illuminate\Http\Exceptions\HttpResponseException;

class PurchaseInfoRequest extends FormRequest
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
            'email' => [
                'required',            
                'email',
            ],
            'fullName' => 'required|string',
            'detailAddress' => 'required',
            'numberPhone' => [
                'required',
                'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/',
                'numeric',
                
            ],

        ];
    }

    public function messages(){
        return [
            'email.required' => 'Vui lòng nhập địa chỉ Email',
            'email.email' => 'Vui lòng nhập đúng định dạng địa chỉ Email',
            'fullName.required' => 'Vui lòng nhập tên',
            'fullName.string' => 'Vui lòng nhập đúng định dạng tên',
            'detailAddress.required' => 'Vui lòng nhập địa chỉ chi tiết',
            'numberPhone.required' => 'Vui lòng nhập số điện thoại',
            'numberPhone.regex' => "Vui lòng nhập số điện thoại theo vùng Việt Nam",
            'numberPhone.numeric' => "Vui lòng nhập số điện thoại theo vùng Việt Nam"
        ];
    }

}
