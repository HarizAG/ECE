<!-- filepath: resources/views/bookings/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Book Car</h1>
        <div class="card">
            <div class="card-body">
                <h3><u>Car Information & Booking Details</u></h3>
                @foreach ($cars as $car)
                @endforeach
                <h5 class="card-title">Car: {{ $car->car_name }}</h5>
                <h5 class="card-text">Brand: {{ $car->brand }}</h5>
                <h5 class="card-text">Type: {{ $car->type }}</h5>
                <h5 class="card-text">Transmission: {{ $car->transmission }}</h5>
                <h5 class="card-text">Branch: {{ $location }}</h5>
            </div>
        </div>

        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="car_id" value="{{ $car->id }}">

            <!-- Start Rental Date -->
            <div class="form-group mt-3">
                <label for="start_date">Start Rental Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>

            <!-- End Rental Date -->
            <div class="form-group mt-3">
                <label for="end_date">End Rental Date</label>
                <input type="date" name="end_date" id="end_date" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Confirm Booking</button>
            <a href="{{ url('/cars') }}" class="btn btn-secondary mt-3">Cancel Booking</a>
        </form>
    </div>
@endsection
