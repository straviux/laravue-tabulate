<?php

namespace App\Http\Resources;

use App\Models\Event;
use App\Http\Resources\EventResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class ContestResource extends JsonResource
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
            'name' => $this->name,
            'event' => Event::select(['event_name', 'id'])->where('id', $this->event_id)->first(),
            'status' => !!$this->status,
            'created_at' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime($this->updated_at))->format('Y-m-d H:i:s'),
            'contest_date' => Carbon::parse($this->contest_date)->format('Y-m-d H:i:s'),
        ];
    }
}
