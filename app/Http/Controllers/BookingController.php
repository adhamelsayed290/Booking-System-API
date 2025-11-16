<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return  BookingResource::collection(Booking::paginate(10));
    }
    public function show(Booking $booking)
    {
        return new BookingResource($booking);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            "event_id" => "required|exists:events,id",
            "user_id" => "required|exists:users,id",
        ]);
        $event = Event::findOrFail($data['event_id']);
        if (!$event->is_active) {
            return response()->json([
                "message" => "Event is not active"
            ], 400);
        }
        if (Booking::where('event_id', '=', $data['event_id'])
            ->where('user_id', '=', $data['user_id'])
            ->exists()
        ) {
            return response()->json(["message" => "You have already booked this event"], 400);
        }

        if ($event->available_seats <= 0) {
            return response()->json(["message" => "Event is full"], 400);
        }

        $event->decrement('available_seats');
        $booking = Booking::create($data);
        return response()->json([
            "message" => "Booking created successfully",
            "booking" => new BookingResource($booking)
        ], 201);
    }
    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            "status" => "required|in:pending,confirmed,cancelled"
        ]);
        if ($data['status'] === 'confirmed') {
            $event = Event::findOrFail($booking->event_id);
            if ($event->available_seats <= 0) {
                return response()->json(["message" => "Event is full"], 400);
            }
            $event->decrement('available_seats');
        } else if ($data['status'] === 'cancelled') {
            $event = Event::findOrFail($booking->event_id);
            $event->increment('available_seats');
        }

        $booking->update($data);
        return response()->json([
            "message" => "Booking updated successfully",
            "booking" => new BookingResource($booking)
        ], 200);
    }
    public function toggle(Booking $booking)
    {
        $booking->is_active = !$booking->is_active;
        $booking->save();
        return response()->json(
            [
                "message" => "Booking status toggled successfully",
                'is_active' => $booking->is_active
            ],
            200
        );
    }
}
