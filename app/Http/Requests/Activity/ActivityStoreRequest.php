<?php

namespace App\Http\Requests\Activity;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

/**
 * @OA\Schema(
 *   schema="ActivityStoreRequest",
 *   @OA\Property(
 *     property="topic_id",
 *     type="integer"
 *   ),
 *   @OA\Property(
 *     property="content",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="note",
 *     type="string"
 *   )
 * )
 */
class ActivityStoreRequest extends FormRequest
{
    /**
     * Determine if the activity is authorized to make this request.
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
            'content' => ['required'],
            'note' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
