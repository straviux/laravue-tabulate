<?php

namespace App\Http\Requests;

use App\Models\News;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $news = $this->route('news');
        if ($this->user()->id !== $news->user_id) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'headline' => 'required|string|max:1000',
            'user_id' => 'exists:users,id',
            'cover_photo' => 'nullable|string',
            'status' => 'required|boolean',
            'featured' => 'required|boolean',
            'excerpt' => 'required|string|max:1000',
            'slug' => 'required|string|max:1000',
            'content' => 'required|string',
            'posted_at' => 'nullable|date',
        ];
    }
}
