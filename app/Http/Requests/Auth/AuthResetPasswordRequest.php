<?php

namespace App\Http\Requests\Auth;

use App\Helpers\FormRequest;

/**
 * @OA\Schema(
 *   schema="AuthResetPasswordRequest",
 *   @OA\Property(
 *     property="token",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="password",
 *     type="string"
 *   )
 * )
 */
class AuthResetPasswordRequest extends FormRequest
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
            'token' => ['required'],
            'password' => ['required'],
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
