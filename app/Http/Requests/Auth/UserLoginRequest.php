<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
        $fieldType = filter_var($this->request->get('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldType === 'username') {
            return [
                'username' => 'bail|required|string|min:3|max:255|exists:profiles,username',
                'password' => 'bail|required|string|min:3|max:255'
            ];
        }

        return [
            'username' => 'bail|required|string|min:3|max:255|exists:users,email',
            'password' => 'bail|required|string|min:3|max:255'
        ];
    }
}
