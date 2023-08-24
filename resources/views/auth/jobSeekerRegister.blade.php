<!DOCTYPE html>
<html>
<head>
  <title>JobSeeker Registration Form</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css')}}"> 
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <style>
    .form-container {
      max-width: 500px;
      margin: auto;
      padding: 20px;
      margin-top: 40px; 
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
  </style>
</head>
<body>

    
      
      
      @include('layout.nav')
  
      <section class="section section-bg" id="call-to-action" style="background-image: url({{ asset('images/banner-image-1-1920x500.jpg') }})">
          <div class="container">
              <div class="row">
                  <div class="col-lg-10 offset-lg-1">
                      <div class="cta-content">
                          <br>
                          <br>
                          <h2>Job Seeker <em>Registration Form</em></h2>
                          <p>Complete the form below to register as a job seeker and create your comprehensive profile.</p>
                      </div>
                  </div>
              </div>
          </div>
      </section>
  <div class="form-container">
    <form id="registration-form" method="POST" action="/jobSeekerRegister" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="first-name">First Name:</label>
        <input type="text" id="first-name" name="firstName" required>
      </div>
      <div class="form-group">
        <label for="last-name">Last Name:</label>
        <input type="text" id="last-name" name="lastName" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required pattern="[0-9]{10}" title="Phone number must be 10 digits">
      </div>
      <div class="form-group">
        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea>
      </div>
      <div class="form-group">
        <label for="skills">Skills:</label>
        <input type="text" id="skills" name="skills" required>
      </div>
      <div class="form-group">
        <label for="experience">Experience:</label>
        <input type="text" id="experience" name="experience" required>
      </div>
      <div class="form-group">
        <label for="education">Education:</label>
        <input type="text" id="education" name="education" required>
      </div>
      <div class="form-group">
        <label for="resume">Resume:</label>
        <input type="file" id="resume" name="resume" required accept=".pdf,.doc,.docx">
      </div>
      <div class="form-group">
        <input type="submit" value="Submit">
      </div>
    </form>
  </div>
</body>
</html>
