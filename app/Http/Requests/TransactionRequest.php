<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
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
            'employee_name' => 'required',
            'vehicle_id' => [
                'required',
                Rule::exists('vehicles', 'id')->where('status', 'available')
            ],
            'id_spv' => 'required|exists:users,id',
            'id_man' => 'required|exists:users,id',
            'driver_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }
}
