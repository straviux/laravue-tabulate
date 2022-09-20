<?php

namespace App\Http\Resources;

use App\Models\Contest;
use Illuminate\Http\Resources\Json\JsonResource;

class CriteriaResource extends JsonResource
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
            'criteria_name' => $this->criteria_name,
            'percentage' => $this->percentage,
            'contest' => Contest::select(['name', 'id'])->where('id', $this->contest_id)->first(),
            'status' => !!$this->status,
        ];
    }
}
