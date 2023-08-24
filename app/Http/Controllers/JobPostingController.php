<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;
use App\Models\Employer;
use Illuminate\Support\Facades\Auth;

class JobPostingController extends Controller
{
    public function showDashboard()
    {
        $user = Auth::user();
        $employer = JobPosting::where('employer_id', $user->id)->get();
        $jobCount = $employer->count();

        return view('employer.dashboard', ['jobCount' => $jobCount]);
    }

    public function create()
    {
        return view('employer.post_job');
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;

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
        return view('employer.showjobs', compact('postedJobs')); 
        
        
    }

    return redirect('/login')->withErrors(['login' => 'Please log in to access this page.']);


    }

    public function managePosts()
    {
        $user = Auth::user();
        $posts = JobPosting::where('employer_id', $user->id)->get();

        return view('employer.manage_posts', ['posts' => $posts]);
    }

    public function editPost($id)
    {
        $post = JobPosting::findOrFail($id);
        // Other code for fetching additional data if needed
        return view('employer.edit_post', compact('post'));
    }

    public function updatePost(Request $request, $id)
    {
        $post = JobPosting::findOrFail($id);

        // Update the post attributes
        $post->update([
            'job_title' => $request->input('jobTitle'),
            'company_name' => $request->input('companyName'),
            'job_type' => $request->input('jobType'),
            'salary' => $request->input('estimatedSalary'),
            'job_description' => $request->input('jobDescription'),
            'location' => $request->input('location'),
            'required_skills' => $request->input('requiredSkills'),
        ]);


        // Redirect back to the manage page with a success message
        return redirect()->route('employer.jobs')->with('success', 'Post updated successfully.');
    }

    public function deletePost($id)
    {
        // Find the job posting by its ID
        $jobPosting = JobPosting::findOrFail($id);

        // Check if the authenticated user is the employer who posted the job
        $user = Auth::user();
        if ($user->id !== $jobPosting->employer_id) {
            return redirect()->back()->with('error', 'You do not have permission to delete this job posting.');
        }

        // Delete the job posting
        $jobPosting->status = 'closed';
        $jobPosting->save();

        return redirect()->route('employer.jobs')->with('success', 'Job posting closed successfully.');
    }


}
