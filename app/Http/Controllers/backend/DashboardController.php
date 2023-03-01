<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\FeeCollection;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {


//total members
        $totalMembers = Member::where('belong_to_gym', Auth::user()->belong_to_gym)->count();

        // active members percentage
        $cDate = now()->addDay(-10);
        $fee = Member::where('belong_to_gym', Auth::user()->belong_to_gym)->where('member_fee_end_date', '>', $cDate)->get()->count();
        if ($fee != null) {
            $percent = round($fee / $totalMembers * 100);

        } else {
            $percent = 0;

        }

        //total employee
        $totalEmployees = Employee::where('belong_to_gym', Auth::user()->belong_to_gym)->count();

        // active employee percentage
        $cDate = now()->addDay(-10);
        $employeeSalary = Employee::where('belong_to_gym', Auth::user()->belong_to_gym)->where('employee_salary_end_date', '>', $cDate)->get()->count();
        if ($employeeSalary != null) {
            $employeePercent = round($employeeSalary / $totalEmployees * 100);

        } else {
            $employeePercent = 0;

        }


        // Monthly Expense
        $currentDate = now();
        $monthlyExpense = Expense::where('belong_to_gym', Auth::user()->belong_to_gym)->whereMonth('created_at', $currentDate->month)->whereYear('created_at', $currentDate->year)->sum('expense_amount');
        // Daily Expense
        $dailyExpense = Expense::where('belong_to_gym', Auth::user()->belong_to_gym)->whereDay('created_at', $currentDate->day)->whereMonth('created_at', $currentDate->month)->whereYear('created_at', $currentDate->year)->sum('expense_amount');
        if ($monthlyExpense != null) {
            $expenseDailyPercent = round($dailyExpense / $monthlyExpense * 100);

        } else {
            $expenseDailyPercent = 0;

        }
        //Monthly Income
        $monthlyIncome = FeeCollection::where('belong_to_gym', Auth::user()->belong_to_gym)->whereMonth('created_at', $currentDate->month)->whereYear('created_at', $currentDate->year)->sum('amount_received');
        $dailyIncome = FeeCollection::where('belong_to_gym', Auth::user()->belong_to_gym)->whereDay('created_at', $currentDate->day)->whereMonth('created_at', $currentDate->month)->whereYear('created_at', $currentDate->year)->sum('amount_received');
        if ($monthlyIncome != null) {
            $incomeDailyPercent = round($dailyIncome / $monthlyIncome * 100);

        } else {
            $incomeDailyPercent = 0;

        }


        return view('backend.dashboard.dashboard', compact('totalMembers', 'fee', 'percent', 'totalEmployees', 'employeeSalary', 'employeePercent', 'monthlyExpense', 'dailyExpense', 'expenseDailyPercent', 'monthlyIncome', 'dailyIncome', 'incomeDailyPercent'));
    }
}
