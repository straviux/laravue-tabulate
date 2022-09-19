<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Http\Resources\ContestResource;
use App\Http\Requests\StoreContestRequest;
use App\Http\Requests\UpdateContestRequest;
use Illuminate\Http\Request;
// use Illuminate\Support\Arr;
// use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Str;
// use Illuminate\Validation\Rule;


class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        return ContestResource::collection(Contest::orderBy('created_at', 'DESC')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreSurveyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContestRequest $request)
    {
        $data = $request->validated();


        $contest = Contest::create($data);
        return new ContestResource($contest);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Survey $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Contest $contest, Request $request)
    {
        // $user = $request->user();
        // if ($user->id !== $contest->user_id) {
        //     return abort(403, 'Unauthorized action.');
        // }

        return new ContestResource($contest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateContestRequest $request
     * @param \App\Models\Contest                     $contest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContestRequest $request, Contest $contest)
    {
        $data = $request->validated();

        // Update survey in the database
        $contest->update($data);

        return new ContestResource($contest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contest $contest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contest $contest, Request $request)
    {
        $user = $request->user();
        if ($user->id !== $contest->user_id) {
            return abort(403, 'Unauthorized action.');
        }

        $contest->delete();

        return response('', 204);
    }
}
