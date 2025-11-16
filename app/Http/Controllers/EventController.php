<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        return EventResource::collection(Event::with('category')->paginate(10));
    }
    public function show(Event $event)
    {
        return new EventResource($event);
    }
    public function store(EventRequest $request)
    {
        $data = $request->validated();
        $event = Event::create($data);
        return new EventResource($event);
    }
    public function update(EventRequest $request, Event $event)
    {
        $data = $request->validated();
        $event->update($data);
        return new EventResource($event);
    }
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(
            [
                'message' => 'Event deleted successfully'
            ],
            200
        );
    }
    public function toggle(Event $event)
    {
        $event->is_active = !$event->is_active;
        $event->save();
        return new EventResource($event);
    }
}
