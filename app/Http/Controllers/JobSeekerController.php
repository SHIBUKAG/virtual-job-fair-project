<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;
use App\Models\JobSeeker;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;


class JobSeekerController extends Controller
{
    public function jobs()
    {
        $postedJobs = JobPosting::where('status', 'active')->get();
    return view('jobs', compact('postedJobs'));
    }

    public function viewJobs(Request $request, $id)
    {
        $job = JobPosting::findOrFail($id);
        return view('jobDetails', compact('job'));
    }

    public function profile()
    {
        $user = Auth::guard('job_seeker')->user();
        return view('profile', compact('user'));
    }

    public function jobSeekerUpdateProfile(Request $request, $id)
    {
        $user = JobSeeker::findOrFail($id);

        if($user)
        {
            $user->update([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'skills' => $request->input('skills'),
                'experience' => $request->input('experience'),
                'education' => $request->input('education'),
        ]);
        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
        }
        
    }



    public function applyJob(Request $request, $id)
    {
        $jobid = $id;

        if (!Auth::guard('job_seeker')->user()) {
            return redirect()->route('login')->with('error', 'You need to log in to apply.');
        }
        $user = Auth::guard('job_seeker')->user();

        $existingApplication = Application::where([
            'job_posting_id' => $jobid,
            'user_id' => $user->id,
        ])->first();
    
        if ($existingApplication) {
            return redirect()->route('viewJobs', ['id' => $jobid])->with('error', 'You have already applied for this job.');
        }
    

        $application = new Application([
            'job_posting_id' => $jobid,
            'user_id' => $user->id,
            // Other fields you might have
        ]);
        $application->save();

        return redirect()->route('viewJobs', ['id' => $jobid])->with('success', 'Application submitted successfully.');

    }

    public function appliedJobs()
    {
        if (!Auth::guard('job_seeker')->user()) {
            return redirect()->route('login')->with('error', 'You need to log in to apply.');
        }
        $user_id = Auth::guard('job_seeker')->user()->id;

        $appliedJobs = Application::where('user_id', $user_id)
        ->with('jobPosting') // relationship defined in Application model
        ->get();

        return view('applied_jobs', ['appliedJobs' => $appliedJobs]);

    }
}
