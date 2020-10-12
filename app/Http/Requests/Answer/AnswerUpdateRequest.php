<?php

namespace App\Http\Requests\Answer;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;
use App\Rules\ExistsSlug;

/**
 * @OA\Schema(
 *   schema="AnswerUpdateRequest",
 *   @OA\Property(
 *     property="question_id",
 *     type="integer"
 *   ),
 *   @OA\Property(
 *     property="content",
 *     type="string"
 *   )
 * )
 */
class AnswerUpdateRequest extends FormRequest
{
    /**
     * Add slug to request validation
     * @var $routeParametersToValidate
     * @return array
     */

    protected $routeParametersToValidate = ['slug' => 'answer'];

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
            'slug' => ['required', new ExistsSlug('answers')],
            'question_id' => ['nullable', new ExistsId('questions')],
            'content' => ['required'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
