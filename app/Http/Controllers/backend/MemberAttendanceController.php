<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberAttendance;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberAttendanceController extends Controller
{
    public function addAttendance()
    {
        $cdate = Carbon::now()->addDay(-20)->format('Y-m-d');
//        $memberData = DB::table("members")->where('member_fee_end_date', '>', $cdate)->cursor();
//        $memberData = Member::where('member_fee_end_date', '>', $cdate)->cursor();
//        $memberData = DB::table('members')->orderBy('id')->where('member_fee_end_date', '>', $cdate)->skip(0)->take(1000)->get();;
        $memberData = Member::where('belong_to_gym', Auth::user()->belong_to_gym)->where('member_fee_end_date', '>', $cdate)->get();
//        $memberData = Member::all();
        $packageData = Package::all();

        return view('backend.member-attendance.add-attendance', compact('memberData', 'packageData'));

    }

    public function createMemberAttendance(Request $request)
    {
        //for already marked attendance
        $allAttendanceData = MemberAttendance::where('belong_to_gym', Auth::user()->belong_to_gym)->get();
        $cDate = Carbon::now()->format('Y-m-d');

        foreach ($allAttendanceData as $allAttendanceDataVar) {
//            get created_at from db and convert the format date only and compare
            $createdAtFromDb = Carbon::parse($allAttendanceDataVar->created_at)->format('Y-m-d');
            if ($createdAtFromDb == $cDate && $allAttendanceDataVar->member_name == $request->member_name) {
                return redirect()->route('addAttendance')->with('success', 'Attendance Already Marked.');
            }
        }
        $getMemberAttendanceData = $request->all();
        $getMemberAttendanceData['belong_to_gym'] = Auth::user()->belong_to_gym;
        MemberAttendance::create($getMemberAttendanceData);

        if (($cDate) < ($request->member_fee_end_date)) {
            return redirect(route('addAttendance'))->with('success', 'Attendance Marked. Fee Paid.');

        } else {
            $gymData = User::where('belong_to_gym', Auth::user()->belong_to_gym)->where('gym_package','=', 'paid')->get();
             if ($gymData->contains('gym_package', 'paid')) {
                $url = "http://whatsapp247.com/api/send.php";
                $parameters = array("api_key" => "923092018911-f5b7824d-586c-489d-95e8-881aad1edc57",
                    "mobile" => "923044750336",
                    "message" => "test",
                    "priority" => "10",
                    "type" => 1, // Set type to 1 for image
                    "url" => "https://www.simplilearn.com/ice9/free_resources_article_thumb/what_is_image_Processing.jpg", // URL to your image
                    "caption" => "This is the image caption" // Optional image caption
                );

                $ch = curl_init();
                $timeout = 30;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
                curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
                $response = curl_exec($ch);
                curl_close($ch);

                echo $response;

                return redirect(route('addAttendance'))->with('danger', 'Messages send.Attendance Marked. Please Pay your fee.');

            } else {
                return redirect(route('addAttendance'))->with('danger', 'Attendance Marked. Please Pay your fee.');

            }


        }
    }

    public function singleMemberAttendanceList(Request $request)
    {
        //get id from request and send specific member Attendance list
        $memberData = MemberAttendance::where('belong_to_gym', Auth::user()->belong_to_gym)->where('member_id', $request->member_id)->get();
        return view('backend.member-attendance.single-member-attendance-list', compact('memberData'));
    }

    public function addAttendanceById()
    {
        return view('backend.member-attendance.add-attendance-by-Id');
    }

    public function createMemberAttendanceById(Request $request)
    {
        $memberAttendance = MemberAttendance::where('belong_to_gym', Auth::user()->belong_to_gym)->get();
        $cDate = Carbon::now()->format('Y-m-d');
        foreach ($memberAttendance as $memberAttendanceVar) {
//            get created_at from db and convert the format date only and compare
            $createdAtFromDb = Carbon::parse($memberAttendanceVar->created_at)->format('Y-m-d');
            if ($createdAtFromDb == $cDate && $memberAttendanceVar->member_id == $request->member_id) {
                return redirect()->route('addAttendanceById')->with('success', 'Dear' . " " . $memberAttendanceVar->member_name . " your id is: " . $memberAttendanceVar->member_id . " your fee date is: " . $memberAttendanceVar->member_fee_end_date);
            }
        }
        $cDate1 = Carbon::now()->addDays(-10);
        $allAttendanceData = Member::where('belong_to_gym', Auth::user()->belong_to_gym)->where('member_fee_end_Date', '>', $cDate1)->get();

        foreach ($allAttendanceData as $allAttendanceDataVar) {

            if ($allAttendanceDataVar->id == $request->member_id) {
                $markAttendance = Member::find($request->member_id)->toArray();
                $markAttendance['member_id'] = $request->member_id;
                $markAttendance['created_at'] = $cDate;
                $markAttendance['updated_at_at'] = $cDate;
                $markAttendance['belong_to_gym'] = Auth::user()->belong_to_gym;
                MemberAttendance::create($markAttendance);
                $currentDate = now()->addDays(3)->format('Y-m-d');
                if (($currentDate) < ($allAttendanceDataVar->member_fee_end_date)) {
                    return redirect()->route('addAttendanceById')->with('success', 'Dear' . " " . $allAttendanceDataVar->member_name . " your id is: " . $allAttendanceDataVar->id . " your fee date is: " . $allAttendanceDataVar->member_fee_end_date);
                } else {
                    return redirect()->route('addAttendanceById')->with('danger', 'Dear' . " " . $allAttendanceDataVar->member_name . " your id is: " . $allAttendanceDataVar->id . " your fee date is: " . $allAttendanceDataVar->member_fee_end_date);
                }
            }
        }
        return redirect()->route('addAttendanceById')->with('danger', "Member not Found.");
    }

    public function updateMemberFeeDate(Request $request)
    {
        $getRequest = $request->all();
        $mem = Member::where('belong_to_gym', Auth::user()->belong_to_gym)->where('member_phone', $request->member_phone)->get();
        foreach ($mem as $memVar) {

            return redirect()->route('addAttendanceById')->with('success', $memVar->member_name . '(' . $memVar->id . ')');

        }

        return redirect()->route('addAttendanceById')->with('success', 'not found');


    }

}

