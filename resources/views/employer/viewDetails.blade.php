<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Applicant details</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .user-details {
            text-align: center;
            padding: 20px;
        }

        .user-info {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
  </head>
  <body>
    
    @include('employer.nav_emp')

    <section class="section section-bg" id="call-to-action" style="background-image: url({{ asset('images/banner-image-1-1920x500.jpg') }})">
      <div class="container">
          <div class="row">
              <div class="col-lg-10  offset-lg-1">
                  <div class="cta-content">
                      <br>
                      <br>
                      <h2>APPLICANT <em> DETAILS</em></h2>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <div class="user-details">
    <h1>User Details</h1>
    <div class="user-info">
        <p><strong>Name:</strong> {{ $user->firstName }} {{ $user->lastName }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone:</strong> {{ $user->phone }}</p>
        <p><strong>Address:</strong> {{ $user->address }}</p>
        <p><strong>Skills:</strong> {{ $user->skills }}</p>
        <p><strong>Experience:</strong> {{ $user->experience }}</p>
        <p><strong>Education:</strong> {{ $user->education }}</p>
        @if ($user->resume_path != "Resume is not attached")
            <p><strong>Resume:</strong> <a href="{{ asset('storage/' . $user->resume_path) }}" target="_blank">View Resume</a></p>
        @else
            <p><strong>Resume:</strong> {{ $user->resume_path }}</p>
        @endif
    </div>
</div>
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