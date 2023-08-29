<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post Jobs</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
</head>
  <body>
    
    @include('layout.nav')

    <section class="section section-bg" id="call-to-action" style="background-image: url({{ asset('images/banner-image-1-1920x500.jpg') }})">
      <div class="container">
          <div class="row">
              <div class="col-lg-10  offset-lg-1">
                  <div class="cta-content">
                      <br>
                      <br>
                      <h2>VIEW <em> JOB DETAILS</em></h2>
                      <p>Lorem ipsum dolor sit amet consectetur.</p>
                  </div>
              </div>
          </div>
      </div>
  </section>
  

  <div class="container mt-4">
    @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                <b><p>{{ Session::get('success') }}</p></b>
              </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-warning" role="alert">
                <b><p>{{ Session::get('error') }}</p></b>
              </div>
        @endif
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $job->job_title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $job->company_name }}</h6>
            <p class="card-subtitle mb-2 text-muted"><b>Estimated Salary: </b>{{ $job->salary }} {{ $job->salary_type }}</p>
            <p class="card-subtitle mb-2 text-muted"><b>Location: </b>{{ $job->location }}</p>
            <p class="card-text"><b>Job Type:</b>
              @if ($job->job_type == 'full_time')
                Full Time
              @elseif ($job->job_type == 'part_time')
                Part Time 
              @else
                Contract
              @endif</p>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-muted"><b>Description</b></h6>
            <p class="card-text">{{ $job->job_description }}</p>
            <p class="card-text mt-4"><b>Required Skills:</b> {{ $job->required_skills }}</p>
            <a href="{{ route('applyJob', ['id' => $job->id]) }}" class="btn btn-primary">Apply Now</a>
            <button class="btn btn-secondary" onclick="goBack()">Go Back</button>
        </div>
    </div>
  </div>

  <script>
    function goBack() {
        window.history.back();
    }
  </script>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery-2.1.0.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

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