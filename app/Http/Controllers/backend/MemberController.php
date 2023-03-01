<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Member\CreateMemberRequest;
use App\Http\Requests\Member\UpdateMemberRequest;
use App\Models\Employee;

//use App\Models\Expense;
use App\Models\Member;

//use App\Models\Move;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MembersExport;
use App\Imports\MembersImport;

class MemberController extends Controller
{
    public function addMember()
    {
        //  id send for rollnumber autoincrement
        // latest get from created_at
        // first get first macthing row


        $getMemberId = DB::table('members')->where('belong_to_gym', Auth::user()->belong_to_gym)->latest('id')->first();

        $getPackageData = Package::where('belong_to_gym', Auth::user()->belong_to_gym)->get();

        if ($getMemberId != null) {
            foreach ($getMemberId as $getMemberIdVar) {
                $id = $getMemberIdVar;
                return view('backend.member.add-member', compact('id', 'getPackageData',));

            }
        } else {
            $id = 0;
            return view('backend.member.add-member', compact('id', 'getPackageData',));

        }


    }

    public function createMember(CreateMemberRequest $request)
    {

        $getMemberData = $request->all();

        // save member image
        $filename = '';
//        if ($request->hasFile('image')) {
//            $image = $request->file('image');
//            $path = public_path() . '/backend/images/member/profile/';
//            $filename = time() . $image->getClientOriginalName();
//            $image->move($path, $filename);
//            $request->image = $filename;
//        }

        $getMemberData['member_joining_date'] = Carbon::createFromFormat('m/d/Y', $request->member_joining_date)->format('Y-m-d');
        $getMemberData['member_fee_start_date'] = Carbon::createFromFormat('m/d/Y', $request->member_fee_start_date)->format('Y-m-d');
        $getMemberData['member_fee_end_date'] = Carbon::createFromFormat('m/d/Y', $request->member_fee_end_date)->format('Y-m-d');
        $getMemberData['belong_to_gym'] = Auth::user()->belong_to_gym;

        $memberData = Member::create($getMemberData);
//        if($request->image != null) {
//            $memberData->image = $filename;
//            $memberData->save();
//        }
        return redirect(route('addMember'))->with('success', 'Member added successfully.');


    }

    public function memberList()
    {
//        begin: for moving data one table to other
//        Move::query()
//            ->where('id','!=','0')
//            ->each(function ($oldPost) {
//                $newPost = $oldPost->replicate();
//                $newPost->setTable('members');
//                $newPost->save();
//
//            });

        //        end: for moving data one table to other


//        $memberData = DB::table("members")->paginate(100);
//        $memberData = DB::table("members")->select('*')->cursor();
//        $memberData = Member::select(['id'])->get();//
        //        $memberData = Member::all();
//        $packageData = Package::all();

//        $memberData =Member::select(['id','member_name','member_phone','member_package'])->limit(100)->get();

//               Cache::forever('mambers',Member::all());
//               Cache::put('mambers',$memberData = Member::all() );


//        $memberData = Member::where('gym_id', Auth::user()->gym_id)->get();
        $memberData = Member::where('belong_to_gym', Auth::user()->belong_to_gym)->get();


//                       if(Cache::missing('mambers')){
//                           Cache::put('mambers',Member::select(['id','member_name','member_phone'])->get(),now()->addSecond(20));
//                           $memberData = Cache::get('mambers');
//                       }else{
//                           $memberData = Cache::get('mambers');
//                       }


////           echo    Cache::get('mambers');
//        $memberData = Cache::remember('members',600,  function () {
////            return DB::table('members')->get();
////         return Member::select(['id','member_name','member_phone','member_package'])->get();
//            return Member::select(['id','member_name','member_phone','member_package'])->get();
//
////                return Member::where('id','>', '0')->get();
//
//
//
//        });
        return view('backend.member.member-list', compact('memberData'));
    }

    public function editMember($id)
    {
        $getPackageData = Package::where('belong_to_gym', Auth::user()->belong_to_gym)->get();
        $memberDataByID = Member::find($id);
        $getEmployeeData = Employee::where('belong_to_gym', Auth::user()->belong_to_gym)->where('employee_type', 'trainer')->get();


        return view('backend.member.edit-member', compact('memberDataByID', 'getPackageData', 'getEmployeeData'));

    }


    function updateMember(UpdateMemberRequest $request, Member $id)
    {

        $memberData = $request->all();
        // update member image
        if ($request->image != '') {
            $filename = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = public_path() . '/backend/images/member/profile/';
                $filename = time() . $image->getClientOriginalName();
                $image->move($path, $filename);
                $request->image = $filename;
                $image_path = "/backend/images/member/profile/";  // Value is not URL but directory file path
//               start: unlink old image
                if ($id->image != null) {
                    $oldImage = '/backend/images/member/profile/' . $id->image;
                    $oldImagePath = str_replace('\\', '/', public_path());
                    unlink($oldImagePath . $oldImage);
                }
//               end: unlink old image

            }
//            $memberData['member_joining_date'] = Carbon::createFromFormat('m/d/Y', $request->member_joining_date)->format('Y-m-d');
//            $memberData['member_fee_start_date'] = Carbon::createFromFormat('m/d/Y', $request->member_fee_start_date)->format('Y-m-d');
//            $memberData['member_fee_end_date'] = Carbon::createFromFormat('m/d/Y', $request->member_fee_end_date)->format('Y-m-d');

            $id->update($memberData);
            $id->image = $filename;
            $id->save();


        }

        if ($request->image == '' || $request->image == null) {
//            $request->image = $request->image_update;
//            $memberData['member_joining_date'] = Carbon::createFromFormat('m/d/Y', $request->member_joining_date)->format('Y-m-d');
//            $memberData['member_fee_start_date'] = Carbon::createFromFormat('m/d/Y', $request->member_fee_start_date)->format('Y-m-d');
//            $memberData['member_fee_end_date'] = Carbon::createFromFormat('m/d/Y', $request->member_fee_end_date)->format('Y-m-d');

            $id->update($memberData);

        }

//        return back()->with('success', 'Member info Updated.');

        return redirect()->route('memberList')->with('success', 'Member info Updated.');
    }

    public function memberExport()
    {
        // export members excel file from database

        // refference: https://docs.laravel-excel.com/3.1/exports/
        return Excel::download(new MembersExport, "members.xlsx", "Xlsx");
    }

//    public function memberImport(Request $request)
//    {
////        https://docs.laravel-excel.com/3.1/imports/
////        https://dev.to/techtoolindia/import-excel-file-into-laravel-8-3kif
//        Excel::import(new MembersImport, $request->file);
//        return redirect(route('memberList'))->with('success', 'All good!');
//    }

    public function updateMemberDate(Request $request)
    {
        $cdate = Carbon::parse(now()->format('Y-m-d'))->addMonths(-2);
        $cdate1 = now()->format('Y-m-d');
        $checkStatus = Member::where('belong_to_gym', Auth::user()->belong_to_gym)->where('member_phone', $request->member_phone)->where('member_fee_end_Date', '<', $cdate)->update(['member_fee_end_Date' => $cdate1]);
        $memberFind = Member::where('belong_to_gym', Auth::user()->belong_to_gym)->get();
        if ($request->member_phone == null) {
            return redirect()->route('addAttendance')->with('danger', 'Enter mobile number.');

        }

        foreach ($memberFind as $memberFindVar) {

//         if request phone is equal to member number it will store in old member table
            if ($memberFindVar->member_phone == $request->member_phone) {

                if ($checkStatus != null) {
                    return redirect()->route('addAttendance')->with('success', 'Member  added in attendance list.');

                } elseif ($checkStatus == null) {
                    return redirect()->route('addAttendance')->with('success', 'Member date already  added in attendance list.');

                }

            }
        }


        return redirect()->route('addAttendance')->with('danger', 'Member not found.');


    }

    public function personalTraining()
    {
        $personalTraining = Member::where('belong_to_gym', Auth::user()->belong_to_gym)->where('trainer', Auth::user()->name)->get();
        $packageData = Package::where('belong_to_gym', Auth::user()->belong_to_gym)->get();

        return view('backend.member.personal-training', compact('personalTraining', 'packageData'));
    }


}
