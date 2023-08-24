<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;
use Illuminate\Support\Facades\Auth;

class JobPostingController extends Controller
{


    public function create()
    {
        return view('employer.post_job');
    }


    public function store(Request $request)
    {
        $id = session('user_id');

        $jobPosting = new JobPosting();
        $jobPosting->job_title = $request->jobTitle;
        $jobPosting->company_name = $request->companyName;
        $jobPosting->job_type = $request->jobType;
        $jobPosting->salary = $request->estimatedSalary;
        $jobPosting->salary_type = $request->salaryType;
        $jobPosting->job_description = $request->jobDescription;
        $jobPosting->location = $request->location;
        $jobPosting->required_skills = $request->requiredSkills;
        $jobPosting->employer_id = $id;
        $jobPosting->save();

        return redirect()->route('employer.jobs')->with('success', 'Job posted successfully.');
    }

    public function showPostedJobs()
    {
        $user = Auth::guard('employer')->user();

    if ($user) {
        $postedJobs = JobPosting::where('employer_id', $user->id)->get();
        return view('employer.manage_job', compact('postedJobs')); 
        
        
    }

    return redirect('/login')->withErrors(['login' => 'Please log in to access this page.']);


    }

}
