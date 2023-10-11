<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\DetailsUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdateFeaturesRequest;
use App\Models\Profile;
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
        $images = Auth::user()->profile->images;
        foreach ($request->allFiles() as $key => $file) {
            $name = now()->unix() . '-' . $file->getClientOriginalName();
            Storage::disk('public')->put('images/' . $name, file_get_contents($file));
            $images[$key] = 'storage/images/' . $name;
        }
        if (Profile::query()->where('user_id', Auth::user()->id)->update(['images' => $images]))
            Toast::success('Images uploaded successfully');
        else Toast::danger('Images not uploaded');
        return redirect()->back();
    }
}
