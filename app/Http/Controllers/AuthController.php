<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\demoMail;
use App\Mail\resetLink;
use Illuminate\Http\Request;
use App\Models\JobSeeker;
use App\Models\Employer;
use App\Models\Admin;


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
        $employer->password = Hash::make($request->password);
        $employer->phone = $request->phone;
        $employer->website = $request->website;
        $employer->token = $verificationToken = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        $employer->save();

        $verificationLink = route('verify.email', ['token' => $verificationToken]);

        $mailData = [
            'title' => 'Email Verification for VirtualCareerExpo',
            'link' => $verificationLink,
        ];

        Mail::to($request->email)->send(new demoMail($mailData));

        // Redirect the user after successful registration
        return redirect('/login')->with('success', 'Verifcation link has been sent');
    }

    public function jobSeekerRegistration(Request $request)
    {
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
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
        $jobSeeker->password = Hash::make($request->password);
        $jobSeeker->phone = $request->phone;
        $jobSeeker->address = $request->address;
        $jobSeeker->skills = $request->skills;
        $jobSeeker->experience = $request->experience;
        $jobSeeker->education = $request->education;
        $jobSeeker->resume_path = $resumePath;

        $jobSeeker->token = $verificationToken = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        $jobSeeker->save();

        $verificationLink = route('verify.email', ['token' => $verificationToken]);

        $mailData = [
            'title' => 'Email Verification for VirtualCareerExpo',
            'link' => $verificationLink,
        ];

        Mail::to($request->email)->send(new demoMail($mailData));

        // Redirect the user after successful registration
        return redirect('/login')->with('success', 'Verifcation link has been sent');
    }

    public function login(Request $request)
    {
    
        $credentials = $request->only('email', 'password', 'role');
    
        if($credentials)
        {
            if($credentials['role']=="job_seeker")
            {
                $user = JobSeeker::where('email', $credentials['email'])
                                ->where('verified', 'true')
                                ->first();

                if ($user && Hash::check($credentials['password'], $user->password)) {
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
                $user = Employer::where('email', $credentials['email'])
                                ->where('verified', 'true')
                                ->first();
                
                if ($user && Hash::check($credentials['password'], $user->password)) {
                    // Authentication successful'
                    Auth::guard('employer')->login($user);
                    session([
                        'status' => 'true',
                        'role' => 'employer',
                    ]);
                    return redirect('/employer/dashboard');
                }

                // Authentication failed
                return redirect()->back()->withErrors([
                    'login' => 'Invalid email or password.',
                ]);
            }else{
                $user = Admin::where('email', $credentials['email'])->first();

                if ($user && Hash::check($credentials['password'], $user->password)){
                    Auth::guard('admin')->login($user);
                    return redirect('/admin/dashboard');
                }
            }
        }
    }



    public function logout()
    {
        session()->flush(); // Clear all session data
        auth()->logout();
        return redirect('/');
    }

    public function sendMail()
    {
        $mailData = [
            'title' => 'Mail form Virtual',
            'body' => 'hello, this is testing',
        ];

        Mail::to('shivamkag2003@gmail.com')->send(new demoMail($mailData));
    }

    public function verifyEmail(Request $request)
    {
        $token = $request->query('token');
        $jobSeeker = JobSeeker::where('token', $token)->first();
        $employer = Employer::where('token', $token)->first();
    
        if ($jobSeeker) {
            // Update job seeker verification status
            $jobSeeker->verified = 'true';
            $jobSeeker->token = 'done';
            $jobSeeker->save();
    
            return redirect('/login')->with('success', 'Verification successful. You can now log in.');
        } elseif ($employer) {
            // Update employer verification status
            $employer->verified = 'true';
            $employer->token = 'done';
            $employer->save();
    
            return redirect('/login')->with('success', 'Verification successful. You can now log in.');
        }
    
        return redirect('/login')->with('error', 'Verification failed. Invalid token.');
    
    }

    public function forgetPassword()
    {
        return view('auth.reset');
    }

    public function sendResetLink(Request $request)
    {
        $email = $request->email;
        $role = $request->role;

        if($role == "job_seeker")
        {
            $user = JobSeeker::where('email', $email)->first();
            if(!$user)
            {
                return redirect()->back()->with('error', "Email does not exist in records, please enter valid email.");
            }

            $user->token = $resetToken = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $user->save();

            $verificationLink = route('resetPassword', ['token' => $resetToken]);

            $mailData = [
                'title' => 'Password Reset Link',
                'link' => $verificationLink,
            ];

            Mail::to($request->email)->send(new resetLink($mailData));

            return redirect('/login')->with('success', 'Reset link has been sent');

        }elseif($role == "employer")
        {
            $user = Employer::where('email', $email)->first();
            if(!$user)
            {
                return redirect()->back()->with('error', "Email does not exist in records, please enter valid email.");
            }

            $user->token = $resetToken = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $user->save();

            $verificationLink = route('resetPassword', ['token' => $resetToken]);

            $mailData = [
                'title' => 'Password Reset Link',
                'link' => $verificationLink,
            ];

            Mail::to($request->email)->send(new resetLink($mailData));

            return redirect('/login')->with('success', 'Reset link has been sent');
        }else{

        }
    }

    public function resetPassword(Request $request)
    {
        $token = $request->query('token');
        $jobSeeker = JobSeeker::where('token', $token)->first();
        $employer = Employer::where('token', $token)->first();

        if($jobSeeker)
        {
            return view('auth.resetPass', compact('token'));
        }
        if($employer)
        {
            return view('auth.resetPass', compact('token'));
        }
    }

    public function reset(Request $request)
    {
        $token = $request->token;
        $pass = $request->password;

        $jobSeeker = JobSeeker::where('token', $token)->first();
        $employer = Employer::where('token', $token)->first();

        if($jobSeeker)
        {
            $jobSeeker->password = Hash::make($pass);
            $jobSeeker->token = 'done';
            $jobSeeker->save();
            return redirect('/login')->with('success', 'Password reset successfully.');
        }
        if($employer)
        {
            $employer->password = Hash::make($pass);
            $employer->token = 'done';
            $employer->save();
            return redirect('/login')->with('success', 'Password reset successfully.');
        }
        return redirect('/login')->with('error', 'Password reset failed.');


    }

    
}
