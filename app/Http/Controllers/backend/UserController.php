<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function addGym()
    {
        $getGymData = DB::table('users')->latest('gym_id')->first();
        $id = $getGymData->gym_id;
        return view('backend.gym-profile.add-gym', compact('id'));
    }

    public function createGym(Request $request)
    {
        $getData = $request->all();
        $filename = '';
        if ($request->hasFile('gym_logo')) {
            $image = $request->file('gym_logo');
            $path = public_path() . '/backend/images/gym/profile/';
            $filename = time() . $image->getClientOriginalName();
            $image->move($path, $filename);
            $request->gym_logo = $filename;
        }

        $getData['password'] = Hash::make($request->password);
        $getData['belong_to_gym'] = $request->gym_id;

        $userData = User::create($getData);
        if ($request->gym_logo != null) {
            $userData->gym_logo = $filename;
            $userData->save();
        }

        return redirect(route('addGym'))->with("success", 'Gym created successfully.');


    }

    public
    function gymList()
    {
        $gymData = User::where('gym_id', '!=', null)->get();
        return view('backend.gym-profile.gym-list', compact('gymData'));

    }

    public function editGym($gym_id)
    {
        $requestUserData = User::all();

        foreach ($requestUserData as $requestUserDataVar) {
            if ($requestUserDataVar->gym_id == $gym_id) {
                $userData = User::find($requestUserDataVar->id);
                return view('backend.gym-profile.edit-gym', compact('userData'));
            }
        }


    }

    public
    function addUser()
    {
        $countUserData = User::where('belong_to_gym', Auth::user()->gym_id)->count();
        return view('backend.user-profile.add-user', compact('countUserData'));

    }

    public
    function createUser(Request $request)
    {

        $userData = $request->all();
        $userData['belong_to_gym'] = Auth::user()->gym_id;
        $userData['password'] = Hash::make($request->password);
        User::create($userData);
        return redirect(route('addUser'))->with('success', "user Created.");
    }

    public
    function userList()
    {
        $usersData = User::where('gym_id', Auth::user()->gym_id)->OrWhere('belong_to_gym', Auth::user()->gym_id)->get();

        return view('backend.user-profile.users-list', compact('usersData'));
    }

    public
    function editUser($id)
    {

        $userData = User::find($id);

        return view('backend.user-profile.edit-user-profile', compact('userData'));

    }

    public
    function updateUser(Request $request, User $id)
    {

        $userData = $request->all();

        if (Auth::user()->type == 'owner') {
            $userData['belong_to_gym'] = '';
            $userData['password'] = Hash::make($request->password);
        } else {
            $userData['belong_to_gym'] = Auth::user()->gym_id;
            $userData['password'] = Hash::make($request->password);
        }
        // update member image
        if ($request->image != '') {
            $filename = '';
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = public_path() . '/backend/images/user/profile/';
                $filename = time() . $image->getClientOriginalName();
                $image->move($path, $filename);
                $request->image = $filename;
                $image_path = "/backend/images/user/profile/";  // Value is not URL but directory file path
//               start: unlink old image
                if ($id->image != null) {
                    $oldImage = '/backend/images/user/profile/' . $id->image;
                    $oldImagePath = str_replace('\\', '/', public_path());
                    unlink($oldImagePath . $oldImage);
                }
//               end: unlink old image

            }
            $userData['password'] = bcrypt($request->password);
            $id->update($userData);
            $id->image = $filename;
            $id->save();


        }

        if ($request->image == '' || $request->image == null) {

            $userData['password'] = bcrypt($request->password);
            $id->update($userData);

        }

//        return back()->with('success', 'Member info Updated.');

        return redirect()->route('userList')->with('success', 'User info Updated.');
    }
}
