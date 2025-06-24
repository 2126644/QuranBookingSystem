<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title>Quran Booking System</title>

        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

        <!-- CSS FILES -->
        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,400;0,600;0,700;1,200;1,700&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/vegas.min.css" rel="stylesheet">

        <link href="css/tooplate-barista.css" rel="stylesheet">

<!--

Tooplate 2137 Barista Cafe

https://www.tooplate.com/view/2137-barista-cafe

Bootstrap 5 HTML CSS Template

-->
    </head>

    <body>
        <main>
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                        <img src="images/logo.png" class="navbar-brand-image img-fluid">
                        i-Iqra'
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-lg-auto">
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_1">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_2">About</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_3">Classes</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_4">Feedback</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#section_5">Contact</a>
                            </li>

                            <li class="nav-item">
                                @if (Route::has('student.login'))
                                    <nav class="nav-item">
                                        @auth
                                            <a href="{{ route('student.dashboard') }}" class="nav-link">
                                                Dashboard
                                            </a>
                                        @else
                                            <a href="{{ route('student.login') }}" class="nav-link">
                                                Log in
                                            </a>

                                            @if (Route::has('student.register'))
                                                <a href="{{ route('student.register') }}" class="nav-link">
                                                    Register
                                                </a>
                                            @endif
                                        @endauth
                                    </nav>
                                @endif
                            </li>
                            </ul>

                            <div class="ms-lg-3">
                                <a class="btn custom-btn custom-border-btn" href="{{ route('booking.add') }}">
                                    Book Now
                                    <i class="bi-arrow-up-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>


                <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">

                    <div class="container">
                        <div class="row align-items-center">

                            <div class="col-lg-6 col-12 mx-auto">
                                <em class="small-text">Welcome to No 1 Online Quran Learning Centre:</em>

                                <h1>i-Iqra' Academy</h1>

                                <p class="text-white mb-4 pb-lg-2">
                                    Embrace the Light of the Quran
                                </p>

                                <a class="btn custom-btn custom-border-btn smoothscroll me-3" href="#section_2">
                                    Our Story
                                </a>

                                <a class="btn custom-btn smoothscroll me-2 mb-2" href="#section_3"><strong>See Classes Offered</strong></a>
                            </div>

                        </div>
                    </div>

                    <div class="hero-slides"></div>
                </section>


                <section class="about-section section-padding" id="section_2">
                    <div class="section-overlay"></div>
                    <div class="container">
                        <div class="row align-items-center">

                            <div class="col-lg-6 col-12">
                                <div class="ratio ratio-1x1">
                                    <img src="{{ asset('images/quran2.jpg') }}" alt="Quran Image" class="custom-image" style="object-fit: cover; width: 100%; height: 100%;">

                                    <div class="about-image-info d-flex flex-column">
                                        <h4 class="mt-auto">اقرأ، تدبر، أشرق</h4>
                                        <h4>Recite, Reflect, Enlighten</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5 col-12 mt-4 mt-lg-0 mx-auto">
                                <em class="text-white">Get to Know Us</em>

                                <h2 class="text-white mb-3">i-Iqra' Academy</h2>

                                <p class="text-white">i-Iqra' Academy is a teaching institution that guides learners of all ages on a transformative journey through the Quran's divine teachings.</p>

                                <p class="text-white">With expert instructors, the academy caters to both beginners and older learners, offering comprehensive and enriching learning experiences. </p>

                                <p class="text-white"> Join a community dedicated to spiritual growth and enlightenment.</p>

                                <a href="#barista-team" class="smoothscroll btn custom-btn custom-border-btn mt-3 mb-4">Meet the Instructors</a>
                            </div>

                        </div>
                    </div>
                </section>


                <section class="barista-section section-padding section-bg" id="barista-team">
                    <div class="container">
                        <div class="row justify-content-center">

                            <div class="col-lg-12 col-12 text-center mb-4 pb-lg-2">
                                <em class="text-white">Get to Know Our Team</em>

                                <h2 class="text-white">Meet Our Asatizah</h2>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12 mb-4">
                                <div class="team-block-wrap">
                                    <div class="team-block-info d-flex flex-column">
                                        <div class="d-flex mt-auto mb-3">
                                            <h4 class="text-white mb-0">Ustaz Muazzam</h4>

                                            <p class="badge ms-4"><em>Founder</em></p>
                                        </div>

                                        <p class="text-white mb-0">5 years of experience as Arabic Language teacher.</p>
                                    </div>

                                    <div class="team-block-image-wrap">
                                        <img src="images/team/ustzsa'id.png" class="team-block-image img-fluid" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12 mb-4">
                                <div class="team-block-wrap">
                                    <div class="team-block-info d-flex flex-column">
                                        <div class="d-flex mt-auto mb-3">
                                            <h4 class="text-white mb-0">Ustazah Hanum</h4>

                                            <p class="badge ms-4"><em>Tutor</em></p>
                                        </div>

                                        <p class="text-white mb-0">Currently as a lecturer at IIUM in Usul Fiqh for 6 years.</p>
                                    </div>

                                    <div class="team-block-image-wrap">
                                        <img src="images/team/ustzhhanum.png" class="team-block-image img-fluid" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12 mb-4">
                                <div class="team-block-wrap">
                                    <div class="team-block-info d-flex flex-column">
                                        <div class="d-flex mt-auto mb-3">
                                            <h4 class="text-white mb-0">Ustaz Zaid Muhammad</h4>

                                            <p class="badge ms-4"><em>Tutor</em></p>
                                        </div>

                                        <p class="text-white mb-0">5 years experience of teaching Islamic Studies and Arabic.</p>
                                    </div>

                                    <div class="team-block-image-wrap">
                                        <img src="images/team/ustzzaid.png" class="team-block-image img-fluid" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="team-block-wrap">
                                    <div class="team-block-info d-flex flex-column">
                                        <div class="d-flex mt-auto mb-3">
                                            <h4 class="text-white mb-0">Ustazah Ain Lily</h4>

                                            <p class="badge ms-4"><em>Tutor</em></p>
                                        </div>

                                        <p class="text-white mb-0">Currently a lecturer at IIUM in Qur'an Sunnah for 4 years.</p>
                                    </div>

                                    <div class="team-block-image-wrap">
                                        <img src="images/team/ustzhlily.png" class="team-block-image img-fluid" alt="">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                <section class="menu-section section-padding" id="section_3">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-6 col-12 mb-4 mb-lg-0">
                                <div class="menu-block-wrap">
                                    <div class="text-center mb-4 pb-lg-2">
                                        <em class="text-white">Class Info</em>
                                        <h4 class="text-white">Iqra' Class</h4>
                                    </div>

                                    <div class="menu-block">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6>Monday</h6>
                                            <span class="underline flex-grow-1 mx-3"></span>
                                            <div class="text-right">
                                                <strong class="d-block">9am - 10am</strong>
                                                <small>Ustaz Muazzam</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="menu-block my-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6>Tuesday</h6>
                                            <span class="underline flex-grow-1 mx-3"></span>
                                            <div class="text-right">
                                                <strong class="d-block">2pm - 3pm</strong>
                                                <small>Ustazah Hanum</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="menu-block">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6>Wednesday</h6>
                                            <span class="underline flex-grow-1 mx-3"></span>
                                            <div class="text-right">
                                                <strong class="d-block">5pm - 6pm</strong>
                                                <small>Ustaz Zaid Muhammad</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="menu-block my-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6>Thursday</h6>
                                            <span class="underline flex-grow-1 mx-3"></span>
                                            <div class="text-right">
                                                <strong class="d-block">8pm - 9pm</strong>
                                                <small>Ustazah Ain Lily</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="menu-block">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6>Friday</h6>
                                            <span class="underline flex-grow-1 mx-3"></span>
                                            <div class="text-right">
                                                <strong class="d-block">9am - 10am</strong>
                                                <small>Ustaz Muazzam</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="menu-block-wrap">
                                    <div class="text-center mb-4 pb-lg-2">
                                        <em class="text-white">Class Info</em>
                                        <h4 class="text-white">Quran Class</h4>
                                    </div>

                                    <div class="menu-block">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6>Monday</h6>
                                            <span class="underline flex-grow-1 mx-3"></span>
                                            <div class="text-right">
                                                <strong class="d-block">9am - 10am</strong>
                                                <small>Ustaz Muazzam</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="menu-block my-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6>Tuesday</h6>
                                            <span class="underline flex-grow-1 mx-3"></span>
                                            <div class="text-right">
                                                <strong class="d-block">2pm - 3pm</strong>
                                                <small>Ustazah Hanum</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="menu-block">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6>Wednesday</h6>
                                            <span class="underline flex-grow-1 mx-3"></span>
                                            <div class="text-right">
                                                <strong class="d-block">5pm - 6pm</strong>
                                                <small>Ustaz Zaid Muhammad</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="menu-block my-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6>Thursday</h6>
                                            <span class="underline flex-grow-1 mx-3"></span>
                                            <div class="text-right">
                                                <strong class="d-block">8pm - 9pm</strong>
                                                <small>Ustazah Ain Lily</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="menu-block">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6>Friday</h6>
                                            <span class="underline flex-grow-1 mx-3"></span>
                                            <div class="text-right">
                                                <strong class="d-block">9am - 10am</strong>
                                                <small>Ustaz Muazzam</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>



                <section class="reviews-section section-padding section-bg" id="section_4">
                    <div class="container">
                        <div class="row justify-content-center">

                            <div class="col-lg-12 col-12 text-center mb-4 pb-lg-2">
                                <em class="text-white">Reviews by Customers</em>

                                <h2 class="text-white">Feedbacks</h2>
                            </div>

                            <div class="timeline">
                                <div class="timeline-container timeline-container-left">
                                    <div class="timeline-content">
                                        <div class="reviews-block">
                                            <div class="reviews-block-image-wrap d-flex align-items-center">
                                                <img src="images/reviews/cust1.jpg" class="reviews-block-image img-fluid" alt="">

                                                <div class="">
                                                    <h6 class="text-white mb-0">Nur Laila Majnun</h6>
                                                    <em class="text-white"> from Kedah, Malaysia</em>
                                                </div>
                                            </div>

                                            <div class="reviews-block-info">
                                                <p>Sangat sesuai untuk semua peringkat umur dan guru-gurunya sangat penyabar! Saya daftarkan nenek saya untuk bersama-sama belajar mengaji dan kami banyak belajar tentang al-Quran.</p>
                                                <div class="d-flex border-top pt-3 mt-4">
                                                    <strong class="text-white">4.5 <small class="ms-2">Rating</small></strong>

                                                    <div class="reviews-group ms-auto">
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-container timeline-container-right">
                                    <div class="timeline-content">
                                        <div class="reviews-block">
                                            <div class="reviews-block-image-wrap d-flex align-items-center">
                                                <img src="images/reviews/cust2.jpeg" class="reviews-block-image img-fluid" alt="">

                                                <div class="">
                                                    <h6 class="text-white mb-0">Ahmad Syauqi</h6>
                                                    <em class="text-white"> from Kelantan, Malaysia</em>
                                                </div>
                                            </div>

                                            <div class="reviews-block-info">
                                                <p>I joined as a complete beginner, and now I can read the Quran with confidence. The supportive community and expert guidance made all the difference. Very convenience for the learners as we can set our schedule and learn easily through online platform online.</p>

                                                <div class="d-flex border-top pt-3 mt-4">
                                                    <strong class="text-white">4.5 <small class="ms-2">Rating</small></strong>

                                                    <div class="reviews-group ms-auto">
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-container timeline-container-left">
                                    <div class="timeline-content">
                                        <div class="reviews-block">
                                            <div class="reviews-block-image-wrap d-flex align-items-center">
                                                <img src="images/reviews/cust3.jpeg" class="reviews-block-image img-fluid" alt="">

                                                <div class="">
                                                    <h6 class="text-white mb-0">Sandra Park</h6>
                                                    <em class="text-white"> from Sarawak, Malaysia</em>
                                                </div>
                                            </div>

                                            <div class="reviews-block-info">
                                                <p>Learning with i-Iqra' has been a transformative experience for me. The instructors are incredibly patient and knowledgeable. I have learned so much in such a short time.</p>
                                                <div class="d-flex border-top pt-3 mt-4">
                                                    <strong class="text-white">4.5 <small class="ms-2">Rating</small></strong>

                                                    <div class="reviews-group ms-auto">
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star-fill"></i>
                                                        <i class="bi-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>


                <section class="contact-section section-padding" id="section_5">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-12 col-12">
                                <em class="text-white">Say Hello</em>
                                <h2 class="text-white mb-4 pb-lg-2">Contact</h2>
                            </div>

                            <div class="col-lg-6 col-12">
                                <form action="#" method="post" class="custom-form contact-form" role="form">

                                <div class="row">

                                    <div class="col-lg-6 col-12">
                                        <label for="name" class="form-label">Name <sup class="text-danger">*</sup></label>

                                        <input type="text" name="name" id="name" class="form-control" placeholder="Jackson" required="">
                                    </div>

                                    <div class="col-lg-6 col-12">
                                        <label for="email" class="form-label">Email Address</label>

                                        <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Jack@gmail.com" required="">
                                    </div>

                                    <div class="col-12">
                                        <label for="message" class="form-label">How can we help?</label>

                                        <textarea name="message" rows="4" class="form-control" id="message" placeholder="Message" required=""></textarea>

                                    </div>
                                </div>

                                <div class="col-lg-5 col-12 mx-auto mt-3">
                                    <button type="submit" class="form-control">Send Message</button>
                                </div>
                            </form>
                            </div>

                            <div class="col-lg-6 col-12 mx-auto mt-5 mt-lg-0 ps-lg-5">
                                <iframe class="google-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5039.668141741662!2d72.81814769288509!3d19.043340656729775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c994f34a7355%3A0x2680d63a6f7e33c2!2sLover%20Point!5e1!3m2!1sen!2sth!4v1692722771770!5m2!1sen!2sth" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                                        18 312 0076
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
        <script src="js/click-scroll.js"></script>
        <script src="js/vegas.min.js"></script>
        <script src="js/custom.js"></script>

    </body>
</html>
