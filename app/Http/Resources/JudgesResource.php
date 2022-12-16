<?php

namespace App\Http\Resources;

use App\Models\Contest;
use App\Models\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class JudgesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $contest = Contest::select(['contest_name'])->where('id', $this->contest_id)->first();
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'judge_name' => $this->judge_name,
            'position' => $this->position,
            'contest_name' => $contest['contest_name'],
            'order' => $this->order,
        ];
    }
}
