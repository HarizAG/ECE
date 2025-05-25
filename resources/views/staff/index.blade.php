@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Customers') }}</div>
                    <div class="card-body text-center">
                        <h1>STAFF SCREEN EASY CAR ENTERPRISE</h1>
                        <h4>Manage customer bookings and cars</h4>

                        <p>
                            <a href="{{ url('/cars') }}">
                                <h4>MANAGE CARS</h4>
                            </a>
                            <a href="{{ route('bookings.manage') }}">
                                <h4>MANAGE BOOKINGS</h4>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
