<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class cardRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // dd(true);
        return [
            'title' => 'required',
            'description' => 'required',
            'image'=> 'required',
            'action_btn' => 'required',
            'action_link' => 'required'
        ];
    }
}
