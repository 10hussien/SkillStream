<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Models\User;
use App\utils\translate;
use App\utils\uploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{


    public function addProfile(ProfileRequest $request)
    {
        $profile = $request->all();

        if ($request->hasFile('personal_photo')) {

            $profile['personal_photo'] = (new uploadImage)->uploadimage($request->personal_photo);
        }
        $profile['user_id'] = Auth::id();

        Profile::create($profile);

        return response()->json((new translate)->translate('add profile has been successfully'));
    }

    public function showMyProfile()
    {
        $myProfile = Profile::Profile(Auth::id());

        if ($myProfile == 'User not found' || $myProfile == 'Profile not found') {

            return response()->json((new translate)->translate($myProfile));
        }

        // $filteredProfile = array_filter($myProfile->toArray(), function ($value) {

        //     return !is_null($value);
        // });


        $myProfile->profile->personal_photo = Profile::Link($myProfile->profile->personal_photo);


        return response()->json($myProfile);
    }

    public function showProfile($id)
    {
        $myProfile = Profile::Profile($id);

        if ($myProfile == 'User not found' || $myProfile == 'Profile not found') {

            return response()->json((new translate)->translate($myProfile));
        }

        // $filteredProfile = array_filter($profile->toArray(), function ($value) {
        //     return !is_null($value);
        // });

        $myProfile->profile->personal_photo = Profile::Link($myProfile->profile->personal_photo);

        return response()->json($myProfile);
    }




    public function updateProfile(Request $request)
    {
        $myProfile = Profile::Profile(Auth::id());

        if ($myProfile == 'User not found' || $myProfile == 'Profile not found') {
            return response()->json((new translate)->translate($myProfile));
        }

        $profile = $myProfile->profile;


        $myProfile->update($request->all());
        $myProfile->save();

        $profile->update($request->all());

        if ($request->hasFile('personal_photo')) {

            $profile['personal_photo'] = (new uploadImage)->uploadimage($request->personal_photo);

            $profile->save();
        }



        return response()->json((new translate)->translate('update profile has been successfully'));
    }


    public function deleteProfile()
    {
        $myProfile = Profile::Profile(Auth::id());

        if ($myProfile == 'User not found' || $myProfile == 'Profile not found') {

            return response()->json((new translate)->translate($myProfile));
        } else {

            $myProfile->profile->delete();

            return response()->json((new translate)->translate('delete profile has been successfully'));
        }
    }
}
