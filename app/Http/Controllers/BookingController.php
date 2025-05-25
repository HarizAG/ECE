<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('cars', 'customers')->get();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $car_id)
    {
        $car = Car::findOrFail($car_id);
        return view('bookings.create', compact('car'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,car_id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ], [
            'car_id.required' => 'Please choose a car to book.',
            'start_date.required' => 'Please select a start date.',
            'end_date.required' => 'Please select an end date.',
            'start_date.after_or_equal' => 'Start date must be today or later.',
            'end_date.after' => 'End date must be after the start date.',
        ]);

        // Rule 1: Must be at least 2 days in advance
        $startDate = \Carbon\Carbon::parse($request->start_date);
        if ($startDate->diffInDays(now(), false) > -2) {
            return back()->withErrors(['start_date' => 'Bookings must be made at least 2 days in advance.'])->withInput();
        }

        // Rule 2: Prevent double booking of the same car
        $overlapping = DB::table('bookings')
            ->join('car_booking', 'bookings.booking_id', '=', 'car_booking.booking_id')
            ->where('car_booking.car_id', $request->car_id)
            ->where('bookings.status', '!=', 'cancelled')
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_date', '<', $request->start_date)
                            ->where('end_date', '>', $request->end_date);
                    });
            })
            ->exists();

        if ($overlapping) {
            return back()->withErrors(['car_id' => 'This car is already booked for the selected dates.'])->withInput();
        }

        // Rule 3: A customer can only book 2 cars in the same date range
        $customer = \App\Models\Customer::where('user_id', Auth::id())->first();

        if (!$customer) {
            return back()->withErrors(['error' => 'Customer profile not found.'])->withInput();
        }

        $customer_id = $customer->customer_id;
        $samePeriodBookings = DB::table('bookings')
            ->join('car_booking', 'bookings.booking_id', '=', 'car_booking.booking_id')
            ->where('bookings.customer_id', $customer_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_date', '<', $request->start_date)
                            ->where('end_date', '>', $request->end_date);
                    });
            })
            ->count();

        if ($samePeriodBookings >= 2) {
            return back()->withErrors(['car_id' => 'You can only book up to 2 cars for the same rental period.'])->withInput();
        }

        // All good — store the booking
        $booking = Booking::create([
            'customer_id' => $customer_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending'
        ]);

        $booking->cars()->attach($request->car_id);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $customers = Customer::all();
        $cars = Car::all();
        return view('bookings.edit', compact('booking', 'customers', 'cars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'car_ids' => 'required|array|min:1|max:2',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $booking->update([
            'customer_id' => $validated['customer_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        $booking->cars()->sync($validated['car_ids']);
        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->cars()->detach();
        $booking->delete();
        return redirect('bookings.index', compact('bookings'))->with('success', 'Booking deleted successfully.');
    }

    public function updateStatus(Request $request, $booking_id)
    {
        $request->validate([
            'status' => 'required|in:confirmed,cancelled'
        ]);

        $booking = Booking::findOrFail($booking_id);
        $booking->status = $request->status;
        $booking->save();

        return back()->with('success', 'Booking status updated successfully.');
    }

    public function manage()
    {
        // You can customize this to paginate or filter bookings by status
        $bookings = Booking::with(['customers', 'cars'])->orderBy('created_at', 'desc')->get();

        return view('bookings.manage', compact('bookings'));
    }
}
