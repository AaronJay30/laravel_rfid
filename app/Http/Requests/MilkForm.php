<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MilkForm extends FormRequest
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
            "RFID_TAG" => ['required'],
            "milk_yield" => ['required'],
            "milking_time_hour" => ['required', 'min:0', 'numeric'],
            "milking_time_minute" => ['required', 'min:1', 'numeric', 'max:60'],
            "milking_temperature" => ['required'],
            "milk_quality" => ['required'],
            "milk_protein" => ['required'],
            "lact_season" => ['required'],
            "lact_start" => ['required'],
            "lact_length" => ['required'],
            "lact_end" => ['required'],
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'RFID_TAG' => 'RFID TAG',
            'milk_yield' => 'milk yield',
            'milking_time_hour' => 'hour',
            'milking_time_minute' => 'minute',
            'milking_temperature' => 'milking time temperature',
            'milk_quality' => 'milk quality',
            'milk_protein' => 'milk protein',
            'lact_season' => 'lactation season',
            'lact_start' => 'lactation start',
            'lact_length' => 'lactation length',
            'lact_end' => 'lactation end',
        ];
    }
}
