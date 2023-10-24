<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Jobs\SendMessage;
use App\Models\Member;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function addMessage()
    {
        $cDate = Carbon::parse(now())->addMonth(1)->format('Y-m-d');
        $getData = Message::where('belong_to_gym', Auth::user()->gym_id)
            ->whereRaw('DATE(created_at) < ?', [$cDate])  // Compare with date part only
            ->orderBy('created_at', 'desc')
            ->first();

        // Always pass the variable to the view
        return view('backend.message.add-message', compact('getData'));
    }


    public function createMessage(Request $request)
    {
        $allData = $request->all();
        $allData['belong_to_gym'] = Auth::user()->gym_id;

        if ($request->hasFile('message_url')) {
            $image = $request->file('message_url');
            $path = public_path() . '/backend/images/message/media/';
            $filename = time() . $image->getClientOriginalName();
            $image->move($path, $filename);
            $allData['message_url'] = $filename;  // Assign the 'message_url' to the $allData array
        }

        Message::create($allData);

        // Assuming you have an array of member IDs or you can retrieve them from the database
        $memberIds = Member::all();  // Replace with actual member IDs

        $delay = Carbon::now()->addSeconds(10);

        foreach ($memberIds as $memberId) {
            dispatch((new SendMessage($memberId->id))->delay($delay));
            $delay = $delay->addMinutes(1);  // Increase delay for each message
        }

        return redirect(route('addMessage'))->with('success', 'Message successfully scheduled for monthly.');
    }

}
