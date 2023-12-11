<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
                'name' => 'required',
                'store_id' => 'required',
                'password' => 'required',
                'phone' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'name'=>'أسم التنصيف مطلوب',
            'email'=>'أسم التنصيف يجب أن يكون حروف ليس أرقام',
            'store_id'=>'أسم التنصيف يجب أن يكون 3 حروف أو أكثر',
            'password'=>'أسم التنصيف يجب أن لا يتخطى 255 حرف',
            'phone'=>'أسم التنصيف موجود من قبل',
        ];
    }


}