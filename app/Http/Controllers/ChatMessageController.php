<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;
use App\Models\Employer;
use App\Models\JobSeeker;
use App\Models\Application;
use App\Models\Chat ;
use Illuminate\Support\Facades\Auth;

class ChatMessageController extends Controller
{
    public function showChats(Request $request, $id)
    {
        $employer = Auth::guard('employer')->user();
        $aid = $request->aid;
        $jid = $id;
        $ids = ([
            'application_id' => $aid,
            'jobseeker_id' => $jid,
            'employer_id' => $employer->id,
        ]);

        session(['chat_ids' => $ids]);

        $chats = Chat::where('jobseeker_id', $jid)
        ->where('application_id', $aid)
        ->where('employer_id', $employer->id)
        ->get();
    

        session(['chat_messages' => $chats]);

        return view('employer.chat');
    }

    public function sendchatEmp(Request $request)
    {
        $sendchatEmp = new Chat();
        $sendchatEmp->application_id = session('chat_ids.application_id');
        $sendchatEmp->jobseeker_id = session('chat_ids.jobseeker_id');
        $sendchatEmp->employer_id = session('chat_ids.employer_id');
        $sendchatEmp->message = $request->message;
        $sendchatEmp->save();

        session([
            'chat_ids.application_id' => $sendchatEmp->application_id,
            'chat_ids.jobseeker_id' => $sendchatEmp->jobseeker_id,
            'chat_ids.employer_id' => $sendchatEmp->employer_id,
        ]);

        return redirect('/chat');


    }

    public function reChats()
    {
        $chats = Chat::where('jobseeker_id', session('chat_ids.jobseeker_id'))
        ->where('application_id', session('chat_ids.application_id'))
        ->where('employer_id', session('chat_ids.employer_id'))
        ->get();
    

        session(['chat_messages' => $chats]);
        return view('employer.chat');
    }

    public function showMessage(Request $request)
    {
        $eid = $request->eid;
        $aid = $request->aid;

        $jobseeker = Auth::guard('job_seeker')->user();

        $chats = Chat::where('jobseeker_id', $jobseeker->id)
        ->where('application_id', $aid)
        ->where('employer_id', $eid)
        ->get();

        return view('showMessages', compact('chats'));

    }
}
