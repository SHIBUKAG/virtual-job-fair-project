<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Applicant</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
      
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
                      <h2>VIEW <em> APPLICANT</em></h2>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <div class="container mt-4">
    <h1>Applicants for Job: {{ $jobPosting->job_title }}</h1>

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Applicant Name</th>
            <th scope="col">Email</th>
            <th scope="col">Applied At</th>
            <th scope="col">View Details</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($applicants as $application )  
          <tr>
            <td>{{ $application->jobSeeker->firstName }} {{ $application->jobSeeker->lastName }}</td>
            <td>{{ $application->jobSeeker->email }}</td>
            <td>{{ $application->created_at }}</td>
            <td><a href="{{ route('viewApplicantDetails',['id' => $application->jobSeeker->id]) }}" class="btn btn-secondary">View Details</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
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