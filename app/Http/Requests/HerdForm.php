<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class HerdForm extends FormRequest
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
            "registration_number" => ['required', Rule::unique('livestock_reg','RFID_TAG')],
            "birth_date" => ['required'],
            "birth_season" => ['required'],
            "birth_type" => ['required'],
            "birth_milk" => ['required'],
            "char_jaw" => ['required'],
            "char_teat" => ['required'],
            "char_ear_type" => ['required'],
            "char_horn_type" => ['required'],
            "char_body_color" => ['required'],
            "birth_image" => ['required'],
        ];

        if ($this->has('parents_checkbox')) {
            $rules["info_dam_id"] = ['required', Rule::exists('livestock_reg', 'RFID_TAG')];
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
            'registration_number' => 'registration number',
            'birth_image' => 'birth image',
            'birth_date' => 'birth date',
            'birth_season' => 'birth season',
            'birth_type' => 'birth type',
            'birth_milk' => 'birth milk',
            'char_jaw' => 'jaw',
            'char_teat' => 'teat',
            'char_ear_type' => 'ear type',
            'char_horn_type' => 'horn type',
            'char_body_color' => 'body color',
            'info_dam_id' => 'dam id', // Only if needed
            'info_sire_id' => 'sire id', // Only if needed
        ];
    }
    
}
