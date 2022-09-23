<?php

namespace App\Http\Resources;

use App\Models\Event;
use App\Models\Criteria;
use App\Models\Contestants;
use App\Models\Judges;
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
            'uuid' => $this->uuid,
            'contest_name' => $this->contest_name,
            'event' => Event::select(['event_name', 'id'])->where('id', $this->event_id)->first(),
            'status' => !!$this->status,
            'created_at' => (new \DateTime($this->created_at))->format('Y-m-d H:i:s'),
            'updated_at' => (new \DateTime($this->updated_at))->format('Y-m-d H:i:s'),
            'contest_date' => Carbon::parse($this->contest_date)->format('Y-m-d H:i:s'),
            'criterias' => Criteria::select(['id', 'criteria_name', 'percentage'])->where('contest_id', $this->id)->get(),
            'judges' => Judges::select(['id', 'judge_name', 'position'])->where('contest_id', $this->id)->get(),
            'contestants' => Contestants::select(['id', 'contestant_name'])->where('contest_id', $this->id)->get(),
        ];
    }
}
