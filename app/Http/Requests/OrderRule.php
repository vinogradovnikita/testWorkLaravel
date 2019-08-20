<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRule extends FormRequest
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
        return $rules = [
            'client_email' => 'required|email',
            'partner_id' => 'required|exists:orders',
            'status' => 'required|in:' . implode(',', array_keys(config('general.order_status'))),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'client_email.required' 	=> 'Поле "Email клиента" обязательно для заполнения',
            'client_email.email' 	    => 'Поле "Email клиента" неверного типа',
            'partner_id.required' 	    => 'Поле "Партнер" обязательно для заполнения',
            'status.required' 	        => 'Поле "Статус заказа" обязательно для заполнения',
            'status.in' 	            => 'Поле "Статус заказа" имеет неверное содержание',
        ];
    }

}
