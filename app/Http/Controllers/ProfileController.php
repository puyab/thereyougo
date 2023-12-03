<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalInformationUpdateRequest;
use App\Http\Requests\Profile\DetailsUpdateRequest;
use App\Http\Requests\UpdateFeaturesRequest;
use App\Models\Profile;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use ProtoneMedia\Splade\Facades\Toast;

class ProfileController extends Controller
{

  public function updatePassword($user, string $password, string $currentPassword)
  {
    if (!Hash::check($currentPassword, $user->password)) {
      return 'Current password is not correct';
    }
    if (!User::query()->where('id', $user->id)->update(['password' => Hash::make($password)])) {
      return 'Failed to update the password';
    }
    return 'ok';
  }

  public function updatePersonalInformation(PersonalInformationUpdateRequest $request)
  {
    $profileData = $request->validationData();
    $email = $profileData['email'] ?? null;
    $password = $profileData['password'];
    $currentPassword = $profileData['current_password'];

    unset($profileData['_method'], $profileData['password'], $profileData['email'], $profileData['password_confirmation'], $profileData['current_password']);

    $user = Auth::user();

    $linkedinUrls = [$user->profile->linkedin, $user->profile->linkedin . '/'];

    if (!in_array($user->profile->linkedin, $linkedinUrls) && Profile::query()->whereIn('linkedin', $linkedinUrls)->count()) {
      Toast::danger('Linkedin url is already taken');
      return redirect()->back()->withErrors(['linkedin' => 'Linkedin url is already taken']);
    }

    if ($user->email !== $email && User::query()->where('email', $email)->count()) {
      Toast::danger('Email is already taken');
      return redirect()->back()->withErrors(['email' => 'Email is already taken']);
    }


    if (!Profile::query()->where('user_id', $user->id)->update($profileData)) {
      Toast::danger('Failed to update the personal information');
      return redirect()->back();
    }

    if ($email && !User::query()->where('id', $user->id)->update(['email' => $email])) {
      Toast::danger('Failed to update the email address');
      return redirect()->back();
    }

    if ($currentPassword && !$this->updatePassword($user, $password, $currentPassword)) {
      Toast::danger('Faild to update the passwords');
      return redirect()->back();
    }

    Toast::success('Personal Information updated successfully');
    return redirect()->route('profile.global');
  }

  public function updateDetails(DetailsUpdateRequest $request)
  {
    $data = $request->validationData();
    unset($data['_method']);
    $profile = Auth::user()->profile;
    if (Profile::find($profile->id)->update($data)) {
      if (!$profile->details_submitted)
        Profile::query()->where('id', $profile->id)->update(['details_submitted' => true]);
      $profile->refresh();
      Toast::success('Details updated successfully');
    } else
      Toast::danger('Details not updated');
    if (!$profile->canAccessProfile())
      return redirect()->back();
    return redirect()->route('profile.global');
  }

  public function updateFeatures(UpdateFeaturesRequest $request)
  {
    $data = $request->validationData();
    unset($data['_method']);
    $profile = Auth::user()->profile;
    if (Profile::find($profile->id)->update($data)) {
      Toast::success('Details updated successfully');
    } else
      Toast::danger('Details not updated');
    return redirect()->route('profile.global');
  }

  public function uploadImages(Request $request)
  {
    $validated = $request->validate([
      'avatar' => ['max:5000', 'nullable'],
      'pic_1' => ['max:5000', 'nullable'],
      'pic_2' => ['max:5000', 'nullable'],
      'pic_3' => ['max:5000', 'nullable'],
    ]);
    if (!$validated) {
      Toast::danger('Files you sent is bigger than 5mb');
      return redirect()->back();
    }
    $profile = Auth::user()->profile;
    try {
      foreach ($request->allFiles() as $key => $file) {
        $profile->clearMediaCollection($key);
        $profile->addMediaFromRequest($key)->toMediaCollection($key);
      }
      Toast::success('Images uploaded successfully');
    } catch (Exception $e) {
      Toast::danger('Images not uploaded');
    }
    return redirect()->route('profile.global');
  }

  public function notify()
  {
    Toast::success('URL Copied');
    return redirect()->back();
  }
}
