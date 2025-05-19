<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserProfile;

class UserProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate form input
        $validated = $request->validate([
            'firstname'       => 'required|string|max:255',
            'middlename'      => 'nullable|string|max:255',
            'lastname'        => 'required|string|max:255',
            'suffix'          => 'nullable|string|max:10',
            'phonenumber'     => 'required|string|max:20',
            'profile_image'   => 'nullable|image|mimes:jpeg,jpg,png|max:2048', // Match field name from form
        ]);

        $profile = UserProfile::firstOrNew(['user_id' => $user->id]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if it exists
            if ($profile->profile_picture) {
                Storage::disk('public')->delete($profile->profile_picture);
            }

            // Store new image
            $imagePath = $request->file('profile_image')->store('profile_pictures', 'public');
            $profile->profile_picture = $imagePath;
        }

        // Assign validated fields
        $profile->firstname     = $validated['firstname'];
        $profile->middlename    = $validated['middlename'] ?? null;
        $profile->lastname      = $validated['lastname'];
        $profile->suffix        = $validated['suffix'] ?? null;
        $profile->phonenumber   = $validated['phonenumber'];
        $profile->user_id       = $user->id;

        $profile->save();

        return redirect()->back()->with('status', 'user_profiles-updated');
    }
}