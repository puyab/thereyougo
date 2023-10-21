<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\DetailsUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdateFeaturesRequest;
use App\Models\Profile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\Splade\Facades\Toast;

class ProfileController extends Controller
{
  public function updateDetails(DetailsUpdateRequest $request)
  {
    $data = $request->validationData();
    unset($data['_method']);
    $profile = Auth::user()->profile;
    if (Profile::query()->where('id', $profile->id)->update($data)) {
      if(!$profile->details_submitted)
        Profile::query()->where('id', $profile->id)->update(['details_submitted' => true]);
      Toast::success('Details updated successfully');
    }
    else Toast::danger('Details not updated');
    return redirect()->route('profile.global');
  }

  public function updateFeatures(UpdateFeaturesRequest $request)
  {
    $data = $request->validationData();
    unset($data['_method']);
    $profile = Auth::user()->profile;
    if (Profile::query()->where('id', $profile->id)->update($data)) {
      if(!$profile->features_submitted)
        Profile::query()->where('id', $profile->id)->update(['features_submitted' => true]);
      Toast::success('Details updated successfully');
    } else Toast::danger('Details not updated');
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
    try {
      $profile = Auth::user()->profile;
      foreach ($request->allFiles() as $key => $file) {
        $profile->clearMediaCollection($key);
        $profile->addMediaFromRequest($key)->toMediaCollection($key);
      }
      if (!$profile->pictures_submitted)
        Profile::query()->where('id', $profile->id)->update(['pictures_submitted' => true]);
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
