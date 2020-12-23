<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PronosticRequest extends FormRequest
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
            'date' => 'required|date',
            'description' => 'required',
            'short_description' => 'required',
            'logo_1' => 'required|image',
            'logo_2' => 'image|nullable',
            'free_access' => 'boolean|nullable',
            'state' => 'nullable'
        ];
    }
}
