<?php

namespace App\Http\Requests\Question;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;
use App\Rules\ExistsSlug;

/**
 * @OA\Schema(
 *   schema="TopicJoinRequest",
 *   @OA\Property(
 *     property="topic_id",
 *     type="string"
 *   )
 * )
 */
class TopicJoinRequest extends FormRequest
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
            'topic_id' => ['required', new ExistsId('topics')],
        ];
    }

    public function messages()
    {
        return [];
    }
}
