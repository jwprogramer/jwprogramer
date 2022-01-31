<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $rules = [
            'cont' => 'required|max:500',
            'address' => 'required|max:500',
            'model' => 'required|max:500',
            'manuf' => 'required|max:500',
            'rent_date' => 'required|date'
        ];

        #somente obrigatório quando for um novo
        if ($this->method() == "POST"){
            $rules['image'] = 'required|image|max:1024';
        } else
        if ($this->method() == "PUT"){
            $rules['image'] = 'image|max:1024';
        }

        return $rules;
    }

}
