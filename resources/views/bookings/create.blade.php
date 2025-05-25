@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Book Car: {{ $car->car_name }} ({{ $car->brand }})</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf

            <input type="hidden" name="car_id" value="{{ $car->car_id }}">

            <div class="form-group mb-3">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" class="form-control" required>

                @error('start_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Submit Booking</button>
            <a href="{{ route('cars.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
