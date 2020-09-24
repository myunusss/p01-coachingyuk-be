<?php

namespace App\Http\Requests\Reply;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

/**
 * @OA\Schema(
 *   schema="ReplyStoreRequest",
 *   @OA\Property(
 *     property="answer_id",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="content",
 *     type="string"
 *   )
 * )
 */
class ReplyStoreRequest extends FormRequest
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
            'answer_id' => ['nullable', new ExistsId('answers')],
            'content' => ['required'],
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
