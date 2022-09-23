<?php

namespace App\Http\Controllers;

use App\Models\Judges;
use App\Http\Resources\JudgesResource;
use App\Http\Requests\StoreJudgesRequest;
use App\Http\Requests\UpdateJudgesRequest;
use Illuminate\Http\Request;

class JudgesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return JudgesResource::collection(Judges::where('contest_id', $request['id'])->orderBy('order', 'ASC')->paginate(10));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJudgesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJudgesRequest $request)
    {
        //
        $data = $request->all();
        $judges = $data['judges'];
        foreach ($judges as $key => $judge) {
            // return $criteria;
            Judges::create([
                'uuid' =>  $judge['uuid'],
                'judge_name'    =>  $judge['judge_name'],
                'position'       =>  $judge['position'],
                'contest_id'       =>  $judge['contest_id'],
                'order'            => $judge['order']
            ]);
        }
        // return json_decode($request);
        // return SurveyQuestion::create($validator->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Judges $judge
     * @return \Illuminate\Http\Response
     */
    public function show(Judges $judge, Request $request)
    {
        // $user = $request->user();
        // if ($user->id !== $contest->user_id) {
        //     return abort(403, 'Unauthorized action.');
        // }

        return new JudgesResource($judge);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJudgesRequest  $request
     * @param  \App\Models\Judges  $judges
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJudgesRequest $request, Judges $judge)
    {
        //
        $data = $request->validated();

        // Update survey in the database
        $judge->update($data);

        return new JudgesResource($judge);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Judges  $judges
     * @return \Illuminate\Http\Response
     */
    public function destroy(Judges $judge, Request $request)
    {

        $user = $request->user();
        if (!$user->id) {
            return abort(403, 'Unauthorized action.');
        }

        $judge->delete();

        return response('', 204);
    }
}
