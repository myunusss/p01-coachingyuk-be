<?php

namespace App\Http\Requests\Category;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

/**
 * @OA\Schema(
 *   schema="CategoryUpdateRequest",
 *   @OA\Property(
 *     property="name",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="background",
 *     type="file"
 *   )
 * )
 */
class CategoryUpdateRequest extends FormRequest
{
    /**
     * Add Id to request validation
     * @var $routeParametersToValidate
     * @return array
     */

    protected $routeParametersToValidate = ['id' => 'category'];

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
            'id' => ['required', new ExistsId('categories')],
            'name' => ['nullable'],
            'background' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
