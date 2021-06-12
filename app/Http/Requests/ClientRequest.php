<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
                'nom' => ['required','min:3',Rule::unique('clients','nom')->ignore($this->client)],
                'email' => ['required','min:10','email',Rule::unique('clients','email')->ignore($this->client)],
                'tel' => ['required','min:11','max:16','regex:/[0-9 ]+/',Rule::unique('clients','tel')->ignore($this->client)],
                'adr' => ['required','min:10',Rule::unique('clients','adresse')->ignore($this->client)],
                'typeC' =>['required_if:typ,=,null','nullable','exists:App\Models\Client_type,niveau_client'],
                'typ' => ['required_if:typeC,=,null','nullable',Rule::unique('client_types','niveau_client')->ignore($this->client)]
            ];  
    }
}
