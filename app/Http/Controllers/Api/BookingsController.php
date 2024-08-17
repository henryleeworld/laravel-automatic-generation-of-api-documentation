<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Place;
use Illuminate\Http\Request;

class BookingsController extends BaseController
{
    /**
     * List bookings.
     *
     * List all bookings of the user.
     */
    public function index(Request $request)
    {
        return $this->sendResponse(BookingResource::collection($request->user()->bookings), __('Bookings are retrieved successfully.'));
    }

    /**
     * Create booking.
     *
     * Create a booking for the given place at the given date.
     */
    public function store(Request $request)
    {
        $request->validate([
            'place_id' => ['required', 'exists:places,id'],
            'date' => ['required', 'date'],
        ]);

        $place = Place::find($request->get('place_id'));
        if (! $place->available($request->date('date'))) {
            return  $this->sendError(['error' => __('Place is not available at the given date.')]);
        }

        $booking = $request->user()->bookings()->create([
            'place_id' => $request->get('place_id'),
            'date' => $request->get('date'),
        ]);

        /**
         * The created booking.
         *
         * @status 201
         */
        return $this->sendResponse(new BookingResource($booking), __('Booking is created successfully.'));
    }

    /**
     * Update booking.
     *
     * Update the date of the given booking.
     */
    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'date' => ['required', 'date'],
        ]);

        if (! $booking->place->available($request->date('date'))) {
            return $this->sendError(['error' => __('Place is not available at the given date.')]);
        }

        $booking->update($data);

        return $this->sendResponse(new BookingResource($booking), __('Booking is updated successfully.'));
    }

    /**
     * Show booking.
     *
     * Show the given booking.
     */
    public function show(Booking $booking)
    {
        return $this->sendResponse(new BookingResource($booking, __('Booking is retrieved successfully.')));
    }

    /**
     * Delete booking.
     *
     * Delete the given booking.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return $this->sendResponse([], __('Booking deleted successfully.'));
    }
}
