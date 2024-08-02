<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EditHerdForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            "info_given_name" => ['required'],
            "info_breed" => ['required'],
            "info_farm_name" => ['required'],
            "info_sex" => ['required'],
            "reg_num" => ['required', Rule::unique('livestock_reg', 'RFID_TAG')->ignore($this->input('reg_num'), 'RFID_TAG')],
            "birth_date" => ['required'],
            "birth_season" => ['required'],
            "birth_type" => ['required'],
            "milk_type" => ['required'],
            "jaw" => ['required'],
            "ear" => ['required'],
            "teat" => ['required'],
            "horn" => ['required'],
            "body" => ['required']
        ];

        if ($this->filled('info_dam_id')) {
            $rules["info_dam_id"] = ['required', Rule::exists('livestock_reg', 'RFID_TAG')];
        }
        if ($this->filled('info_sire_id')) {
            $rules["info_sire_id"] = ['required', Rule::exists('livestock_reg', 'RFID_TAG')];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'info_dam_id.exists' => 'The selected dam name does not exist in the livestock.',
            'info_sire_id.exists' => 'The selected sire name does not exist in the livestock.',
            // Add custom error messages for other rules if needed
        ];
    }

    public function attributes()
    {
        return [
            'info_given_name' => 'given name',
            'info_breed' => 'breed',
            'info_farm_name' => 'farm name',
            'info_sex' => 'sex',
            'reg_num' => 'registration number',
            'birth_date' => 'birth date',
            'birth_season' => 'birth season',
            'birth_type' => 'birth type',
            'milk_type' => 'birth milk',
            'jaw' => 'jaw',
            'ear' => 'teat',
            'teat' => 'ear type',
            'horn' => 'horn type',
            'body' => 'body color',
            'info_dam_id' => 'dam name', // Only if needed
            'info_sire_id' => 'sire name', // Only if needed
        ];
    }
}
