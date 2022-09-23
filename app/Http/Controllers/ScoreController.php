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
        //
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
