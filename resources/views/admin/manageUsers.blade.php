<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Users</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
      
    </style>
  </head>
  <body>
    
    @include('admin.admin_nav')

    <section class="section section-bg" id="call-to-action" style="background-image: url({{ asset('images/banner-image-1-1920x500.jpg') }})">
      <div class="container">
          <div class="row">
              <div class="col-lg-10  offset-lg-1">
                  <div class="cta-content">
                      <br>
                      <br>
                      <h2>MANAGE <em> USERS</em></h2>
                  </div>
              </div>
          </div>
      </div>
  </section>
  <div class="container mt-4">
    <div class="row centered-buttons">
        <div class="col-md-12 text-center">
            <!-- Bootstrap Buttons -->
            <!-- Add 'showDiv' function calls with respective div IDs -->
            <button class="btn btn-secondary" onclick="showDiv('jobseeker')">JobSeekers</button>
            <button class="btn btn-secondary" onclick="showDiv('employer')">Employers</button>
        </div>
    </div>
</div>
  <div class="container mt-4" id="jobseeker">
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
    <h5>JobSeekers :</h5>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">User Id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Disable</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($jobseekers as $j)
        <tr>
          <td>{{ $j->id }}</td>
          <td>{{ $j->firstName }} {{ $j->lastName }}</td>
          <td>{{ $j->email }}</td>
          <td>JobSeeker</td>
          @if ($j->verified == 'disabled')
          <td><a class="btn btn-success" href="{{ route('activeJobs',['id' => $j->id]) }}" role="button">Activate</a></td>
          @else
          <td><a class="btn btn-warning" href="{{ route('disableJobs',['id' => $j->id]) }}" role="button">Deactivate</a></td>
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="container mt-4" id="employer">
    <h5>Employers :</h5>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">User Id</th>
          <th scope="col">Company Name</th>
          <th scope="col">Contact Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col">Disable</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($employers as $j)
        <tr>
          <td>{{ $j->id }}</td>
          <td>{{ $j->companyName }}</td>
          <td>{{ $j->contactName }}</td>
          <td>{{ $j->email }}</td>
          <td>Employer</td>
          @if ($j->verified == 'disabled')
          <td><a class="btn btn-success" href="{{ route('activeEmp',['id' => $j->id]) }}" role="button">Activate</a></td>
          @else
          <td><a class="btn btn-warning" href="{{ route('disableEmp',['id' => $j->id]) }}" role="button">Deactivate</a></td>
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script>
    function showDiv(divId) {
        // Hide all divs with class 'container mt-4'
        const divs = document.querySelectorAll('.container.mt-4');
        for (const div of divs) {
            div.style.display = 'none';
        }

        // Show the selected div by ID
        const selectedDiv = document.getElementById(divId);
        if (selectedDiv) {
            selectedDiv.style.display = 'block';
        }
    }
</script>
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