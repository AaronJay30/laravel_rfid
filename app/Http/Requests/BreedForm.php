<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BreedForm extends FormRequest
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
            "breed_type" => ['required'],
            'dam_id' => ['required', Rule::exists('livestock_reg','RFID_TAG')],
            'sire_id' => ['required', Rule::exists('livestock_reg','RFID_TAG')],
            'sire_breed_count' => ['required'],
            'dam_breed_count' => ['required'],
            'breed_date' => ['required'],
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'dam_id.exists' => 'The selected dam id does not exist in the livestock.',
            'sire_id.exists' => 'The selected sire id does not exist in the livestock.',
            // Add custom error messages for other rules if needed
        ];
    }

    public function attributes()
    {
        return [
            'breed_type' => 'Breed Type',
            'dam_id' => 'Dam ID',
            'sire_id' => 'Sire ID',
            'sire_breed_count' => 'Sire Breed Count',
            'dam_breed_count' => 'Dam Breed Count',
            'breed_date' => 'Breed Date',
            'birth_date' => 'Birth Date',
            'birth_weight' => 'Birth Weight',
            'birth_length' => 'Birth Length',
        ];
    }
}
