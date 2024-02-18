<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $data = [
            'name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'email', 'max:200', Rule::unique('users', 'email')->ignore(request()->site->inspector_id)],
            'state' => ['required', 'integer', 'exists:states,id'],
            'address' => ['required', 'string', 'max:200'],
            'photo' => ['nullable', 'image'],
            'shift_start_time' => ['nullable', 'string'],
            'shift_end_time' => ['nullable', 'string'],
            'number_of_tags' => ['required', 'numeric'],
            'maximum_number_of_rounds' => ['required', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'latitude' => ['nullable', 'numeric'],
        ];
        if (request()->user()->isCompanyOwner()){
            return $data;
        }
        return [
                'company_id' => ['required', 'integer', 'exists:companies,id'],
                'first_name' => ['nullable', 'string', 'max:200'],
                'last_name' => ['nullable', 'string', 'max:200'],
            ] + $data;
    }
}
