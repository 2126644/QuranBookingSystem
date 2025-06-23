<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>i-Iqra' - Booking Form</title>
        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,400;0,600;0,700;1,200;1,700&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/vegas.min.css" rel="stylesheet">

        <link href="css/tooplate-barista.css" rel="stylesheet">

<!--

Tooplate 2137 Barista

https://www.tooplate.com/view/2137-barista-cafe

Bootstrap 5 HTML CSS Template

-->
   </head>

   <body class="reservation-page">
    <main>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                    <img src="images/logo.png" class="navbar-brand-image img-fluid" alt="Barista Cafe Template">
                    i-Iqra'
                </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-lg-auto">
                                <li class="nav-item">
                                    <a class="nav-link click-scroll" href="/home#section_1">Home</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link click-scroll" href="/home#section_2">About</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link click-scroll" href="/home#section_3">Classes</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link click-scroll" href="/home#section_4">Feedback</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link click-scroll" href="/home#section_5">Contact</a>
                                </li>

                                <li class="nav-item">
                                    @if (Route::has('login'))
                                        <nav class="nav-item">
                                            @auth
                                                <a
                                                    href="{{ url('/dashboard') }}"
                                                    class="nav-link"
                                                >
                                                    Dashboard
                                                </a>
                                            @else
                                                <a
                                                    href="{{ route('login') }}"
                                                    class="nav-link"
                                                >
                                                    Log in
                                                </a>

                                                @if (Route::has('register'))
                                                    <a
                                                        href="{{ route('register') }}"
                                                        class="nav-link"
                                                    >
                                                        Register
                                                    </a>
                                                @endif
                                            @endauth
                                        </nav>
                                    @endif

                                </li>
                            </ul>

                            <div class="ms-lg-3">
                                <a class="btn custom-btn custom-border-btn" href="{{ route('frontend.bview') }}">
                                    Book Now
                                    <i class="bi-arrow-up-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>


                <section class="booking-section section-padding">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-12 mx-auto">
                                <div class="booking-form-wrap">
                                    <div class="row">
                                        <div class="col-lg-7 col-12 p-0">
                                            <form class="custom-form booking-form" action="{{ route('bookings.store') }}" method="post" role="form">
                                                @csrf
                                                <div class="text-center mb-4 pb-lg-2">
                                                    <em class="text-white">Fill out the booking form</em>
                                                    <h2 class="text-white">Book a class</h2>
                                                </div>

                                                <div class="booking-form-body">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-12">
                                                            <input type="text" name="booking-form-name" id="booking-form-name" class="form-control" placeholder="Full Name"
                                                            oninput="this.value = this.value.replace(/[^a-zA-Z\s']/g, '')" class="w-full p-2 border border-gray-300 rounded" required>
                                                        </div>

                                                        <div class="col-lg-6 col-12">
                                                            <input type="email" class="form-control" name="booking-form-email" placeholder="Email" required>
                                                        </div>

                                                        <div class="col-lg-12 col-12">
                                                            <input type="tel" class="form-control" name="booking-form-phone" placeholder="Phone" required>
                                                        </div>

                                                        <div class="col-lg-6 col-12">
                                                            <select name="session-day" id="session-day" class="form-control" required>
                                                                <option value="" disabled selected>Day</option>
                                                                <option value="Monday">Monday</option>
                                                                <option value="Tuesday">Tuesday</option>
                                                                <option value="Wednesday">Wednesday</option>
                                                                <option value="Thursday">Thursday</option>
                                                                <option value="Friday">Friday</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-lg-6 col-12">
                                                            <select name="session-time" id="session-time" class="form-control" required>
                                                                <option value="" disabled selected>Time / Tutor</option>
                                                                <option value="9am - 10am with Ustaz Muazzam">9 am - 10 am | Ustaz Muazzam</option>
                                                                <option value="2pm - 3pm with Ustazah Hanum">2 pm - 3 pm | Ustazah Hanum</option>
                                                                <option value="5pm - 6pm with Ustaz Zaid Muhammad">5 pm - 6 pm | Ustaz Zaid Muhammad</option>
                                                                <option value="8pm - 9pm with Ustazah Ain Lily">8 pm - 9 pm | Ustazah Ain Lily</option>
                                                            </select>
                                                        </div>

                                                        <!-- Session Information -->
                                                        <div class="col-lg-12 col-12">
                                                            <div class="text-center mb-4 pb-lg-2">
                                                               <h2 class="text-white">Session Info</h2>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-12">
                                                                    <select name="class-type" id="class-type" class="form-control" required>
                                                                        <option value="" disabled selected>Class Type</option>
                                                                        <option value="iqra">Iqra'</option>
                                                                        <option value="quran">Al-Quran</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-6 col-12">
                                                                    <select name="session-type" id="session-type" class="form-control" required>
                                                                        <option value="" disabled selected>Session Platform</option>
                                                                        <option value="online">Online</option>
                                                                        <option value="in-person">In-person</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 col-12">
                                                            <div class="col-lg-12 col-12">
                                                                <select name="study-level" id="study-level" class="form-control" required>
                                                                    <option value="" disabled selected>Level of Study</option>
                                                                    <option value="beginner">Beginner</option>
                                                                    <option value="intermediate">Intermediate</option>
                                                                    <option value="advanced">Advanced</option>
                                                                </select>
                                                            </div>

                                                            <textarea name="booking-form-message" rows="3" class="form-control" id="booking-form-message" placeholder="Additional Information (Optional)"
                                                            oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s.,!?'\&quot;-]/g, '')"></textarea>
                                                        </div>

                                                        <div class="col-lg-4 col-md-10 col-8 mx-auto mt-2">
                                                            <button type="submit" class="form-control">Submit</button>
                                                        </div>

                                                        @if(session('success'))
                                                            <div class="alert alert-success">
                                                                {{ session('success') }}
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                                    <div class="col-lg-5 col-12 p-0">
                                        <div class="booking-form-image-wrap">

                                            <img src="images/siblings-reading-quran.png" class="booking-form-image img-fluid" alt="">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                <footer class="site-footer">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-4 col-12 me-auto">
                                <em class="text-white d-block mb-4">Where to find us?</em>

                                <strong class="text-white">
                                    <i class="bi-geo-alt me-2"></i>
                                    IIUM
                                </strong>

                                <ul class="social-icon mt-4">
                                    <li class="social-icon-item">
                                        <a href="#" class="social-icon-link bi-facebook">
                                        </a>
                                    </li>

                                    <li class="social-icon-item">
                                        <a href="https://x.com/minthu" target="_new" class="social-icon-link bi-twitter">
                                        </a>
                                    </li>

                                    <li class="social-icon-item">
                                        <a href="#" class="social-icon-link bi-whatsapp">
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-lg-3 col-12 mt-4 mb-3 mt-lg-0 mb-lg-0">
                                <em class="text-white d-block mb-4">Contact</em>

                                <p class="d-flex mb-1">
                                    <strong class="me-2">Phone:</strong>
                                    <a href="tel: 305-240-9671" class="site-footer-link">
                                        (60)
                                        18 3120 076
                                    </a>
                                </p>

                                <p class="d-flex">
                                    <strong class="me-2">Email:</strong>

                                    <a href="mailto:info@yourgmail.com" class="site-footer-link">
                                        hello@quran.co
                                    </a>
                                </p>
                            </div>


                            <div class="col-lg-5 col-12">
                                <em class="text-white d-block mb-4">Opening Hours.</em>

                                <ul class="opening-hours-list">
                                    <li class="d-flex">
                                        Monday - Friday
                                        <span class="underline"></span>

                                        <strong>9:00 - 18:00</strong>
                                    </li>

                                    <li class="d-flex">
                                        Saturday
                                        <span class="underline"></span>

                                        <strong>11:00 - 16:30</strong>
                                    </li>

                                    <li class="d-flex">
                                        Sunday
                                        <span class="underline"></span>

                                        <strong>Closed</strong>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-lg-8 col-12 mt-4">
                                <p class="copyright-text mb-0">Copyright © i-Iqra' 2024
                                    - Design: <a rel="sponsored" href="https://www.tooplate.com" target="_blank">Tooplate</a></p>
                            </div>

                    </div>
                </footer>
            </main>


        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/vegas.min.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
