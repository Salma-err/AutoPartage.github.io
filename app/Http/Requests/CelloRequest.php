<?php

namespace App\Http\Requests;

use App\Models\Cello;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CelloRequest extends FormRequest
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
            'num' => ['required','numeric',Rule::unique('cellos','num')->ignore($this->cello)],
            'ver' => 'required|numeric',
            'typeCel' => 'required_if:tp,=,null|nullable|exists:App\Models\Cello_type,type_cello',
            'tp' => ['required_if:typeCel,=,null','nullable',Rule::unique('cello_types','type_cello')->ignore($this->cello_type)],
            'sim' => ['required_if:nmc,=,null','nullable','exists:App\Models\Carte,numero','regex:/[0-9 ]+/','min:11','max:16',Rule::unique('cartes','numero')->ignore($this->cello)],
            'nmc' => ['required_if:sim,=,null','nullable','regex:/[0-9 ]+/','min:11','max:16',Rule::unique('cartes','numero')->ignore($this->carte)],
            'cdc1' => ['required_with:nmc','nullable','regex:/[0-9 ]+/','size:20',Rule::unique('cartes','code1')->ignore($this->carte)],
            'cdc2' => ['required_with_all:nmc,cdc1','nullable','regex:/[0-9 ]+/','size:12',Rule::unique('cartes','code2')->ignore($this->carte)]
        ];
    }
}
