<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateObjectifRequest extends Request
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
            'titre'=>'required',
            'description'=>'required',
            'designation'=>'required',
            'point'=>'required',
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
            'titre.required' => 'Titre obligatoire',
            'description.required'=>'Description obligatoire',
            'designation.required'=>'Désignation obligatoire',
            'point[].required'=>'Indicateur(s) obligatoire(s)',
        ];
    }
}
