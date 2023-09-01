<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>VirtualCareerExpo</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    </head>
    
    <body>
        
    
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->
    
    
    @include('layout.nav')

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="{{ asset('images/video.mp4') }}" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>Lorem ipsum dolor sit amet</h6>
                <h2>Find the perfect <em>Job</em></h2>
                <div class="main-button">
                    <a href="/employer/dashboard">Post Job</a>
                    <a href="/jobs">Find Job</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->



    <section class="section section-bg" id="schedule" style="background-image: url({{ asset('images/about-fullscreen-1-1920x700.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading dark-bg">
                        <h2>Read <em>About Us</em></h2>
                        <img src="{{ asset('images/line-dec.png') }}" alt="">
                        <p>"Unlock Your Future: Connect, Explore, and Excel with VirtualCareerExpo!"</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="cta-content text-center">
                        <p>The Virtual Career Expo is a user-friendly, efficient, and inclusive platform that connects job seekers and employers in a virtual environment. It aims to simplify the job search process, enhance employer branding, and facilitate seamless communication between all parties involved. Job seekers can explore various industries and sectors, access detailed job descriptions, and submit applications directly. Employers can showcase their organizations, highlight company culture, and promote job openings through a virtual booth feature. The platform prioritizes user experience, data security, and privacy, and is built using the Laravel framework.</p>

                        <p>The dedicated team is constantly working to enhance the platform, introduce new features, and provide ongoing support. Join the Virtual Career Expo and unlock new opportunities and shape the future of recruitment.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    
    
    <!-- ***** Footer Start ***** -->
    @include('layout.footer')

    <!-- jQuery -->
    <script src="{{ asset('js/jquery-2.1.0.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/imgfix.min.js') }}"></script> 
    <script src="{{ asset('js/mixitup.js') }}"></script> 
    <script src="{{ asset('js/accordions.js') }}"></script>
    
    <!-- Global Init -->
    <script src="{{ asset('js/custom.js') }}"></script>

  </body>
</html>