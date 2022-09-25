<?php

namespace App\Http\Resources;

use App\Models\Contest;
use App\Models\Judges;
use App\Models\Contestants;
use App\Models\Criteria;
use Illuminate\Http\Resources\Json\JsonResource;

class ScoreResource extends JsonResource
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
        $judge = Judges::select(['judge_name'])->where('id', $this->judge_id)->first();
        $contestant = Contestants::select(['contestant_name', 'order'])->where('id', $this->contestant_id)->first();
        $criteria = Criteria::select(['criteria_name', 'percentage'])->where('id', $this->criteria_id)->first();
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'score' => $this->score,
            'contestant_id' => $this->contestant_id,
            'contest_id' => $this->contest_id,
            'criteria_id' => $this->criteria_id,
            'judge_id' => $this->judge_id,
            'contest' => $contest,
            'judge' => $judge,
            'contestant' => $contestant,
            'criteria' => $criteria,
        ];
    }
}
