<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|string|min:11',
            'address' => 'min:10|string',
            'charge' =>'required'    
        ];
    }
    public function messages(): array
    {
        return [
            'phone.required' =>'The phone number is mendetory',
            'phone.string' => 'The phone number must be Text',
            'phone.min:11' => 'The phone number will be must 11 character',
            'address.min:10' =>'Address will be minimum 10 character',
            'address.string' => 'Address will be text',
            'charge' => 'Area Added mendetory'
        ];
    }
}
