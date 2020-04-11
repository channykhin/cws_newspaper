<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRegisterRequest extends Request
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
        return [
            'first_name' => 'required|min:1|max:10',
            'last_name' => 'required|min:1|max:10',
            'username' => 'required|min:3|max:30|unique:users,username,',
            'email' => 'required|email|unique:users,username,',
            'password' => 'required|min:6|max:15',
            'confirm_password' => 'required|same:password',
        ];
    }
}
