<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Http\Resources\CriteriaResource;
use App\Http\Requests\StoreCriteriaRequest;
use App\Http\Requests\UpdateCriteriaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return CriteriaResource::collection(Criteria::where('contest_id', $request['id'])->orderBy('order', 'ASC')->paginate(10)); //change created at to order
        // return EventResource::collection(Event::where('user_id', $user->id)->orderBy('created_at', 'DESC')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCriteriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCriteriaRequest $request)
    {
        //
        $data = $request->all();
        $criterias = $data['criterias'];
        foreach ($criterias as $key => $criteria) {
            // return $criteria;
            Criteria::create([
                'uuid' =>  $criteria['uuid'],
                'criteria_name'    =>  $criteria['criteria_name'],
                'percentage'       =>  $criteria['percentage'],
                'contest_id'       =>  $criteria['contest_id'],
                'order'            => $criteria['order']
            ]);
        }
        // return json_decode($request);
        // return SurveyQuestion::create($validator->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function show(Criteria $criteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCriteriaRequest  $request
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCriteriaRequest $request, Criteria $criteria)
    {
        //
        $data = $request->validated();

        // Update survey in the database
        $criteria->update($data);

        return new CriteriaResource($criteria);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Criteria $criteria, Request $request)
    {

        $user = $request->user();
        if (!$user->id) {
            return abort(403, 'Unauthorized action.');
        }

        $criteria->delete();

        return response('', 204);
    }
}
