<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Contestants;
use App\Http\Resources\ScoreResource;
use App\Http\Resources\JudgeScoreResource;
use App\Http\Requests\StoreScoreRequest;
use App\Http\Requests\UpdateScoreRequest;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function getByJudge(Request $request)
    {
        $scores = Score::select(['scores.score', 'contestants.id', 'contestants.order', 'contestants.contestant_name', 'criterias.criteria_name'])->where('scores.judge_id', $request['judge_id'])->join('contestants', 'contestants.id', '=', 'scores.contestant_id')->join('criterias', 'criterias.id', '=', 'scores.criteria_id')->orderBy('contestants.order', 'ASC')->get();



        // $contestants = Contestants::select(['scores.score', 'contestants.order', 'contestants.contestant_name', 'criterias.criteria_name'])->where('scores.judge_id', $request['judge_id'])->join('contestants', 'contestants.id', '=', 'scores.contestant_id')->join('criterias', 'criterias.id', '=', 'scores.criteria_id')->orderBy('contestants.order', 'ASC')->get();

        $temp = [];
        foreach ($scores as $key => &$entry) {


            $temp[$entry['contestant_name']][$key] = [
                'contestant_name' => $entry['contestant_name'],
                'order' => $entry['order'],
                'score' => $entry['score'],
                'contestant_id' => $entry['id'],
                'criteria_name' => $entry['criteria_name'],
            ];
        }

        // get total score
        $arr = [];
        $i = 0;
        foreach ($temp as $key => $entry) {
            $temp[$key]['total'] = 0;

            foreach ($entry as $k) {
                $temp[$key]['total'] += +$k['score'];
                $arr[$i] = [
                    'total' => $temp[$key]['total'],
                    'contestant_name' => $k['contestant_name'],
                    'contestant_id' => $k['contestant_id'],
                    'order' => $k['order'],
                    'scores' => ['score' => $k['score'], 'criteria_name' => $k['criteria_name']]
                ];
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



    public function getByJudgeAndContestant(Request $request)
    {
        // return ScoreResource::collection(Score::where('contestant_id', $request['contestant_id'])->where('judge_id', $request['judge_id'])->get());
        $contestants = Contestants::select(['contestants.id', 'contestants.order', 'contestants.contestant_name'])->where('contestants.id', $request['contestant_id'])->orderBy('contestants.order', 'ASC')->get();

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
     * @param  \App\Http\Requests\StoreScoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScoreRequest $request)
    {
        $data = $request->all();
        $scores = $data['scores'];
        $contest_id = $data['contest_id'];
        // return $scores;
        foreach ($scores as $key => $score) {
            // return $criteria;
            Score::create([
                'uuid' => $score['uuid'],
                'criteria_id'    =>  $score['criteria_id'],
                'score'       =>  $score['score'],
                'contest_id'       =>  $contest_id,
                'contestant_id'            => $data['contestant_id'],
                'judge_id'            => $data['judge_id']
            ]);
        }

        return response($scores);
    }

    public function updateScores(UpdateScoreRequest $request, Score $score)
    {
        $data = $request->all();
        $scores = $data['scores'];
        foreach ($scores as $key => $s) {
            Score::where('id', $s['id'])->update(['score' => $s['score']]);
        }


        return response($scores);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScoreRequest  $request
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScoreRequest $request, Score $score)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        //
    }
}
