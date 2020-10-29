<?php

namespace App\Http\Requests\Feedback;

use Illuminate\Validation\Rule;
use App\Helpers\FormRequest;

/**
 * @OA\Schema(
 *   schema="FeedbackStoreRequest",
 *   @OA\Property(
 *     property="type",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="content",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="email",
 *     type="string"
 *   )
 * )
 */
class FeedbackStoreRequest extends FormRequest
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
            'type' => [
                'required',
                Rule::in(['bug_report', 'billing_problem', 'general_feedback'])
            ],
            'content' => ['required'],
            'email' => ['required'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
