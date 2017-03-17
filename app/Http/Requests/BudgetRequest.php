<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BudgetRequest extends Request
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
            'start-date' => 'required|date|before:end-date',
            'end-date' => 'required|date|after:start-date',
            'cash' => 'required|numeric'
        ];
    }
}
