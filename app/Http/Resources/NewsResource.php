<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'headline' => $this->headline,
            'slug' => $this->slug,
            'cover_photo' => $this->cover_photo,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'status' => $this->status !== 'draft',
            'featured' => $this->featured !== 'draft',
            'posted_at' => $this->posted_at,
            'tags' => []
        ];
    }
}
