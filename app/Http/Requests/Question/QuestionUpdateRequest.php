<?php

namespace App\Http\Requests\Question;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;
use App\Rules\ExistsSlug;

/**
 * @OA\Schema(
 *   schema="QuestionUpdateRequest",
 *   @OA\Property(
 *     property="topic_id",
 *     type="int"
 *   ),
 *   @OA\Property(
 *     property="content",
 *     type="string"
 *   )
 * )
 */
class QuestionUpdateRequest extends FormRequest
{
    /**
     * Add slug to request validation
     * @var $routeParametersToValidate
     * @return array
     */

    protected $routeParametersToValidate = ['slug' => 'question'];

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
            'slug' => ['required', new ExistsSlug('questions')],
            'topic_id' => ['nullable', new ExistsId('topics')],
            'content' => ['required'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
