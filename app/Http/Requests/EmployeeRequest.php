<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
        $rules =  [
            'name'  => ['required', 'min:2'],
            'profile_image' => ['image','mimes:jpeg,png,jpg,gif,svg','max:5120'],
            'email' => ['required','unique:employees'],
            'designation_id'=> ['required']
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $employee = $this->route()->parameter('employee');

            $rules['email'] = [
                'required',
                Rule::unique('employees')->ignore($employee),
            ];
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'designation_id.required' => 'The designation field is required',
        ];
    }
}
