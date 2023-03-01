<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\Expense;
use App\Models\FeeCollection;
use App\Models\Member;
use App\Models\MemberAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{

    public function reports()
    {
//        $cdata = now()->format('Y-m-d');
//        $memberData = Member::where('member_gender', 'female')->update(
////        $memberData = DB::table("members")->where('member_gender', 'female')->update(
//            ['member_fee_start_date' => $cdata,
//                'member_fee_end_date' => $cdata,
//                'member_joining_date' => $cdata,]
//        );

        return view('backend.reports.reports-list');
    }

    public function activeMembersList()
    {
        $cDate = now()->addDay(-15);
        $activeMembers = Member::where('belong_to_gym', Auth::user()->belong_to_gym)->where('member_fee_end_date', '>', $cDate)->get();
        return view('backend.reports.active-members-list', compact('activeMembers'));
    }

    public function defaulterMembersList()
    {
        $cDate = now()->addDay(-15);
        $currentDate = now();
//        $memberData = Member::where('member_fee_end_date', '<', $cDate)->get();
//        $defaulterMembers = MemberAttendance::where('member_fee_end_date', '<', $cDate)->whereMonth('created_at', $cDate->month)->whereYear('created_at', $cDate->year)->get();
        $activeMembers = Member::where('belong_to_gym', Auth::user()->belong_to_gym)->where('member_fee_end_date', '>', $cDate)->get();

        return view('backend.reports.defaulter-members-list', compact('activeMembers', 'currentDate'));

    }

    public function employeeAttendanceList()
    {
        $employeeAttendanceData = EmployeeAttendance::where('belong_to_gym', Auth::user()->belong_to_gym)->get();
        return view('backend.reports.employee-attendance-report', compact('employeeAttendanceData'));

    }

    public function memberAttendanceReport()
    {
        $memberAttendanceData = MemberAttendance::where('belong_to_gym', Auth::user()->belong_to_gym)->get();
        return view('backend.reports.member-attendance-report', compact('memberAttendanceData'));

    }

    public function incomeReport()
    {
        $incomeData = FeeCollection::where('belong_to_gym', Auth::user()->belong_to_gym)->get();
        return view('backend.reports.income-report', compact('incomeData'));
    }


    public function expenseReport()
    {
        $expenseData = Expense::where('belong_to_gym', Auth::user()->belong_to_gym)->get();
        return view('backend.reports.expense-report', compact('expenseData'));

    }

    public function dailyMemberAttendance()
    {
        $currentDate = now();
        $dailyMemAttendanceData = MemberAttendance::where('belong_to_gym', Auth::user()->belong_to_gym)->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->whereDay('created_at', $currentDate->day)->get();
        $memberData = Member::where('belong_to_gym', Auth::user()->belong_to_gym)->get();
        //        dd($dailyEmpAttendanceData);
        return view('backend.reports.daily-member-attendance-report', compact('dailyMemAttendanceData', 'memberData'));
    }

    public function dailyEmployeeAttendance()
    {
        $currentDate = now();
        $dailyEmpAttendanceData = EmployeeAttendance::where('belong_to_gym', Auth::user()->belong_to_gym)->whereYear('created_at', $currentDate->year)->whereMonth('created_at', $currentDate->month)->whereDay('created_at', $currentDate->day)->get();
//        dd($dailyEmpAttendanceData);
        return view('backend.reports.daily-employee-attendance-report', compact('dailyEmpAttendanceData'));
    }
}
