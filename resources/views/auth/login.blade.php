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

        .alert-success {
        background-color: #dff0d8;
        color: #3c763d;
        border: 1px solid #d6e9c6;
        padding: 4%;
        margin-bottom: 5%;
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
        @if (Session::has('success'))
            <div class="alert-success mt-4">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger" role="alert">
                <b><p>{{ Session::get('error') }}</p></b>
              </div>
        @endif
        

                <form method="POST" action="/login" id="login-form">
                    @csrf
            
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}">
                    </div>
            
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password">
                    </div>
            
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" name="role">
                            <option value="job_seeker" >Job Seeker</option>
                            <option value="employer">Employer</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="password-reset-link">
                        <a href="{{ route('forgetPassword') }}">Forgot Your Password?</a>
                    </div>
            
                    <div class="form-group mt-2">
                        <button type="submit" class="submit-button">Login</button>
                    </div>

                </form>
                <script>
                
                    document.getElementById('login-form').addEventListener('submit', function (event) {
                        // Prevent the form from submitting if client-side validation fails
                        if (!validateForm()) {
                            event.preventDefault();
                        }
                    });
                
                    function validateForm() {
                        let isValid = true;
                        const emailInput = document.getElementById('email');
                        const passwordInput = document.getElementById('password');
                
                        // Check if email and password fields are empty
                        if (emailInput.value.trim() === '') {
                            isValid = false;
                            displayErrorMessage(emailInput, 'Email is required.');
                        }
                
                        if (passwordInput.value.trim() === '') {
                            isValid = false;
                            displayErrorMessage(passwordInput, 'Password is required.');
                        }
                
                        return isValid;
                    }
                
                    function displayErrorMessage(inputElement, message) {
                        const errorSpan = inputElement.nextElementSibling;
                        if (errorSpan && errorSpan.classList.contains('error-message')) {
                            errorSpan.textContent = message;
                        } else {
                            const errorMessage = document.createElement('span');
                            errorMessage.classList.add('error-message');
                            errorMessage.textContent = message;
                            inputElement.parentNode.appendChild(errorMessage);
                        }
                    }
                </script>
            </div>
        </div>
        
</body>
</html> 


