<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

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
            'cover_photo_url' => $this->cover_photo ? URL::to($this->cover_photo) : null,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'status' => !!$this->status,
            'featured' => !!$this->featured,
            'created_at' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime($this->updated_at))->format('Y-m-d H:i:s'),
            'posted_at' => (new \DateTime($this->expire_date))->format('Y-m-d H:i:s'),
            'tags' => []
        ];
    }
}
