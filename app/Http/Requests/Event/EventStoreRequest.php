<?php

namespace App\Http\Requests\Event;

use App\Helpers\FormRequest;
use App\Rules\ExistsId;

/**
 * @OA\Schema(
 *   schema="EventStoreRequest",
 *   @OA\Property(
 *     property="name",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="coach_id",
 *     type="integer"
 *   ),
 *   @OA\Property(
 *     property="date",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="location",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="is_online",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="is_free",
 *     type="boolean"
 *   ),
 *   @OA\Property(
 *     property="price",
 *     type="integer"
 *   )
 * )
 */
class EventStoreRequest extends FormRequest
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
            'name' => ['required'],
            'coach_id' => ['required'],
            'date' => ['required'],
            'location' => ['required'],
            'is_online' => ['required'],
            'is_free' => ['required'],
            'price' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
