<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTask extends FormRequest
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
            'client_name' => 'required|max:255',
            'client_phone' => 'required|max:16',
            'client_org' => 'nullable|max:255',
            'car_name' => 'nullable|max:255',
            'car_number' => 'required|max:9',
            'description' => 'required|max:255',
            'create_by' => 'exists:users,id'
        ];
    }
}
