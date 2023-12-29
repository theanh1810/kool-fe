<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use Propaganistas\LaravelPhone\PhoneServiceProvider;
class OrdercheckRequest extends FormRequest
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
            'numberPhoneCheck' => [
                'required',
                'regex:/(84|0[3|5|7|8|9])+([0-9]{8})\b/',
                'numeric',
            ],
            'OrderCodeCheck' => [
                'required',
                'numeric'
            ],

        ];
    }

    public function messages(){
        return [
            'numberPhoneCheck.required' => 'Vui lòng nhập số điện thoại',
            'numberPhoneCheck.regex' => "Vui lòng nhập số điện thoại theo vùng Việt Nam",
            'numberPhoneCheck.numeric' => "Vui lòng chỉ nhập số",
            'OrderCodeCheck.required' => 'Vui lòng nhập mã đơn hàng',
            'OrderCodeCheck.numeric' => 'Vui lòng chỉ nhập số',
        ];
    }
}
