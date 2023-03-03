<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


//Route::get("packages-list", [\App\Http\Controllers\Api\PackageController::class, 'packagesList']);
Route::get("all-members-list", [\App\Http\Controllers\Api\MemberController::class, 'membersList']);
Route::get("defaulter-members-list", [\App\Http\Controllers\Api\MemberController::class, 'defaulterMembersFeeList']);
Route::get("active-members-list", [\App\Http\Controllers\Api\MemberController::class, 'activeMembersList']);
Route::get("new-members-list", [\App\Http\Controllers\Api\MemberController::class, 'newMembersList']);
Route::get("daily-members-fee-list", [\App\Http\Controllers\Api\MemberController::class, 'dailyMembersFeeList']);
Route::get("night-shift-members-list", [\App\Http\Controllers\Api\MemberController::class, 'nightShiftMembersList']);
Route::get("evening-shift-members-list", [\App\Http\Controllers\Api\MemberController::class, 'eveningShiftMembersList']);
Route::get("morning-shift-members-list", [\App\Http\Controllers\Api\MemberController::class, 'morningShiftMembersList']);


Route::get("store-api-status-and-date", [\App\Http\Controllers\Api\MemberController::class, 'storeStatusAndDate']);
