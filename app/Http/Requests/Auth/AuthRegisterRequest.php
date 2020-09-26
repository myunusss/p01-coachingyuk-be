<?php

namespace App\Http\Requests\User;

use App\Helpers\FormRequest;

/**
 * @OA\Schema(
 *   schema="AuthRegisterRequest",
 *   @OA\Property(
 *     property="first_name",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="last_name",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="username",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="email",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="password",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="timezone",
 *     type="string"
 *   )
 * )
 */
class AuthRegisterRequest extends FormRequest
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
            'first_name' => ['required'],
            'last_name' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'timezone' => ['required'],
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
