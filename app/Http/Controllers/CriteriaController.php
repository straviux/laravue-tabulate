<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Http\Resources\CriteriaResource;
use App\Http\Requests\StoreCriteriaRequest;
use App\Http\Requests\UpdateCriteriaRequest;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CriteriaResource::collection(Criteria::orderBy('created_at', 'DESC')->paginate(10)); //change created at to order
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
                'criteria_name'       =>  $criteria['criteria_name'],
                'percentage'       =>  $criteria['percentage'],
                'contest_id'       =>  $criteria['contest_id'],
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Criteria  $criteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Criteria $criteria)
    {
        //
    }
}
