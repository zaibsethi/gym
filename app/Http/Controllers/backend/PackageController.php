<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePackageRequest;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function addPackage()
    {

        return view('backend.package.add-package');


    }

    public function createPackage(CreatePackageRequest $request)
    {
        $getPackageRequestData = $request->all();
        $getPackageRequestData['belong_to_gym'] = Auth::user()->belong_to_gym;
        Package::create($getPackageRequestData);
        return redirect(route('addPackage'))->with('success', 'Package created successfully.');
    }

    public function packagesList()
    {
        $packageData = Package::where('belong_to_gym', Auth::user()->belong_to_gym)->get();
        return view('backend.package.packages-list', compact('packageData'));

    }

    public function editPackage($id)
    {
        $editPackageData = Package::find($id);
        return view('backend.package.edit-package', compact('editPackageData'));
    }

    public function updatePackage(CreatePackageRequest $request, Package $id)
    {


        $getPackageRequestData = $request->all();
        $id->update($getPackageRequestData);

        return redirect(route('packagesList'))->with('success', 'Package updated successfully.');
    }
}
