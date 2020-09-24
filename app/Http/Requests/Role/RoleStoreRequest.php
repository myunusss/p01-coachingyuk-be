<?php

namespace App\Http\Requests\Role;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

/**
 * @OA\Schema(
 *   schema="RoleStoreRequest",
 *   @OA\Property(
 *     property="name",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="code",
 *     type="string"
 *   ),
 * )
 */
class RoleStoreRequest extends FormRequest
{
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
            'name' => ['required'],
            'code' => ['required'],
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
