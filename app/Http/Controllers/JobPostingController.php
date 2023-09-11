<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;
use App\Models\Employer;
use App\Models\JobSeeker;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\statusChange;

class JobPostingController extends Controller
{
    
    public function showDashboard()
    {
        $user = Auth::guard('employer')->user();
        $jobPostingCount = JobPosting::where('employer_id', $user->id)->count();

        $applicantCount = Application::join('job_postings', 'applications.job_posting_id', '=', 'job_postings.id')
                            ->where('job_postings.employer_id', $user->id)
                            ->count();


        return view('employer.dashboard', compact('jobPostingCount','applicantCount'));
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

    public function viewApplicant(Request $request, $id)
    {
        $jobPosting = JobPosting::findOrFail($id);
        $applicants = Application::where('job_posting_id', $id)
            ->with('jobSeeker') // Assuming you have a relationship defined in Application model
            ->get();
        return view('employer.viewApplicant', ['jobPosting' => $jobPosting, 'applicants' => $applicants]);
    }

    public function viewApplicantDetails(Request $request, $id)
    {
        $user = JobSeeker::findOrFail($id);
        $applicantion_id = $request->aid;
        return view('employer.viewDetails', compact('user','applicantion_id'));
        
    }

    public function hireApplicant(Request $request, $id)
    {
       $user_id = $id;
       $applicantion_id = $request->aid;

       $application = Application::where('id', $applicantion_id)
        ->where('user_id', $user_id)
        ->first();

        if ($application) {
            $application->status = 'Hired';
            $application->save();

            $user = JobSeeker::where('id', $user_id)->first();

            $mailData = [
                'title' => 'Your application status has been changed!',
                'jobtitle' => $application->jobPosting->job_title,
                'status' => "Congratulations, You made it ",
                'body' => "Your application status has been changed to Hired, which indicates that there has been a development in the hiring process.",
            ];
    
            Mail::to($user->email)->send(new statusChange($mailData));
    
            return redirect()->back()->with('success', 'Applicant hired successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid application data.']);
        }


    }

    public function rejectApplicant(Request $request, $id)
    {
       $user_id = $id;
       $applicantion_id = $request->aid;

       $application = Application::where('id', $applicantion_id)
        ->where('user_id', $user_id)
        ->first();

        if ($application) {
            $application->status = 'Rejected';
            $application->save();

            $user = JobSeeker::where('id', $user_id)->first();

            $mailData = [
                'title' => 'Your application status has been changed!',
                'jobtitle' => $application->jobPosting->job_title,
                'status' => "Unfortunately, Employer did not select you for further considersation",
                'body' => "Your application status has been changed to Rejected, which indicates that there has been a development in the hiring process.",
            ];
    
            Mail::to($user->email)->send(new statusChange($mailData));
    
            return redirect()->back()->with('success', 'Applicant rejected successfully.');
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid application data.']);
        }


    }


}
