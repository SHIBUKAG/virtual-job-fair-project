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
    <style>
        .error-message {
            color: #dc3545; /* Red color */
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
                      <h2>POST <em> JOB</em></h2>
                      <p>Easily create and publish new job opportunities to attract potential candidates and grow your team.</p>
                  </div>
              </div>
          </div>
      </div>
  </section>
  
  <div class="container mt-5">
    <h2 class="mb-4">Post a Job</h2>
    <form id="job-posting-form" method="POST" action="/submit_job">
        @csrf
        <div class="form-group">
            <label for="job-title">Job Title:</label>
            <input type="text" class="form-control" id="job-title" name="jobTitle" required>
            <div class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="company-name">Company Name:</label>
            <input type="text" class="form-control" id="company-name" value="{{ Auth::user()->companyName; }}" name="companyName" required readonly>
            <div class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="job-type">Job Type:</label>
            <select class="form-control" id="job-type" name="jobType" required>
                <option value="full_time">Full Time</option>
                <option value="part_time">Part Time</option>
                <option value="contract">Contract</option>
            </select>
            <div class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="salary">Estimated Salary:</label>
            <div class="input-group">
                <input type="number" class="form-control" id="salary" name="estimatedSalary" required>
                <div class="error-message"></div>
                <div class="input-group-append">
                    <select class="form-control" id="salary-type" name="salaryType" required>
                        <option value="monthly">Per Month</option>
                        <option value="yearly">Per Year</option>
                    </select>
                    <div class="error-message"></div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="job-description">Job Description:</label>
            <textarea class="form-control" id="job-description" name="jobDescription" rows="5" required></textarea>
            <div class="error-message"></div>
        </div>
        <div class="form-group">
          <label for="location">Location:</label>
          <input type="text" class="form-control" id="location" name="location" required>
          <div class="error-message"></div>
      </div>
      <div class="form-group">
          <label for="required-skills">Required Skills:</label>
          <input type="text" class="form-control" id="required-skills" name="requiredSkills" required>
          <small class="form-text text-muted">Separate skills with commas (e.g. Java, Python, JavaScript)</small>
          <div class="error-message"></div>
      </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("job-posting-form");

        form.addEventListener("submit", function (event) {
            // Prevent the form from submitting
            event.preventDefault();

            // Clear previous error messages
            const errorMessages = form.querySelectorAll(".error-message");
            errorMessages.forEach(message => message.textContent = "");

            let isValid = true;
            let firstInvalidField = null;

            // Validate Job Title
            const jobTitleInput = document.getElementById("job-title");
            if (jobTitleInput.value.trim() === "") {
                displayErrorMessage(jobTitleInput, "Job Title is required.");
                isValid = false;
                if (!firstInvalidField) {
                    firstInvalidField = jobTitleInput;
                }
            }

            // Validate Company Name
            const companyNameInput = document.getElementById("company-name");
            if (companyNameInput.value.trim() === "") {
                displayErrorMessage(companyNameInput, "Company Name is required.");
                isValid = false;
                if (!firstInvalidField) {
                    firstInvalidField = companyNameInput;
                }
            }

            // Validate Job Type
            const jobTypeSelect = document.getElementById("job-type");
            if (jobTypeSelect.value === "") {
                displayErrorMessage(jobTypeSelect, "Job Type is required.");
                isValid = false;
                if (!firstInvalidField) {
                    firstInvalidField = jobTypeSelect;
                }
            }

            // Validate Estimated Salary
            const salaryInput = document.getElementById("salary");
            if (salaryInput.value.trim() === "" || isNaN(salaryInput.value)) {
                displayErrorMessage(salaryInput, "Valid Salary is required.");
                isValid = false;
                if (!firstInvalidField) {
                    firstInvalidField = salaryInput;
                }
            }

            // Validate Job Description
            const jobDescriptionInput = document.getElementById("job-description");
            const jobDescriptionValue = jobDescriptionInput.value.trim();

            if (jobDescriptionValue === "") {
                displayErrorMessage(jobDescriptionInput, "Job Description is required.");
                isValid = false;
                if (!firstInvalidField) {
                    firstInvalidField = jobDescriptionInput;
                }
            } else if (jobDescriptionValue.length < 150) {
                displayErrorMessage(jobDescriptionInput, "Job Description must contain at least 150 characters.");
                isValid = false;
                if (!firstInvalidField) {
                    firstInvalidField = jobDescriptionInput;
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

            // Validate Required Skills
            const requiredSkillsInput = document.getElementById("required-skills");
            if (requiredSkillsInput.value.trim() === "") {
                displayErrorMessage(requiredSkillsInput, "Required Skills are required.");
                isValid = false;
                if (!firstInvalidField) {
                    firstInvalidField = requiredSkillsInput;
                }
            }

            // ... (repeat for other fields)

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