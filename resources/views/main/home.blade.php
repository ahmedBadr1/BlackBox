@extends('main.layouts.test')

@section('meta')
    <style media="screen">
        :root {
            --bs-blue: #0d6efd;
            --bs-indigo: #6610f2;
            --bs-purple: #7464a1;
            --bs-pink: #d63384;
            --bs-red: #a16468;
            --bs-orange: #fd7e14;
            --bs-yellow: #e4c662;
            --bs-green: #67c29c;
            --bs-teal: #64a19d;
            --bs-cyan: #1cabc4;
            --bs-white: #fff;
            --bs-gray: #6c757d;
            --bs-gray-dark: #343a40;
            --bs-gray-100: #f8f9fa;
            --bs-gray-200: #e9ecef;
            --bs-gray-300: #dee2e6;
            --bs-gray-400: #ced4da;
            --bs-gray-500: #adb5bd;
            --bs-gray-600: #6c757d;
            --bs-gray-700: #495057;
            --bs-gray-800: #343a40;
            --bs-gray-900: #212529;
            --bs-primary: #64a19d;
            --bs-secondary: #7464a1;
            --bs-success: #67c29c;
            --bs-info: #1cabc4;
            --bs-warning: #e4c662;
            --bs-danger: #a16468;
            --bs-light: #f8f9fa;
            --bs-dark: #212529;
            --bs-black: #000;
            --bs-white: #fff;
            --bs-primary-rgb: 100, 161, 157;
            --bs-secondary-rgb: 116, 100, 161;
            --bs-success-rgb: 103, 194, 156;
            --bs-info-rgb: 28, 171, 196;
            --bs-warning-rgb: 228, 198, 98;
            --bs-danger-rgb: 161, 100, 104;
            --bs-light-rgb: 248, 249, 250;
            --bs-dark-rgb: 33, 37, 41;
            --bs-black-rgb: 0, 0, 0;
            --bs-white-rgb: 255, 255, 255;
            --bs-white-rgb: 255, 255, 255;
            --bs-black-rgb: 0, 0, 0;
            --bs-body-color-rgb: 33, 37, 41;
            --bs-body-bg-rgb: 255, 255, 255;
            --bs-font-sans-serif: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
            --bs-body-font-family: Nunito, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            --bs-body-font-size: 1rem;
            --bs-body-font-weight: 400;
            --bs-body-line-height: 1.5;
            --bs-body-color: #212529;
            --bs-body-bg: #fff;
        }

        .masthead {
            position: relative;
            width: 100%;
            height: auto;
            min-height: 35rem;
            padding: 15rem 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.7) 75%, #000 100%), url("../assets/landing/bg-masthead.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-size: cover;
        }
        .masthead h1, .masthead .h1 {
            font-family: "Varela Round", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 2.5rem;
            line-height: 2.5rem;
            letter-spacing: 0.8rem;
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0));
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
            background-clip: text;
        }
        .masthead h2, .masthead .h2 {
            max-width: 20rem;
            font-size: 1rem;
        }
        @media (min-width: 768px) {
            .masthead h1, .masthead .h1 {
                font-size: 4rem;
                line-height: 4rem;
            }
        }
        @media (min-width: 992px) {
            .masthead {
                height: 100vh;
                padding: 0;
            }
            .masthead h1, .masthead .h1 {
                font-size: 6.5rem;
                line-height: 6.5rem;
                letter-spacing: 0.8rem;
            }
            .masthead h2, .masthead .h2 {
                max-width: 30rem;
                font-size: 1.25rem;
            }
        }

        .about-section {
            padding-top: 10rem;
            background: linear-gradient(to bottom, #000 0%, rgba(0, 0, 0, 0.9) 75%, rgba(0, 0, 0, 0.8) 100%);
        }
        .about-section p {
            margin-bottom: 5rem;
        }

        .projects-section {
            padding: 10rem 0;
        }
        .projects-section .featured-text {
            padding: 2rem;
        }
        @media (min-width: 992px) {
            .projects-section .featured-text {
                padding: 0 0 0 2rem;
                border-left: 0.5rem solid #64a19d;
            }
        }
        .projects-section .project-text {
            padding: 3rem;
            font-size: 90%;
        }
        @media (min-width: 992px) {
            .projects-section .project-text {
                padding: 5rem;
            }
            .projects-section .project-text hr {
                border-color: #64a19d;
                border-width: 0.25rem;
                width: 30%;
            }
        }

        .signup-section {
            padding: 10rem 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.5) 75%, #000 100%), url("../assets/landing/bg-signup.jpg");
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-size: cover;
        }
        .signup-section .form-signup input {
            box-shadow: 0 0.1875rem 0.1875rem 0 rgba(0, 0, 0, 0.1) !important;
            padding: 1.25rem 2rem;
            height: auto;
            font-family: "Varela Round", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 80%;
            text-transform: uppercase;
            letter-spacing: 0.15rem;
            border: 0;
        }

        .contact-section {
            padding-top: 5rem;
        }
        .contact-section .card {
            border: 0;
            border-bottom: 0.25rem solid #64a19d;
        }
        .contact-section .card h4, .contact-section .card .h4 {
            font-size: 0.8rem;
            font-family: "Varela Round", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            text-transform: uppercase;
            letter-spacing: 0.15rem;
        }
        .contact-section .card hr {
            border-color: #64a19d;
            border-width: 0.25rem;
            width: 3rem;
        }
        .contact-section .social {
            margin-top: 5rem;
        }
        .contact-section .social a {
            text-align: center;
            height: 3rem;
            width: 3rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 100%;
            line-height: 3rem;
            color: rgba(255, 255, 255, 0.3);
        }
        .contact-section .social a:hover {
            color: rgba(255, 255, 255, 0.5);
        }
        .contact-section .social a:active {
            color: #fff;
        }

        .bg-light {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-light-rgb), var(--bs-bg-opacity)) !important;
        }

        .bg-dark {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-dark-rgb), var(--bs-bg-opacity)) !important;
        }

        .bg-black {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-black-rgb), var(--bs-bg-opacity)) !important;
        }

        .bg-white {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-white-rgb), var(--bs-bg-opacity)) !important;
        }

        .bg-body {
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-body-bg-rgb), var(--bs-bg-opacity)) !important;
        }

        .bg-transparent {
            --bs-bg-opacity: 1;
            background-color: transparent !important;
        }

        .bg-opacity-10 {
            --bs-bg-opacity: 0.1;
        }

        .bg-opacity-25 {
            --bs-bg-opacity: 0.25;
        }

        .bg-opacity-50 {
            --bs-bg-opacity: 0.5;
        }

        .bg-opacity-75 {
            --bs-bg-opacity: 0.75;
        }

        .bg-opacity-100 {
            --bs-bg-opacity: 1;
        }

        .bg-gradient {
            background-image: var(--bs-gradient) !important;
        }
    </style>
@endsection

@section('content')
    <!-- Masthead-->
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">{{ config('app.name', 'Black box') }}</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">A scalable, responsive, powerful system for delivery companies.</h2>
                    <a class="btn btn-dark" href="{{route('track')}}">Track</a>
                </div>
            </div>
        </div>
    </header>

    <!-- About-->
    <section class="about-section text-center" id="about">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-white mb-4">The key to balancing your delivery techniques is its optimization.</h2>
                    <p class="text-white-50">
                        In order to manage your delivery system efficiently, you need software that can effectively improve your last-mile delivery, keep up with all orders on
                        <a href="{{route('track')}}">the track page.</a>
                        It’s essential to do it in the right way when it comes to managing deliveries for customers. Mishandled shipments may negatively affect a company and its reputation.
                    </p>
                </div>
            </div>
            <img class="img-fluid" src="{{url('assets/landing/ipad.png')}}" alt="..." />
        </div>
    </section>
    <!-- Projects-->
    <section class="projects-section bg-light" id="projects">
        <div class="container px-4 px-lg-5">
            <!-- Featured Project Row-->
            <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                <div class="col-xl-8 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="{{url('assets/landing/bg-masthead.jpg')}}" alt="..." /></div>
                <div class="col-xl-4 col-lg-5">
                    <div class="featured-text text-center text-lg-left">
                        <h4>improved communication with everyone</h4>
                        <p class="text-black-50 mb-0">The delivery management software is a platform that integrates all the operational units and processes. Moreover, it simplifies the communication between the sender, the logistics company, and the receiver of the consignment.!</p>
                    </div>
                </div>
            </div>
            <!-- Project One Row-->
            <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="{{url('assets/landing/demo-image-01.jpg')}}" alt="..." /></div>
                <div class="col-lg-6">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-left">
                                <h4 class="text-white">Track any asset, anywhere.</h4>
                                <p class="mb-0 text-white-50">Stop calling your team while on the road, asking them for their location and status updates.</p>
                                <hr class="d-none d-lg-block mb-0 ms-0" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Two Row-->
            <div class="row gx-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="{{url('assets/landing/demo-image-02.jpg')}}" alt="..." /></div>
                <div class="col-lg-6 order-lg-first">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-right">
                                <h4 class="text-white">satisfy your client needs</h4>
                                <p class="mb-0 text-white-50">You need a system to organize your customer's bookings, throw away the spreadsheets, paper and whiteboards.</p>
                                <hr class="d-none d-lg-block mb-0 me-0" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Signup-->
    <section class="signup-section" id="signup">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-10 col-lg-8 mx-auto text-center">
                    <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                    <h2 class="text-white mb-5">Subscribe to receive updates!</h2>
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- * * SB Forms Contact Form * *-->
                    <!-- * * * * * * * * * * * * * * *-->
                    <!-- This form is pre-integrated with SB Forms.-->
                    <!-- To make this form functional, sign up at-->
                    <!-- https://startbootstrap.com/solution/contact-forms-->
                    <!-- to get an API token!-->
                    <form class="form-signup" id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <!-- Email address input-->
                        <div class="row input-group-newsletter">
                            <div class="col"><input class="form-control" id="emailAddress" type="email" placeholder="Enter email address..." aria-label="Enter email address..." data-sb-validations="required,email" /></div>
                            <div class="col-auto"><button class="btn btn-dark " id="submitButton" type="submit">Notify Me!</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact-->
    <section class="contact-section bg-black">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marked-alt text-black mb-2"></i>
                            <h4 class="text-uppercase m-0">@lang('auth.address')</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">Nasr city, Cairo, Egypt</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-black mb-2"></i>
                            <h4 class="text-uppercase m-0">@lang('auth.email')</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50"><a href="#!">admin@blackbox.host</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt text-black mb-2"></i>
                            <h4 class="text-uppercase m-0">@lang('auth.phone')</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">01098281638</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social d-flex justify-content-center">
                <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                <a class="mx-2" href="https://github.com/Feedbackwe4u"><i class="fab fa-github"></i></a>
            </div>
        </div>
    </section>


@endsection

@section('script')
    <script type="javascript">
        window.addEventListener('DOMContentLoaded', event => {

            // Navbar shrink function
            var navbarShrink = function () {
                const navbarCollapsible = document.body.querySelector('#mainNav');
                if (!navbarCollapsible) {
                    return;
                }
                if (window.scrollY === 0) {
                    navbarCollapsible.classList.remove('navbar-shrink')
                } else {
                    navbarCollapsible.classList.add('navbar-shrink')
                }

            };

            // Shrink the navbar
            navbarShrink();

            // Shrink the navbar when page is scrolled
            document.addEventListener('scroll', navbarShrink);

            // Activate Bootstrap scrollspy on the main nav element
            const mainNav = document.body.querySelector('#mainNav');
            if (mainNav) {
                new bootstrap.ScrollSpy(document.body, {
                    target: '#mainNav',
                    offset: 74,
                });
            };

            // Collapse responsive navbar when toggler is visible
            const navbarToggler = document.body.querySelector('.navbar-toggler');
            const responsiveNavItems = [].slice.call(
                document.querySelectorAll('#navbarResponsive .nav-link')
            );
            responsiveNavItems.map(function (responsiveNavItem) {
                responsiveNavItem.addEventListener('click', () => {
                    if (window.getComputedStyle(navbarToggler).display !== 'none') {
                        navbarToggler.click();
                    }
                });
            });

        });
    </script>
@endsection
