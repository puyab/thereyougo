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
    if (Profile::query()->where('user_id', Auth::user()->id)->update($data))
      Toast::success('Details updated successfully');
    else Toast::danger('Details not updated');
    return redirect()->back();
  }

  public function updateFeatures(UpdateFeaturesRequest $request)
  {
    $data = $request->validationData();
    unset($data['_method']);
    if (Profile::query()->where('user_id', Auth::user()->id)->update($data))
      Toast::success('Details updated successfully');
    else Toast::danger('Details not updated');
    return redirect()->back();
  }

  public function uploadImages(Request $request)
  {
    try {
      $profile = Auth::user()->profile;
      foreach ($request->allFiles() as $key => $file) {
        $profile->clearMediaCollection($key);
        $profile->addMediaFromRequest($key)->toMediaCollection($key);
      }
      Toast::success('Images uploaded successfully');
    } catch(Exception $e) {
      Toast::danger('Images not uploaded');
    }
    return redirect()->back();
  }
}
