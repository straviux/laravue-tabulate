<?php

namespace App\Http\Controllers;

use App\Models\Judges;
use App\Http\Requests\StoreJudgesRequest;
use App\Http\Requests\UpdateJudgesRequest;

class JudgesController extends Controller
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
     * @param  \App\Http\Requests\StoreJudgesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJudgesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Judges  $judges
     * @return \Illuminate\Http\Response
     */
    public function show(Judges $judges)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJudgesRequest  $request
     * @param  \App\Models\Judges  $judges
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJudgesRequest $request, Judges $judges)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Judges  $judges
     * @return \Illuminate\Http\Response
     */
    public function destroy(Judges $judges)
    {
        //
    }
}
