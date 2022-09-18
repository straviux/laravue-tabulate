<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Resources\EventResource;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Illuminate\Http\Request;
// use Illuminate\Support\Arr;
// use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Str;
// use Illuminate\Validation\Rule;


class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return EventResource::collection(Event::where('user_id', $user->id)->orderBy('created_at', 'DESC')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreSurveyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        $data = $request->validated();


        $event = Event::create($data);
        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Survey $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, Request $request)
    {
        $user = $request->user();
        if ($user->id !== $event->user_id) {
            return abort(403, 'Unauthorized action.');
        }

        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateEventRequest $request
     * @param \App\Models\Event                     $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        $data = $request->validated();

        // Update survey in the database
        $event->update($data);

        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event, Request $request)
    {
        $user = $request->user();
        if ($user->id !== $event->user_id) {
            return abort(403, 'Unauthorized action.');
        }

        $event->delete();

        return response('', 204);
    }
}
