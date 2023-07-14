<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css')}}"> 
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        .submit-button {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #45a049;
        }
    </style>

<body>

    
      
      
    @include('layout.nav')

    <section class="section section-bg" id="call-to-action" style="background-image: url({{ asset('images/banner-image-1-1920x500.jpg') }})">
        <div class="container">
            <div class="row">
                <div class="col-lg-10  offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2>LOGIN <em> FORM</em></h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="form-container mt-4">
                <form method="POST" action="#">
                    @csrf
            
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" name="role" required>
                            <option value="job_seeker">Job Seeker</option>
                            <option value="employer">Employer</option>
                        </select>
                        @error('role')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="form-group">
                        <button type="submit" class="submit-button">Login</button>
                    </div>
                </form>
            </div>
        </div>
</body>
</html> 

<script>
    // Client-side validations
    document.getElementById('email').addEventListener('input', function() {
        this.setCustomValidity('');
    });

    document.getElementById('password').addEventListener('input', function() {
        this.setCustomValidity('');
    });

    document.getElementById('role').addEventListener('change', function() {
        this.setCustomValidity('');
    });

    document.querySelector('form').addEventListener('submit', function(event) {
        var emailInput = document.getElementById('email');
        var passwordInput = document.getElementById('password');
        var roleSelect = document.getElementById('role');
        var isFormValid = true;

        if (!emailInput.checkValidity()) {
            emailInput.setCustomValidity('Please enter a valid email address.');
            isFormValid = false;
        }

        if (!passwordInput.checkValidity()) {
            passwordInput.setCustomValidity('Please enter a password.');
            isFormValid = false;
        }

        if (!roleSelect.checkValidity()) {
            roleSelect.setCustomValidity('Please select a role.');
            isFormValid = false;
        }

        if (!isFormValid) {
            event.preventDefault();
        }
    });
</script>
