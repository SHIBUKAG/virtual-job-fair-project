<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;


class JobSeekerController extends Controller
{
    public function jobs()
    {
        $postedJobs = JobPosting::all();
        return view('jobs', compact('postedJobs'));
    }

    public function viewJobs(Request $request, $id)
    {
        $job = JobPosting::findOrFail($id);
        return view('jobDetails', compact('job'));
    }
}
