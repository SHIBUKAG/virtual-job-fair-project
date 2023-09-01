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
    <table class="table table-striped mt-4">
        <thead>
          <tr>
            <th scope="col">Applicant Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Skills</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ $user->firstName }} {{ $user->lastName }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->skills }}</td>
          </tr>
        </tbody>
        <thead>
            <tr>
              <th scope="col">Address</th>
              <th scope="col">Experience</th>
              <th scope="col">Education</th>
              <th scope="col">Resume</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ $user->address }}</td>
              <td>{{ $user->experience }}</td>
              <td>{{ $user->education }}</td>
              <td>
                @if ($user->resume_path != "Resume is not attached")
                    <p><a href="{{ asset('storage/' . $user->resume_path) }}" target="_blank">View Resume</a></p>
                @else
                    <p>{{ $user->resume_path }}</p>
                @endif
            </td>
            </tr>
          </tbody>
      </table>
  </div>
  <div class="user-details">
    <div class="user-info">
        <a href="#" class="btn btn-secondary">Chat</a>
        <a href="{{ route('hire', ['id' => $user->id, 'aid' => $applicantion_id ]) }}" class="btn btn-success">Hire</a>
        <a href="{{ route('reject', ['id' => $user->id, 'aid' => $applicantion_id]) }}" class="btn btn-danger">Reject</a>
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