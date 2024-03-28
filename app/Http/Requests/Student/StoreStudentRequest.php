<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'firstname_fr' => 'required|string',
            'lastname_fr' => 'required|string',

            'firstname_ar' => 'required|string',
            'lastname_ar' => 'required|string',

            'birthday' => 'required|date',
            'gender' => 'required|numeric|between:1,2',
            'state_of_birth' => 'required|string',
            'place_of_birth' => 'required|string',

            'photo' => 'nullable|mimes:jpeg,png,jpg',
            'status' => 'nullable|numeric|between:1,2',

            'registration_number' => 'required|numeric|unique:students,registration_number',
            'group' => 'required|numeric',
            'residence' => 'required|string',
            'batch' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            
            'phone' => 'required|numeric|unique:students,phone',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|min:8|max:255',
            'password_confirmation' => 'required_with:password|same:password|min:8|max:255'
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
