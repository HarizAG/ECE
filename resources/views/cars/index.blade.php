@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Cars List</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Car</th>
                    <th>Brand</th>
                    <th>Type</th>
                    <th>Transmission</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $car->car_id }}</td>
                        <td>{{ $car->car_name }}</td>
                        <td>{{ $car->brand }}</td>
                        <td>{{ $car->type }}</td>
                        <td>{{ $car->transmission }}</td>
                        <td>
                            <a href="{{ route('bookings.create', ['car_id' => $car->car_id]) }}"
                                class="btn btn-success">Book</a>
                            @if (Auth::check() && Auth::user()->role == 'staff' && Auth::user()->staff->branch_id == $car->branch_id)
                                <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
