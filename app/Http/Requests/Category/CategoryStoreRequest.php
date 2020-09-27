<?php

namespace App\Http\Requests\Category;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

/**
 * @OA\Schema(
 *   schema="CategoryStoreRequest",
 *   @OA\Property(
 *     property="name",
 *     type="string"
 *   )
 * )
 */
class CategoryStoreRequest extends FormRequest
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
            'name' => ['required'],
            'background' => ['required'],
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
