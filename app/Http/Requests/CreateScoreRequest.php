<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateScoreRequest extends Request
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
            'designation'=>'required',
            'score_start.*'=>'required',
            'score_end.*'=>'required',
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
            'designation.required' => 'Désignation obligatoire',
            'score_start.*.required'=>'Point début obligatoire',
            'score_end.*.required'=>'Point fin obligatoire',
        ];
    }
}
