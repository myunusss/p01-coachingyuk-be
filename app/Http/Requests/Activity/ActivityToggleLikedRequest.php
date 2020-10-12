<?php

namespace App\Http\Requests\Activity;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;
use App\Rules\ExistsSlug;

/**
 * @OA\Schema(
 *   schema="ActivityToggleLikedRequest",
 *   @OA\Property(
 *     property="activity_id",
 *     type="integer"
 *   )
 * )
 */
class ActivityToggleLikedRequest extends FormRequest
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
            'activity_id' => ['required', new ExistsId('activities')],
        ];
    }

    public function messages()
    {
        return [];
    }
}
