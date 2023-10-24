<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateExpenseRequest;
use App\Jobs\SendMessage;
use App\Models\Expense;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function addExpense()
    {
//        // Assuming you have an array of member IDs or you can retrieve them from the database
//        $memberIds = Member::all();  // Replace with actual member IDs
//
//        $delay = Carbon::now()->addSeconds(10);
//
//        foreach ($memberIds as $memberId) {
//            dispatch((new SendMessage($memberId->id))->delay($delay));
//            $delay = $delay->addMinutes(1);  // Increase delay for each message
//        }

        return view('backend.expense.add-expense');
    }

    public function createExpense(CreateExpenseRequest $request)
    {
        $getExpenseData = $request->all();
        $getExpenseData['belong_to_gym'] = Auth::user()->belong_to_gym;

        Expense::create($getExpenseData);

        return redirect(route('addExpense'))->with('success', 'Expense added successfully.');
    }


    public function expenseList()
    {
        $expenseData = Expense::where('belong_to_gym', Auth::user()->belong_to_gym)->get();
        return view('backend.expense.expenses-list', compact('expenseData'));
    }

    public function editExpense($id)
    {

        $expenseData = Expense::find($id);
        return view('backend.expense.edit-expense', compact('expenseData'));

    }

    public function updateExpense(CreateExpenseRequest $request, Expense $id)
    {
        $getExpenseData = $request->all();

        $id->update($getExpenseData);
        return redirect(route('expenseList'))->with('success', 'Expense updated successfully.');

    }
}
