<?php

namespace App\Http\Requests\Answer;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;
use App\Rules\ExistsSlug;

/**
 * @OA\Schema(
 *   schema="AnswerToggleHelpfulRequest",
 *   @OA\Property(
 *     property="answer_id",
 *     type="int"
 *   )
 * )
 */
class AnswerToggleHelpfulRequest extends FormRequest
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
            'answer_id' => ['required', new ExistsId('answers')],
        ];
    }

    public function messages()
    {
        return [];
    }
}
