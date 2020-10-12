<?php

namespace App\Http\Requests\Question;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;
use App\Rules\ExistsSlug;

/**
 * @OA\Schema(
 *   schema="QuestionFollowRequest",
 *   @OA\Property(
 *     property="question_id",
 *     type="integer"
 *   )
 * )
 */
class QuestionFollowRequest extends FormRequest
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
            'question_id' => ['required', new ExistsId('questions')],
        ];
    }

    public function messages()
    {
        return [];
    }
}
