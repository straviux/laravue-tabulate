<?php

namespace App\Http\Resources;

use App\Models\Contest;

use App\Models\Score;

use Illuminate\Http\Resources\Json\JsonResource;

class ContestantResource extends JsonResource
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
            'uuid' => $this->uuid,
            'contestant_name' => $this->contestant_name,
            'contest' => Contest::select(['contest_name', 'id'])->where('id', $this->contest_id)->first(),
            'order' => $this->order,
            'scores' => Score::select(['id', 'score'])->where('contestant_id', $this->id)->where('judge_id', $this->judge_id)->get(),
        ];
    }
}
