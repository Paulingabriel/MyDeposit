<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoissonsRequest extends FormRequest
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
                // 'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,jfif,gif,webp', 'max:5000'],
                'prix' => 'bail|required|numeric|min:0',
                'categories_boisson_id' => 'bail|required',
                'fournisseur_id' => 'bail|required',
                'bouteille_id' => 'bail|required'
            ];
        }
        else
        {
            return [
                'nom' => 'bail|required|string|max:255',
                'image' => ['nullable', 'image', 'mimes:jpeg,jfif,jpg,png,gif,webp', 'max:5000'],
                'prix' => 'bail|required|numeric|min:0',
                'categories_boisson_id' => 'bail|required',
                'fournisseur_id' => 'bail|required',
                'bouteille_id' => 'bail|required'
            ];
        }
    }
}
