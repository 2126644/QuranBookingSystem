<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // block inactive accounts
        $this->middleware(function($request, $next) {
            if (! Auth::user()->status) {
                abort(403, 'Your account has been deactivated.');
            }
            return $next($request);
        });
    }

    public function showAddClassForm()
    {
        return view('frontend.bview');
    }

    public function index()
    {
        $userId = Auth::user()->id;
        $bookings = Booking::where(['user_id' => $userId])->get();
        return view('dashboard', ['bookings' => $bookings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('booking.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'session_day' => ['required', 'in:Monday, Tuesday, Wednesday, Thursday, Friday'], //Day
        'session_time' => ['required', 'in:9am - 10am with Ustaz Muazzam, 2pm - 3pm with Ustazah Hanum, 5pm - 6pm with Ustaz Zaid Muhammad, 8pm - 9pm with Ustazah Ain Lily'], //Time/Tutor
        'class_type' => ['required', 'in:Iqra, Al-Quran'], //Class Type
        'session_type' => ['required', 'in:Online, In-Person'], //Session Platform
        'study_level' => ['required', 'in:Beginner, Intermediate, Advanced'], //Level of Study
        'additional_info' => ['nullable', 'regex:/^[a-zA-Z0-9\s.,!?\'"-]*$/', 'max:1000'], //Additional Info
    ]);

    // Create a new booking instance and save to the database
    $booking = Booking::create([
    'user_id' => Auth::user()->user_id,
    'session_day' => $request->input('session_day'),
    'session_time' => $request->input('session_time'),
    'class_type' => $request->input('class_type'),
    'session_type' => $request->input('session_type'),
    'study_level' => $request->input('study_level'),
    'additional_info' => $request->input('additional_info', ''),
]);

    // Redirect or return a response
    return redirect()->route('student.dashboard')->with('success', 'Booking successfully created.');
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
    public function destroy($booking_id)
    {
        $booking = Booking::findOrFail($booking_id);
        $booking->delete();

        return redirect()->route('student.dashboard')->with('success', 'Class deleted successfully');
    }

}
