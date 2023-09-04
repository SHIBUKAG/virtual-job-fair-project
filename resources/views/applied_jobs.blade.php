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
                        <h2>APPLIED <em> JOB DETAILS</em></h2>
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

    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4 mv-4">
        @foreach($appliedJobs as $application)
        <div class="col">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $application->jobPosting->job_title }}</h5>
                    <p class="card-text">Company : {{ $application->jobPosting->company_name }}</p>
                    <p class="card-text"><strong>Location : </strong> {{ $application->jobPosting->location }}</p>
                    @if ($application->status == "Hired")
                        <a href="#" class="btn btn-success">Status : {{ $application->status }} </a>
                    @elseif ($application->status == "Rejected")
                        <a href="#" class="btn btn-danger">Status : {{ $application->status }} </a>
                    @else
                        <a href="#" class="btn btn-primary">Status : {{ $application->status }} </a>
                    @endif
                    <a href="{{ route('viewJobs', ['id' => $application->job_posting_id]) }}" class="btn btn-secondary">View Details</a>
                    <a href="{{ route('showMessage', ['aid' => $application->id, 'eid' =>$application->jobPosting->employer_id]) }}" class="btn btn-secondary mt-2">Message</a>
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