<?php

namespace App\Http\Requests;

use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // $event = $this->route('events');
        // if ($this->user()->id !== $event->user_id) {
        //     return false;
        // }
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
            'uuid' => 'required|string|max:50',
            'event_name' => 'required|string|max:1000',
            'user_id' => 'exists:users,id',
            'event_description' => 'nullable|string|max:1000',
            'status' => 'required|boolean',
            'event_date' => 'nullable|date',
        ];
    }
}
