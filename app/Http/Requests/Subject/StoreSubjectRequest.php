<?php

namespace App\Http\Requests\Subject;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name'  => 'required|string|min:5|max:100|unique:subjects,name',
            'coef'  => 'required|numeric',
        ];
    }
    public function attributes()
    {
        return [
            'name' => trans('section.name'),
            'coef' => trans('section.coef'),
        ];
    }
}
