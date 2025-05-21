@extends('layouts.app')
@section('content')
    <div class="container">
        <div class ='container'>
            <h1>Booking history</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Car</th>
                        <th>Start rental</th>
                        <th>End rental</th>
                        <th>Booking status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->booking_id }}</td>
                            <td>
                                @foreach ($booking->cars as $car)
                                    {{ $car->car_name }}
                                    <br>
                                @endforeach
                            </td>
                            <td>{{ $booking->start_date }}</td>
                            <td>{{ $booking->end_date }}</td>
                            <td>{{ $booking->status }}</td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>
@endsection
