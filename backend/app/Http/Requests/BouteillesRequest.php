<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BouteillesRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            return [
                'volume' => [
                            'bail',
                            'required',
                            'numeric',
                            'min:0',
                            Rule::unique('bouteilles')->ignore($this->id)],
                'prix' => 'bail|nullable|numeric|min:0'
            ];
        }
        else{
            return [
                'volume' => 'bail|required|numeric|unique:bouteilles|min:0',
                'prix' => 'bail|nullable|numeric|min:0'
            ];
        }
    }
}
