<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePerangkatRequest extends FormRequest
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
            // 'kode_perangkat' => 'required|string|unique:perangkats', 
            'name' => 'required|string',
            'temperature_min' => 'required|numeric', 
            'temperature_max' => 'required|numeric',
            'suhu' => 'required|string',
            'satuan_suhu' => 'required|string',
        ];
    }
}
