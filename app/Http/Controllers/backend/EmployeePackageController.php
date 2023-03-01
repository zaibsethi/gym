<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeePackage;
use App\Http\Requests\CreatePackageRequest;
use App\Models\Employee;
use App\Models\EmployeePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeePackageController extends Controller
{
    public function addEmployeePackage()
    {
        return view('backend.employee-package.add-employee-package');
    }

    public function createEmployeePackage(CreateEmployeePackage $request)
    {
        $getPackageRequestData = $request->all();
        $getPackageRequestData['belong_to_gym'] = Auth::user()->belong_to_gym;

        EmployeePackage::create($getPackageRequestData);
        return redirect(route('addEmployeePackage'))->with('success', 'Package created successfully.');
    }

    public function employeePackagesList()
    {

        $packageData=  EmployeePackage::where('belong_to_gym', Auth::user()->belong_to_gym)->get();
        return view('backend.employee-package.employee-packages-list', compact('packageData'));

    }

    public function editEmployeePackage($id)
    {
        $editPackageData = EmployeePackage::find($id);
        return view('backend.employee-package.edit-employee-package', compact('editPackageData'));
    }

    public function updateEmployeePackage(CreatePackageRequest $request, EmployeePackage $id)
    {
        $getPackageRequestData = $request->all();
        $id->update($getPackageRequestData);

        return redirect(route('employeePackagesList'))->with('success', 'Package updated successfully.');
    }
}
