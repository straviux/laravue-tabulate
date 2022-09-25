<?php

namespace App\Http\Controllers;

use App\Models\Contestants;
use App\Models\Score;
use App\Http\Resources\ContestantResource;
use App\Http\Requests\StoreContestantsRequest;
use App\Http\Requests\UpdateContestantsRequest;
use Illuminate\Http\Request;

class ContestantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ContestantResource::collection(Contestants::where('contest_id', $request['id'])->orderBy('order', 'ASC')->paginate(10));
    }



    public function getByJudge(Request $request)
    {
        $contestants = Contestants::select(['contestants.id', 'contestants.order', 'contestants.contestant_name'])->where('contestants.contest_id', $request['contest_id'])->orderBy('contestants.order', 'ASC')->get();

        $scores = Score::select(['scores.score', 'scores.id', 'scores.uuid', 'contestants.id as contestant_id', 'criterias.criteria_name', 'criterias.id as criteria_id', 'criterias.percentage'])->where('scores.judge_id', $request['judge_id'])->join('contestants', 'contestants.id', '=', 'scores.contestant_id')->join('criterias', 'criterias.id', '=', 'scores.criteria_id')->orderBy('contestants.order', 'ASC')->get();


        $arr = [];
        $i = 0;
        foreach ($contestants as $key => $val) {
            $arr[$i] = [
                'contestant_name' => $val['contestant_name'],
                'contestant_id' => $val['id'],
                'order' => $val['order'],
                'scores' => [],
                'total' => 0,
            ];
            foreach ($scores as $key => $v) {
                if ($val['id'] === $v['contestant_id']) {
                    $arr[$i]['scores'][] =  [
                        'score_id' => $v['id'],
                        'uuid' => $v['uuid'],
                        'score' => $v['score'],
                        'criteria_name' => $v['criteria_name'],
                        'criteria_percentage' => $v['percentage'],
                        'criteria_id' => $v['criteria_id'],
                    ];
                    $arr[$i]['total'] += $v['score'];
                }
            }
            $i++;
        }
        array_multisort(array_column($arr, "total"), SORT_DESC, $arr);

        // RANK TOTAL
        $i = 0;
        foreach ($arr as $key) {
            $arr[$i]['rank'] = $i + 1;
            $i++;
        }
        return response($arr);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContestantsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContestantsRequest $request)
    {
        //
        $data = $request->all();
        $contestants = $data['contestants'];
        foreach ($contestants as $key => $c) {
            // return $criteria;
            Contestants::create([
                'uuid' =>  $c['uuid'],
                'contestant_name'    =>  $c['contestant_name'],
                'contest_id'       =>  $c['contest_id'],
                'order'            => $c['order']
            ]);
        }
        // return json_decode($request);
        // return SurveyQuestion::create($validator->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contestants $contestants
     * @return \Illuminate\Http\Response
     */
    public function show(Contestants $contestants)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContestantsRequest  $request
     * @param  \App\Models\Contestants  $contestants
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContestantsRequest $request, Contestants $contestant)
    {
        //
        $data = $request->validated();

        // Update survey in the database
        $contestant->update($data);

        return new ContestantResource($contestant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contestants  $contestants
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contestants $contestant, Request $request)
    {
        // return $request;
        $user = $request->user();
        if (!$user->id) {
            return abort(403, 'Unauthorized action.');
        }

        $contestant->delete();
    }
}
