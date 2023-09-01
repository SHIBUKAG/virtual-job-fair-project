<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Posts</title>
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
                      <h2>MANAGE <em> POSTS</em></h2>
                  </div>
              </div>
          </div>
      </div>
  </section>


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

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Job Id</th>
          <th scope="col">Job Title</th>
          <th scope="col">Comapany Name</th>
          <th scope="col">Status</th>
          <th scope="col">Disable</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($jobs as $j)
        <tr>
          <td>{{ $j->id }}</td>
          <td>{{ $j->job_title}}</td>
          <td>{{ $j->company_name }}</td>
          <td>{{ $j->status }}</td>
          @if ($j->status == 'closed')
          <td><a class="btn btn-success" href="{{ route('activePosts',['id' => $j->id]) }}" role="button">Enable</a></td>
          @else
          <td><a class="btn btn-warning" href="{{ route('disablePosts',['id' => $j->id]) }}" role="button">Disable</a></td>
          @endif
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