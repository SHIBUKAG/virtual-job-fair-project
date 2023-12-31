<!DOCTYPE html>
<html>
<head>
  <title>Employer Registration Form</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet"> 
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css')}}"> 
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <style>
    .form-container {
      max-width: 500px;
      margin: auto;
      padding: 20px;
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
                  <div class="col-lg-10 offset-lg-1">
                      <div class="cta-content">
                          <br>
                          <br>
                          <h2>Employer <em>Registration Form</em></h2>
                          <p>Register your company by completing the Employer Registration Form and creating your profile effortlessly.</p>
                      </div>
                  </div>
              </div>
          </div>

      </section>
      <div class="form-container" >
        <form id="registration-form" method="POST" action="/employerRegister">
          @csrf
          <div class="form-group">
            <label for="company-name">Company Name:</label>
            <input type="text" id="company-name" name="companyName" required>
          </div>
          <div class="form-group">
            <label for="industry">Industry:</label>
            <input type="text" id="industry" name="industry" required>
          </div>
          <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>
          </div>
          <div class="form-group">
            <label for="contact-name">Contact Name:</label>
            <input type="text" id="contact-name" name="contactName" required>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>
          </div>
          <div class="form-group">
            <label for="website">Website:</label>
            <input type="text" id="website" name="website" required>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
          </div>
          <div class="form-group">
            <input type="submit" value="Submit">
          </div>
        </form>
      </div>

      <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("registration-form");
    
            form.addEventListener("submit", function (event) {
                // Prevent the form from submitting
                event.preventDefault();
    
                // Clear previous error messages
                const errorMessages = form.querySelectorAll(".error-message");
                errorMessages.forEach(message => message.textContent = "");
    
                let isValid = true;
                let firstInvalidField = null;
    
                // Validate Company Name
                const companyNameInput = document.getElementById("company-name");
                if (companyNameInput.value.trim() === "") {
                    displayErrorMessage(companyNameInput, "Company Name is required.");
                    isValid = false;
                    if (!firstInvalidField) {
                        firstInvalidField = companyNameInput;
                    }
                }
    
                // Validate Industry
                const industryInput = document.getElementById("industry");
                if (industryInput.value.trim() === "") {
                    displayErrorMessage(industryInput, "Industry is required.");
                    isValid = false;
                    if (!firstInvalidField) {
                        firstInvalidField = industryInput;
                    }
                }
    
                // Validate Location
                const locationInput = document.getElementById("location");
                if (locationInput.value.trim() === "") {
                    displayErrorMessage(locationInput, "Location is required.");
                    isValid = false;
                    if (!firstInvalidField) {
                        firstInvalidField = locationInput;
                    }
                }
    
                // Validate Contact Name
                const contactNameInput = document.getElementById("contact-name");
                if (contactNameInput.value.trim() === "") {
                    displayErrorMessage(contactNameInput, "Contact Name is required.");
                    isValid = false;
                    if (!firstInvalidField) {
                        firstInvalidField = contactNameInput;
                    }
                }
    
                // Validate Email
                const emailInput = document.getElementById("email");
                if (emailInput.value.trim() === "") {
                    displayErrorMessage(emailInput, "Email is required.");
                    isValid = false;
                    if (!firstInvalidField) {
                        firstInvalidField = emailInput;
                    }
                }
    
                // Validate Phone
                const phoneInput = document.getElementById("phone");
                if (phoneInput.value.trim() === "") {
                    displayErrorMessage(phoneInput, "Phone is required.");
                    isValid = false;
                    if (!firstInvalidField) {
                        firstInvalidField = phoneInput;
                    }
                }
    
                // Validate Website
                const websiteInput = document.getElementById("website");
                if (websiteInput.value.trim() === "") {
                    displayErrorMessage(websiteInput, "Website is required.");
                    isValid = false;
                    if (!firstInvalidField) {
                        firstInvalidField = websiteInput;
                    }
                }
    
                // Validate Password
                const passwordInput = document.getElementById("password");
                if (passwordInput.value.trim() === "") {
                    displayErrorMessage(passwordInput, "Password is required.");
                    isValid = false;
                    if (!firstInvalidField) {
                        firstInvalidField = passwordInput;
                    }
                }
    
                // If all validation passes, submit the form
                if (isValid) {
                    form.submit();
                } else if (firstInvalidField) {
                    firstInvalidField.focus();
                }
            });
    
            function displayErrorMessage(inputElement, message) {
                const errorMessage = document.createElement("div");
                errorMessage.classList.add("error-message");
                errorMessage.textContent = message;
                inputElement.parentNode.appendChild(errorMessage);
            }
        });
    </script>
    
</body>
</html>

  

