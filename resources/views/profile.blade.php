<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .form-container {
          max-width: 500px;
          margin: auto;
          padding: 20px;
          margin-top: 40px; 
        }
        .form-container2 {
          max-width: 500px;
          margin: auto;
          padding: 20px;
          margin-top: 20px; 
        }
    
        .form-container h2 {
          text-align: center;
        }
    
        .form-group {
          margin-bottom: 20px;
        }
    
        .form-group label {
          display: block;
          font-weight: bold;
        }
    
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group textarea {
          width: 100%;
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
        }
    
        .form-group .error-message {
          color: red;
        }
    
        .form-group input[type="submit"] {
          background-color: #4CAF50;
          color: white;
          padding: 10px 20px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
        }
    
        .error-message {
          color: #dc3545; /* Red color */
        }
      </style>
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
                      <h2>JOBSEEKER <em> PROFILE</em></h2>
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
  </div>
  <div class="form-container">
    <form id="registration-form" method="POST" action="{{ route('jobSeekerUpdateProfile', ['id' => $user->id]) }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="first-name">First Name:</label>
        <input type="text" id="first-name" name="firstName"  value="{{ $user->firstName }}" required>
      </div>
      <div class="form-group">
        <label for="last-name">Last Name:</label>
        <input type="text" id="last-name" name="lastName" value="{{ $user->lastName }}" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="{{ $user->phone }}" required pattern="[0-9]{10}" title="Phone number must be 10 digits">
      </div>
      <div class="form-group">
        <label for="address">Address:</label>
        <textarea id="address" name="address" required>{{ $user->address }}</textarea>
      </div>
      <div class="form-group">
        <label for="skills">Skills:</label>
        <input type="text" id="skills" name="skills" value="{{ $user->skills }}" required>
      </div>
      <div class="form-group">
        <label for="experience">Experience:</label>
        <input type="text" id="experience" value="{{ $user->experience }}" name="experience" required>
      </div>
      <div class="form-group">
        <label for="education">Education:</label>
        <input type="text" id="education" value="{{ $user->education }}" name="education" required>
      </div>
      <div class="form-group">
        <input type="submit" value="Submit">
      </div>
    </form>
  </div>
  <div class="form-container2">
    <form id="registration-form" method="POST" action="{{ route('updateResume', ['id' => $user->id]) }}" enctype="multipart/form-data">
      @csrf
      @if ($user->resume_path != "Resume is not attached")
            <p><strong>Resume:</strong> <a href="{{ asset('storage/' . $user->resume_path) }}" target="_blank">View Resume</a></p>
        @else
            <p><strong>Resume:</strong> {{ $user->resume_path }}</p>
        @endif
        
      <div class="form-group">
        <label for="resume">Resume:</label>
        <input type="file" id="resume" name="update_resume" required accept=".pdf,.doc,.docx">
      </div>
      <div class="form-group">
        <input type="submit" value="Update Resume">
      </div>
      </form>
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