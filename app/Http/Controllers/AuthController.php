<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function employerRegistration(Request $request)
    {
        $email = $request->email;

        // Check if the user already exists
        $existingUser = Employer::where('email', $email)->first();

        if ($existingUser) {
            // User already exists, handle the error or redirect back with a message
            return redirect()->back()->withErrors(['email' => 'User with this email already exists.']);
        }

        
        

        // Create a new employer record
        $employer = new Employer();
        $employer->companyName = $request->companyName;
        $employer->industry = $request->industry;
        $employer->location = $request->location;
        $employer->contactName = $request->contactName;
        $employer->email = $request->email;
        $employer->password = $request->password;
        $employer->phone = $request->phone;
        $employer->website = $request->website;

        $employer->save();


        // Redirect the user after successful registration
        return redirect('/login')->with('success', 'Registration completed successfully.');
    }

    public function jobSeekerRegistration(Request $request)
    {
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes');
        } else {
            $resumePath = "Resume is not attached";
        }   

        $email = $request->email;
        
        // Check if the user already exists
        $existingUser = JobSeeker::where('email', $email)->first();

        if ($existingUser) {
            // User already exists, handle the error or redirect back with a message
            return redirect()->back()->withErrors(['email' => 'User with this email already exists.']);
        }

        // Create a new job seeker record
        $jobSeeker = new JobSeeker();
        $jobSeeker->firstName = $request->firstName;
        $jobSeeker->lastName = $request->lastName;
        $jobSeeker->email = $request->email;
        $jobSeeker->password = $request->password;
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
    
        $credentials = $request->only('email', 'password', 'role');
    
        if($credentials)
        {
            if($credentials['role']=="job_seeker")
            {
                $user = JobSeeker::where('email', $credentials['email'])->first();

                if ($user && $user->password === $credentials['password']) {
                    // Authentication successful
                    Auth::guard('job_seeker')->login($user);
                    session([
                        'status' => 'true'
                    ]);
                    return redirect('/');
                }

                // Authentication failed
                return redirect()->back()->withErrors([
                    'login' => 'Invalid email or password.',
                ]);

            }elseif($credentials['role']=="employer")
            {
                $user = Employer::where('email', $credentials['email'])->first();

                if ($user && $user->password === $credentials['password']) {
                    // Authentication successful
                    Auth::guard('employer')->login($user);
                    session([
                        'status' => 'true',
                        'user_id' => $user->id,
                        'user_name' => $user->companyName,
                        'user_email' => $user->email,
                    ]);
                    return redirect('/employer/dashboard');
                }

                // Authentication failed
                return redirect()->back()->withErrors([
                    'login' => 'Invalid email or password.',
                ]);
            }
        }
    }



    public function logout()
    {
        Auth::logout();
        session(['status' => 'false']);
        return redirect('/');
    }

    
}
