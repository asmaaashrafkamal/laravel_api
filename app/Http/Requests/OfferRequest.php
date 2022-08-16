<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name' => 'required|max:100',
            'email' => 'required|max:100',
            'password' => 'required|numeric',
            // 'details_ar' => 'required',
            // 'details_en' => 'required',
            // 'photo' => 'required|mimes:png,jpg,jpeg',
        ];
    }


    public function messages()
    {

        return [
            'name.required' => __('messages.offer name required'),
            'email.required' => __('messages.email required'),

            // 'name_en.required' => __('messages.offer name required'),
            'name.unique' => 'اسم العرض موجود ',
            'email.unique' => 'الايميل موجود',

            // 'name_en.unique' => 'Offer name  is exists ',
            // 'price.numeric' => 'سعر العرض يجب ان يكون ارقام',
            // 'price.required' => 'السعر مطلوب',
            // 'details_ar.required' => 'ألتفاصيل مطلوبة ',
            // 'details_en.required' => 'ألتفاصيل مطلوبة ',
            // 'photo.required' =>  'صوره العرض مطلوب',
            // 'photo.mimes' =>  'صوره غير صالحة',

        ];
    }

}
