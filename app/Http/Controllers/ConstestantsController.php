<?php

namespace App\Http\Controllers;

use App\Models\Contestants;
use App\Http\Requests\StoreContestantsRequest;
use App\Http\Requests\UpdateContestantsRequest;

class ConstestantsController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContestantsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContestantsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contestants  $contestants
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
    public function update(UpdateContestantsRequest $request, Contestants $contestants)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contestants  $contestants
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contestants $contestants)
    {
        //
    }
}
