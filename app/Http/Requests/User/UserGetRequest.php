<?php

namespace App\Http\Requests\User;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

class UserGetRequest extends FormRequest
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
            'id' => ['nullable', new ExistsId('users')]
        ];
    }

    public function messages()
    {
        return [];
    }
}
