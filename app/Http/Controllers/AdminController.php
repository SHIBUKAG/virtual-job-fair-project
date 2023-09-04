<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;
use App\Models\Employer;
use App\Models\JobSeeker;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected function adminDashboard()
    {
        $JobSeekers = JobSeeker::all()->count();
        $Employers = Employer::all()->count();
        $JobPostings = JobPosting::all()->count();
        $Applicants = Application::all()->count();
        return view('admin.dashboard', compact('JobSeekers', 'Employers', 'JobPostings', 'Applicants'));
    }

    protected function managePosts()
    {
        $jobs = JobPosting::all();
        return view('admin.managePosts', compact('jobs'));
    }

    protected function manageUsers()
    {
        $jobseekers = JobSeeker::all();
        $employers = Employer::all();
        return view('admin.manageUsers', compact('jobseekers', 'employers'));
    }

    protected function disableJobs(Request $request)
    {
        $user = JobSeeker::findOrFail($request->id);
        $value = 'disabled';
        $user->update([
            'verified' => $value,
        ]);
        
        return redirect()->back()->with('error', 'JobSeeker Deactivated successfully');
    }

    protected function activeJobs(Request $request)
    {
        $user = JobSeeker::findOrFail($request->id);
        $value = 'true';
        $user->update([
            'verified' => $value,
        ]);
        
        return redirect()->back()->with('success', 'JobSeeker Activated successfully');
    }

    protected function disableEmp(Request $request)
    {
        $user = Employer::findOrFail($request->id);
        $value = 'disabled';
        $user->update([
            'verified' => $value,
        ]);
        
        return redirect()->back()->with('error', 'JobSeeker Deactivated successfully');
    }

    protected function activeEmp(Request $request)
    {
        $user = Employer::findOrFail($request->id);
        $value = 'true';
        $user->update([
            'verified' => $value,
        ]);
        
        return redirect()->back()->with('success', 'JobSeeker Activated successfully');
    }

    protected function disablePosts(Request $request)
    {
        $job = JobPosting::findOrFail($request->id);
        $value = 'closed';
        $job->update([
            'status' => $value,
        ]);
        
        return redirect()->back()->with('error', 'Job Closed successfully');
    }

    protected function activePosts(Request $request)
    {
        $job = JobPosting::findOrFail($request->id);
        $value = 'active';
        $job->update([
            'status' => $value,
        ]);
        
        return redirect()->back()->with('success', 'Job enabled successfully');
    }
}
