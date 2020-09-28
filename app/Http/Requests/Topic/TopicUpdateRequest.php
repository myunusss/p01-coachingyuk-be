<?php

namespace App\Http\Requests\Topic;

use App\Helpers\FormRequest;
use App\Rules\ExistsSlug;
use App\Rules\ExistsId;

/**
 * @OA\Schema(
 *   schema="TopicUpdateRequest",
 *   @OA\Property(
 *     property="name",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="background",
 *     type="string"
 *   )
 * )
 */
class TopicUpdateRequest extends FormRequest
{
    /**
     * Add Id to request validation
     * @var $routeParametersToValidate
     * @return array
     */

    protected $routeParametersToValidate = ['slug' => 'topic'];

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
            'slug' => ['required', new ExistsSlug('topics')],
            'category_id' => ['required', new ExistsId('categories')],
            'name' => ['nullable'],
            'background' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
