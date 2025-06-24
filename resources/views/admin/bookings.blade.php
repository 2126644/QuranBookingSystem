@extends('layouts.app')
@section('content')
<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Bookings List for user {{ $user->name }}</h2>
        </div>

        <br>
        <div class="col-md-12">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">
                            <center>Number</center>
                        </th>
                        <th>
                            <center>Session Day</center>
                        </th>
                        <th width="30%">
                            <center>Session Time</center>
                        </th>
                        <th width="10%">
                            <center>Class Type</center>
                        </th>
                        <th width="10%">
                            <center>Session Type</center>
                        </th>
                        <th width="10%">
                            <center>Study Level</center>
                        </th>
                        <th width="10%">
                            <center>Additional Info</center>
                        </th>
                        <th width="14%">
                            <center>Action</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $booking->session_day }}</td>
                        <td class="text-center">{{ $booking->session_time }}</td>
                        <td class="text-center">{{ $booking->class_type }}</td>
                        <td class="text-center">{{ $booking->session_type }}</td>
                        <td class="text-center">{{ $booking->study_level }}</td>
                        <td class="text-center">{{ $booking->additional_info }}</td>
                        <td class="text-center">
                            <a href="{{ route('booking.edit', $booking) }}"
                                class="btn btn-warning btn-sm">
                                Edit
                            </a>
                            <form action="{{ route('booking.destroy', $booking)}}" method="POST"
                                style="display:inline"
                                onsubmit="return confirm('Delete this booking?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <center>No booking found for this user.</center>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection