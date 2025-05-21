<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Customer;

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
    public function create(Request $request)
    {
        $branch_id = $request->branch_id; // Assuming branch_id is passed in the request

        if ($branch_id == 1) {
            $location = 'Bangi';
        } elseif ($branch_id == 2) {
            $location = 'Gombak';
        } else {
            $location = 'Shah Alam';
        }

        $cars = Car::all();
        $customers = Customer::all();
        return view('bookings.create', compact('customers', 'cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'car_ids' => 'required|array|min:1|max:2',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $booking = Booking::create([
            'customer_id' => $validated['customer_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        $booking->cars()->attach($request->car_ids);

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
}
