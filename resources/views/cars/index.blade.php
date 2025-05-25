@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cars List</h1>

        @if (Auth::check() && Auth::user()->role == 'staff')
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('cars.create') }}" class="btn btn-success">+ Add car</a>
            </div>
        @endif

        <form method="GET" action="{{ route('cars.index') }}" class="row g-2 mb-3">
            <div class="col-md-3">
                <select name="branch_id" class="form-select">
                    <option value="">All Branches</option>
                    <option value="1" {{ request('branch_id') == '1' ? 'selected' : '' }}>Bangi</option>
                    <option value="2" {{ request('branch_id') == '2' ? 'selected' : '' }}>Gombak</option>
                    <option value="3" {{ request('branch_id') == '3' ? 'selected' : '' }}>Shah Alam</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="type" class="form-select">
                    <option value="">All Types</option>
                    <option value="sedan" {{ request('type') == 'sedan' ? 'selected' : '' }}>Sedan</option>
                    <option value="suv" {{ request('type') == 'suv' ? 'selected' : '' }}>SUV</option>
                    <option value="hatchback" {{ request('type') == 'hatchback' ? 'selected' : '' }}>Hatchback</option>
                    <option value="sport" {{ request('type') == 'sport' ? 'selected' : '' }}>Sport</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="transmission" class="form-select">
                    <option value="">All Transmissions</option>
                    <option value="automatic" {{ request('transmission') == 'automatic' ? 'selected' : '' }}>Automatic
                    </option>
                    <option value="manual" {{ request('transmission') == 'manual' ? 'selected' : '' }}>Manual</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Plate number</th>
                    <th>Car</th>
                    <th>Brand</th>
                    <th>Type</th>
                    <th>Transmission</th>
                    <th>Branch</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $car->plate_number }}</td>
                        <td>{{ $car->car_name }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->type }}</td>
                        <td>{{ $car->transmission }}</td>
                        <td>{{ $car->branch->name }}</td>
                        <td>{{ $car->status }}</td>
                        <td>
                            @if (Auth::check() &&
                                    Auth::user()->role == 'staff' &&
                                    Auth::user()->staff &&
                                    Auth::user()->staff->branch_id == $car->branch_id)
                                <form action="{{ route('cars.destroy', $car->car_id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @elseif (Auth::check() && Auth::user()->role == 'customer')
                                <a href="{{ route('bookings.create', ['car_id' => $car->car_id]) }}"
                                    class="btn btn-primary">Book</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
