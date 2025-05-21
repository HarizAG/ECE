@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Branches List</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($branches as $branch)
                    <tr>
                        <td>{{ $branch->branch_id }}</td>
                        <td>{{ $branch->name }}</td>
                        <td>{{ $branch->phone }}</td>
                        <td>{{ $branch->address }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
