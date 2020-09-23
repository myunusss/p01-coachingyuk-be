<?php

namespace App\Http\Requests\User;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

class UserUpdateRequest extends FormRequest
{
    /**
     * Add id to request validation
     * @var $routeParametersToValidate
     * @return array
     */

    protected $routeParametersToValidate = ['id' => 'user'];

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
            'id' => ['required', new ExistsId('users')],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'username' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'bio' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
