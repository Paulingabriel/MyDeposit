<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FournisseursRequest extends FormRequest
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
                'nom' => 'bail|required|string|max:255',
                'email' => ['required',
                            'string',
                            'email:rfc,dns',
                            'max:255',
                            Rule::unique('fournisseurs')->ignore($this->id)],
                'adresse' => 'bail|required|string|max:255',
                'telephone1' => 'bail|required|numeric|min:0',
                'telephone2' => 'bail|required|numeric|min:0',
            ];
        }
        else
        {
            return [
                'nom' => 'bail|required|string|max:255',
                'email' => 'bail|required|string|email:rfc,dns|unique:fournisseurs|max:255',
                'adresse' => 'bail|required|string|max:255',
                'telephone1' => 'bail|required|numeric|min:0',
                'telephone2' => 'bail|required|numeric|min:0',
            ];
        }
    }
}
