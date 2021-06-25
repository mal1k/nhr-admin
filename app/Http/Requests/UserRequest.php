<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    if ( empty($this->user->business) ) {
        $rules = [
            'name' => 'required|min:3|max:255',
            'email' => 'required|unique:users,email|min:3|max:255|email'
        ];

        if ( !empty($this->user->id) )
        $rules = [
            'name' => 'required|min:3|max:255',
            'email' => 'min:3|max:255|required|email|unique:users,email,'.$this->user->id
        ];
    } else {
        $rules = [
            'name' => 'required|min:3|max:255',
            'email' => 'required|unique:users,email|min:3|max:255|email',
            // 'business' => 'required|min:3|max:255'
        ];

        if ( !empty($this->user->id) )
        $rules = [
            'name' => 'required|min:3|max:255',
            'email' => 'min:3|max:255|required|email|unique:users,email,'.$this->user->id,
            // 'business' => 'required|min:3|max:255|unique:users,business,'.$this->user->id
        ];
    }

        return $rules;
    }
}
