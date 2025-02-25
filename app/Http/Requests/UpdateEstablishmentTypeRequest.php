<?php

namespace App\Http\Requests;

use App\Models\EstablishmentType;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEstablishmentTypeRequest extends FormRequest
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
        $rules = EstablishmentType::$rules;
        
        return $rules;
    }
}
