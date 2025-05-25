@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Manage Bookings</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($bookings->isEmpty())
            <p>No bookings found.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Car(s)</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->customer->name ?? 'N/A' }}</td>
                            <td>
                                @foreach ($booking->cars as $car)
                                    {{ $car->car_name }} ({{ $car->brand }})<br>
                                @endforeach
                            </td>
                            <td>{{ $booking->start_date }}</td>
                            <td>{{ $booking->end_date }}</td>
                            <td>{{ ucfirst($booking->status) }}</td>
                            <td>
                                @if ($booking->status === 'pending')
                                    <form action="{{ route('bookings.updateStatus', $booking->booking_id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                    </form>

                                    <form action="{{ route('bookings.updateStatus', $booking->booking_id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                    </form>
                                @else
                                    <em>No actions available</em>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
