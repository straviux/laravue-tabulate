<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Http\Resources\ScoreResource;
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


    public function getByJudgeAndContestant(Request $request)
    {
        return ScoreResource::collection(Score::where('contestant_id', $request['contestant_id'])->where('judge_id', $request['judge_id'])->get());
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
        return $data;
        foreach ($scores as $key => $score) {
            $s = [
                "id" => $score['id'],
                'uuid' => $score['uuid'],
                'criteria_id'    =>  $score['criteria_id'],
                'score'       =>  $score['score'],
                'contest_id'       =>  $data['contest_id'],
                'contestant_id'            => $data['contestant_id'],
                'judge_id'            => $data['judge_id']
            ];

            $score->update($s);
        }



        return new ScoreResource($score);
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
        $data = $request->all();
        $scores = $data['scores'];
        return $data;
        foreach ($scores as $key => $score) {
            $s = [
                "id" => $score['id'],
                'uuid' => $score['uuid'],
                'criteria_id'    =>  $score['criteria_id'],
                'score'       =>  $score['score'],
                'contest_id'       =>  $data['contest_id'],
                'contestant_id'            => $data['contestant_id'],
                'judge_id'            => $data['judge_id']
            ];

            $score->update($s);
        }



        return new ScoreResource($score);
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
