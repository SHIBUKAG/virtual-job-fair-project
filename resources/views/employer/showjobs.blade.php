<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Job</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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
                        <h2>Manage <em> JOB</em></h2>
                        <p>Easily manage job posted opportunities to attract potential candidates and grow your team.</p>
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

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-4 mv-4">
            @foreach($postedJobs as $job)
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $job->job_title }}</h5>
                        <p class="card-text">{{ Str::limit($job->job_description , 150) }}</p>
                        <p class="card-text"><strong>Location:</strong> {{ $job->location }}</p>
                        <p class="card-text"><strong>Salary:</strong> {{ $job->salary }} {{ $job->salary_type }}</p>
                        @if ($job->status == 'active')
                        <a href="{{ route('edit_post', ['id' => $job->id]) }}" class="btn btn-primary">Manage</a>
                        <a href="{{ route('viewApplicant', ['id' => $job->id]) }}" class="btn btn-secondary">View Applicants</a>
                        <a href="{{ route('delete_post', ['id' => $job->id]) }}" class="btn btn-danger">Close</a>
                        @else
                        <a href="{{ route('viewApplicant', ['id' => $job->id]) }}" class="btn btn-secondary">View Applicants</a>
                        <a class="btn btn-danger">Closed Job</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
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