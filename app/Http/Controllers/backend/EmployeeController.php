<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\EmployeePackage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function addEmployee()
    {

        // id send for rollnumber autoincrement
        // latest get from created_at
        // first get first macthing row

        $getEmployeeId = DB::table('employees')->latest('id')->first();
        $getPackageData = EmployeePackage::all();

        if ($getEmployeeId != null) {
            foreach ($getEmployeeId as $getMemberIdVar) {
                $id = $getMemberIdVar;
                return view('backend.employee.add-employee', compact('id', 'getPackageData'));

            }
        } else {
            $id = 0;
            return view('backend.employee.add-employee', compact('id', 'getPackageData'));

        }


    }


    public function createEmployee(CreateEmployeeRequest $request)
    {
        $getEmployeeData = $request->all();

        // save employee image
        $filename = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = public_path() . '/backend/images/employee/profile/';
            $filename = time() . $image->getClientOriginalName();
            $image->move($path, $filename);
            $request->image = $filename;
        }

        $getEmployeeData['employee_joining_date'] = Carbon::createFromFormat('m/d/Y', $request->employee_joining_date)->format('Y-m-d');
        $getEmployeeData['employee_salary_start_date'] = Carbon::createFromFormat('m/d/Y', $request->employee_salary_start_date)->format('Y-m-d');
        $getEmployeeData['employee_salary_end_date'] = Carbon::createFromFormat('m/d/Y', $request->employee_salary_end_date)->format('Y-m-d');
        $getEmployeeData['belong_to_gym'] = Auth::user()->belong_to_gym;
        $employeeData = Employee::create($getEmployeeData);
        $employeeData->image = $filename;
        $employeeData->save();

        return redirect(route('addEmployee'))->with('success', 'Employee added successfully.');


    }

    public function employeeList()
    {
        $employeeData=  Employee::where('belong_to_gym', Auth::user()->belong_to_gym)->get();
//        $employeeData = DB::table("employees")->select('*')->cursor();
        $packageData = EmployeePackage::all();
        return view('backend.employee.employee-list', compact('employeeData', 'packageData'));

    }

    public function editEmployee($id)
    {
        $getPackageData = EmployeePackage::all();
        $employeeDataByID = Employee::find($id);

        return view('backend.employee.edit-employee', compact('employeeDataByID', 'getPackageData'));

    }

    function updateEmployee(UpdateEmployeeRequest $request, Employee $id)
    {

        $employeeData = $request->all();
        // update member image
        if ($request->image != '') {
            $filename = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = public_path() . '/backend/images/employee/profile/';
                $filename = time() . $image->getClientOriginalName();
                $image->move($path, $filename);
                $request->image = $filename;
                $image_path = "/backend/images/employee/profile/";  // Value is not URL but directory file path
//               start: unlink old image
                if ($id->image != null) {
                    $oldImage = '/backend/images/employee/profile/' . $id->image;
                    $oldImagePath = str_replace('\\', '/', public_path());
                    unlink($oldImagePath . $oldImage);
                }
//               end: unlink old image

            }

            $id->update($employeeData);
            $id->image = $filename;
            $id->save();


        }

        if ($request->image == '' || $request->image == null) {
//            $request->image = $request->image_update;

            $id->update($employeeData);

        }


        return redirect()->route('employeeList')->with('success', 'Employee info Updated.');
    }
}
