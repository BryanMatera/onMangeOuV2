<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validateRequest extends FormRequest
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
          // 'commune' => 'required|digits:5'
        ];
    }

    public function messages()
{
    return [
        // 'commune.required' => 'Veuillez remplir le champ.',
        // 'commune.digits' => 'Veuillez entrer un code postal valide.'

    ];
}
}
