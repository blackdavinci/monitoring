<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request
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
            'nom' => 'required',
            'prenom'=>'required',
            'role'=>'required',
            'login'=>'required',
        ];
    }

    /**
     * Get the validation rules errors messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nom.required' => 'Nom obligatoire',
            'prenom.required'=>'Prénom obligatoire',
            'role'=>'Rôle obligatoire',
            'login.required'=>'Login obligatoire',
        ];
    }
}
