<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CasiersRequest extends FormRequest
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
                'capacite' => [
                    'bail',
                    'required',
                    'numeric',
                    'min:0',
                    Rule::unique('casiers')->ignore($this->id)],
                'intitule' => [
                    'bail',
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('casiers')->ignore($this->id)],
                'prix_achat' => 'bail|required|numeric|min:0',
                'fournisseur_id' => 'bail|required',
                'bouteille_id' => 'bail|required'
            ];
        }
        else
        {
            return [
                'capacite' => 'bail|required|numeric|unique:casiers|min:0',
                'prix_achat' => 'bail|required|numeric|min:0',
                'intitule' => 'bail|required|string|unique:casiers|max:255',
                'fournisseur_id' => 'bail|required',
                'bouteille_id' => 'bail|required'
            ];
        }
    }
}
