<?php

namespace App\Http\Resources;

use App\Models\Score;
use App\Models\Judges;
use Illuminate\Http\Resources\Json\JsonResource;

class JudgeScoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $judge = Judges::select(['judge_name', 'contest_id'])->where('id', $this->judge_id)->first();
        // $contest = Contest::select(['contest_name'])->where('id', $judge->contest_id)->first();
        $scores = Score::select(['scores.score', 'contestants.contestant_name', 'criterias.criteria_name'])->where('scores.judge_id', $this->judge_id)->join('contestants', 'contestants.id', '=', 'scores.contestant_id')->join('criterias', 'criterias.id', '=', 'scores.criteria_id')
            ->distinct(['scores.id'])->get();
        return [
            'scores' => $scores
        ];
    }
}
