<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterventionRequest extends FormRequest
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
            'mcu' => 'required|min:2|numeric',
            'pan' => 'required|min:5',
            'et' => 'required',
            'rep' => "nullable|required_if:et,=,en cours de réparation|min:3",
            'memo' => 'nullable|required_if:et,=,en cours de réparation|min:5',
            'dtdec' => 'required|date',
            'tmdec' => 'required',
            'dtIntr' => 'date|after_or_equal:dtDec|required_if:et,=,en cours de réparation|nullable',
            'tmIntr' => 'required_if:et,=,en cours de réparation|nullable',
            'dtfin' => 'date|after_or_equal:dtIntr|required_if:et,=,réparé|nullable',
            'tmfin' => 'required_if:et,=,réparé|nullable'
        ];
    }
}
