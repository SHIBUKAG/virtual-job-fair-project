<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\Models\JobSeeker;
use App\Models\Employer;


class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }
    public function jobSeekerRegister()
    {
        return view('auth.jobSeekerRegister');
    }

    public function employerRegister()
    {
        return view('auth.employerRegister');
    }

    public function employerRegistration()
    {
        // Validate the user input
        $this->validate($request, [
            'companyName' => 'required|string|max:255',
            'industry' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contactName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employers',
            'phone' => 'required|string|max:20',
            'website' => 'required|string|max:255',
        ]);

        // Create a new employer record
        $employer = new Employer();
        $employer->companyName = $request->companyName;
        $employer->industry = $request->industry;
        $employer->location = $request->location;
        $employer->contactName = $request->contactName;
        $employer->email = $request->email;
        $employer->phone = $request->phone;
        $employer->website = $request->website;
        $employer->save();

        // Redirect the user after successful registration
        return redirect('/login')->with('success', 'Registration completed successfully.');
    }

    public function jobSeekerRegistration()
    {
        $this->validate($request, [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:job_seekers',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'skills' => 'required|string',
            'experience' => 'required|string',
            'education' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        //file upload
        $resume = $request->file('resume');
        $resumePath = $resume->store('resumes');

        // Create a new job seeker record
        $jobSeeker = new JobSeeker();
        $jobSeeker->firstName = $request->firstName;
        $jobSeeker->lastName = $request->lastName;
        $jobSeeker->email = $request->email;
        $jobSeeker->phone = $request->phone;
        $jobSeeker->address = $request->address;
        $jobSeeker->skills = $request->skills;
        $jobSeeker->experience = $request->experience;
        $jobSeeker->education = $request->education;
        $jobSeeker->resume_path = $resumePath;
        $jobSeeker->save();

        // Redirect the user after successful registration
        return redirect('/login')->with('success', 'Registration completed successfully.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:job_seeker,employer',
        ]);

        $role = $request->role;

        if (Auth::attempt($credentials)) {
            // Authentication successful
            if ($role === 'job_seeker' && Auth::user()->isJobSeeker()) {
                return redirect('/job_seeker/dashboard');
            } elseif ($role === 'employer' && Auth::user()->isEmployer()) {
                return redirect('/employer/dashboard');
            }
        }

        // Authentication failed
        return redirect()->back()->withErrors([
            'login' => 'Invalid email, password, or role.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    
}
