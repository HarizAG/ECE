<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /** @var \App\Models\User $user */

    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user(); // Load the staff relationship
        } else {
            $user = null; // Handle unauthenticated users
        }

        $cars = Car::with(['branch', 'bookings' => function ($query) {
            $query->orderByDesc('booking_id'); // Ensure latest booking is first
        }])->get();

        // Append status to each car based on its latest booking
        $cars->map(function ($car) {
            $car->status = optional($car->bookings->first())->status ?? 'available';
            return $car;
        });

        return view('cars.index', compact('cars', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $car = Car::all();
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_name' => 'required',
            'brand' => 'required',
            'type' => 'required',
            'transmission' => 'required',
            'branch_id' => 'required',
            'plate_number' => 'required|unique:cars,plate_number',
        ]);

        Car::create([
            'car_name' => $validated['car_name'],
            'branch_id' => $validated['branch_id'],
            'brand' => $validated['brand'],
            'type' => $validated['type'],
            'transmission' => $validated['transmission'],
            'plate_number' => $validated['plate_number'],
        ]);

        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $car = Car::with('branch')->find($car->id);
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $car = Car::with('branch')->get();
        return view('cars.index', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'branch_id' => 'required',
            'brand' => 'required',
            'type' => 'required',
            'transmission' => 'required',
            'branch_id' => 'required',
            'plate_number' => 'required|unique:cars,plate_number,',
        ]);

        $car->update([
            'branch_id' => $validated['branch_id'],
            'brand' => $validated['brand'],
            'type' => $validated['type'],
            'transmission' => $validated['transmission'],
            'branch_id' => $validated['branch_id'],
            'plate_number' => $validated['plate_number'],
        ]);

        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car was deleted successfully.');
    }
}
