@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Car</h1>
        <form action="{{ route('cars.store') }}" method="POST">
            @csrf

            <!-- Car Name -->
            <div class="form-group mb-3">
                <label for="car_name">Car Name</label>
                <input type="text" name="car_name" id="car_name" class="form-control" required>
            </div>

            <!-- Brand -->
            <div class="form-group mb-3">
                <label for="brand">Brand</label>
                <input type="text" name="brand" id="brand" class="form-control" required>
            </div>

            <!-- Type -->
            <div class="form-group mb-3">
                <label for="type">Type</label>
                <input type="text" name="type" id="type" class="form-control" required>
            </div>

            <!-- Transmission -->
            <div class="form-group mb-3">
                <label for="transmission">Transmission</label>
                <select name="transmission" id="transmission" class="form-control" required>
                    <option value="Automatic">Automatic</option>
                    <option value="Manual">Manual</option>
                </select>
            </div>

            <!-- Branch -->
            <div class="form-group mb-3">
                <label for="branch_id">Branch</label>
                <select name="branch_id" id="branch_id" class="form-control" required>
                    <option value="1">Bangi</option>
                    <option value="2">Gombak</option>
                    <option value="3">Shah Alam</option>
                </select>
            </div>

            <!--Number Plate -->
            <div class="form-group mb-3">
                <label for="plate_number">Number Plate</label>
                <input type="text" name="plate_number" id="number_plate" class="form-control"
                    @error('plate_number') is-invalid @enderror required>
                @error('plate_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add Car</button>
            <a href="{{ url('/cars') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
