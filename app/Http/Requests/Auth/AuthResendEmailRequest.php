<?php

namespace App\Http\Requests\Auth;

use App\Helpers\FormRequest;

/**
 * @OA\Schema(
 *   schema="AuthResendEmailRequest",
 *   @OA\Property(
 *     property="email",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="callback_url",
 *     type="string"
 *   )
 * )
 */
class AuthResendEmailRequest extends FormRequest
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
            'email' => ['required'],
            'callback_url' => ['required'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
