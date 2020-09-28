<?php

namespace App\Http\Requests\User;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

/**
 * @OA\Schema(
 *   schema="UserUpdateRequest",
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
 *     property="bio",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="avatar",
 *     type="file"
 *   ),
 *   @OA\Property(
 *     property="header_image",
 *     type="file"
 *   )
 * )
 */
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
            'first_name' => ['nullable'],
            'last_name' => ['nullable'],
            'username' => ['nullable'],
            'email' => ['nullable'],
            'password' => ['nullable'],
            'bio' => ['nullable'],
            'avatar' => ['nullable'],
            'headline_image' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
