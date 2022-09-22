<?php

namespace App\Http\Controllers;

use App\Models\Contestants;
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
