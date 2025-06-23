<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function showAddClassForm()
    {
        return view('frontend.bview');
    }

    public function index()
    {
        //return view('frontend.home'); next page
        //return view('booking');
        $bookings = Booking::orderBy('class_type','asc')->get();
        return view ('booking',['bookings'=>$bookings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'booking-form-name' => ['required','regex:/^[a-zA-Z\s\'-]+$/', 'max:255'], //Full Name
        'booking-form-email' => ['required', 'email', 'max:50'], //Email
        'booking-form-phone' => ['required', 'regex:/^01[0-9]-?[0-9]{7,8}$/'], //Phone
        'session-day' => ['required', 'in:Monday, Tuesday, Wednesday, Thursday, Friday'], //Day
        'session-time' => ['required', 'in:9am - 10am with Ustaz Muazzam, 2pm - 3pm with Ustazah Hanum, 5pm - 6pm with Ustaz Zaid Muhammad, 8pm - 9pm with Ustazah Ain Lily'], //Time/Tutor
        'class-type' => ['required', 'in:Iqra, Quran'], //Class Type
        'session-type' => ['required', 'in:Online, In-Person'], //Session Platform
        'study-level' => ['required', 'in:Beginner, Intermediate, Advanced'], //Level of Study
        'booking-form-message' => ['nullable', 'regex:/^[a-zA-Z0-9\s.,!?\'"-]*$/', 'max:1000'], //Additional Info
    ]);

    // Create a new booking instance and save to the database
    $booking = new Booking();
    $booking->full_name = $request->input('booking-form-name');
    $booking->email = $request->input('booking-form-email');
    $booking->phone = $request->input('booking-form-phone');
    $booking->session_day = $request->input('session-day');
    $booking->session_time = $request->input('session-time');
    $booking->class_type = $request->input('class-type');
    $booking->session_type = $request->input('session-type');
    $booking->study_level = $request->input('study-level');
    $booking->additional_info = $request->input('booking-form-message', '');
    $booking->save();

    // Redirect or return a response
    return redirect()->route('frontend.bview')->with('success', 'Booking successfully created.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    //Drop Class
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('dashboard')->with('success', 'Class deleted successfully');
    }



}

//run
