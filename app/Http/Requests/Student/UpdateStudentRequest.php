<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'firstname_fr' => 'string',
            'lastname_fr' => 'string',

            'firstname_ar' => 'string',
            'lastname_ar' => 'string',

            'birthday' => 'date',
            'gender' => 'numeric|between:1,2',
            'state_of_birth' => 'string',
            'place_of_birth' => 'string',

            'photo' => 'nullable|mimes:jpeg,png,jpg',
            'status' => 'nullable|numeric|between:1,2',

            'registration_number' => 'numeric|unique:students,registration_number,'.$this->id,
            'group' => 'numeric',
            'residence' => 'string',
            'batch' => 'string',
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',

            'phone' => 'numeric|unique:students,phone,'.$this->id,
            'email' => 'email|unique:students,email,'.$this->id,
            'password' => 'sometimes|string|nullable|min:8|max:255',
            'password_confirmation' => 'sometimes|string|nullable|same:password|min:8|max:255'
        ];
    }
    public function attributes()
    {
        return [
            'firstname_fr'   => trans('auth/student.firstname_fr'),
            'firstname_ar'   => trans('auth/student.firstname_ar'),
            'lastname_fr'    => trans('auth/student.lastname_fr'),
            'lastname_ar'    => trans('auth/student.lastname_ar'),

            'birthday'       => trans('auth/student.birthday'),
            'gender'         => trans('auth/student.gender'),
            'state_of_birth' => trans('auth/student.state_of_birth'),
            'place_of_birth' => trans('auth/student.place_of_birth'),

            'registration_number' => trans('auth/student.registration_number'),
            'group'               => trans('auth/student.group'),
            'residence'               => trans('auth/student.residence'),
            'batch'               => trans('auth/student.batch'),
            'start_date'               => trans('auth/student.start_date'),
            'end_date'               => trans('auth/student.end_date'),

            'phone'    => trans('auth/student.phone'),
            'email'    => trans('auth/student.email'),
            'password' => trans('auth/student.password'),
        ];
    }
}
