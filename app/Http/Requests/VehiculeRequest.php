<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VehiculeRequest extends FormRequest
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
            'mcu' => ['required','min:2','numeric',Rule::unique('vehicules','mcu')->ignore($this->vehicule)],
            'mtr' => ['required','min:5',Rule::unique('vehicules','matricule')->ignore($this->vehicule)],
            'mrq' => 'min:3|alpha|nullable',
            'mdl' => 'alpha|min:3|nullable',
            'type' => 'nullable|min:3|alpha',
            'clr' => 'nullable|min:3|alpha_dash',
            'statut' => 'nullable|min:5',
            'numo' => ['required','min:3'],
            'nomc' => 'required|min:3',
            'instl' => 'nullable|min:3',
            'dtInst' => 'required|date',
            'tmInst' => 'required',
        ];
    }
}
