@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Customers') }}</div>
                    <div class="card-body text-center">
                        <h1>WELCOME TO EASY CAR ENTERPRISE</h1>
                        <h4>Where it is easy to rent cars</h4>

                        <p>
                            <a href="{{ url('/cars') }}">
                                <h4>VIEW CARS</h4>
                            </a>
                            <a href="{{ url('/branches') }}">
                                <h4>VIEW OUR LOCATIONS</h4>
                            </a>
                            <a href="{{ url('/bookings') }}">
                                <h4>VIEW BOOKINGS</h4>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
