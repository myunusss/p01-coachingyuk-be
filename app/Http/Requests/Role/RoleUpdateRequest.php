<?php

namespace App\Http\Requests\Role;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

/**
 * @OA\Schema(
 *   schema="RoleUpdateRequest",
 *   @OA\Property(
 *     property="name",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="code",
 *     type="string"
 *   )
 * )
 */
class RoleUpdateRequest extends FormRequest
{
    /**
     * Add id to request validation
     * @var $routeParametersToValidate
     * @return array
     */

    protected $routeParametersToValidate = ['id' => 'role'];

    /**
     * Determine if the role is authorized to make this request.
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
            'id' => ['required', new ExistsId('roles')],
            'name' => ['nullable'],
            'code' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
