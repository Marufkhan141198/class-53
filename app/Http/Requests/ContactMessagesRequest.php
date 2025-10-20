<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactMessagesRequest extends FormRequest
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
            'name' =>'required',
            'phone' => 'required|min:11',
            'email' => 'required',
            'message' => 'required'
        ];
    }

    public function messages():array 
    {
        return[
            'name.required' =>'Name is mendetory',
            'phone.required' =>'The phone number is mendetory',
            'phone.required' =>'Phone number at least 11 digit',
            'email.required' =>'The email is mendetory',
            'message.required'=>'The message is mendetory'     
        ];
    }
}
