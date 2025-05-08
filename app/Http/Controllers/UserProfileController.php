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
        // Get the authenticated user
        $user = Auth::user();

        // Validate the input data
        $validated = $request->validate([
            'firstname'     => 'required|string|max:255',
            'middlename'    => 'nullable|string|max:255',
            'lastname'      => 'required|string|max:255',
            'suffix'        => 'nullable|string|max:10',
            'phonenumber'   => 'required|string|max:20',
            'bio'           => 'nullable|string|max:1000',
            'profile_picture' => 'nullable|image|max:2048', // Image validation
        ]);

        // Get or create the user_profile record
        $profile = UserProfile::firstOrNew(['user_id' => $user->id]);

        // Handle profile image upload if exists
        if ($request->hasFile('profile_picture')) {
            // Store the new image
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');

            // Delete old profile image if exists
            if ($profile->profile_picture) {
                Storage::disk('public')->delete($profile->profile_picture);
            }

            // Save the new image path
            $profile->profile_picture = $imagePath;
        }

        // Update other profile fields
        $profile->firstname   = $validated['firstname'];
        $profile->middlename  = $validated['middlename'] ?? null;
        $profile->lastname    = $validated['lastname'];
        $profile->suffix      = $validated['suffix'] ?? null;
        $profile->phonenumber = $validated['phonenumber'];
        $profile->bio         = $validated['bio'] ?? null;

        // Ensure user_id is set
        $profile->user_id = $user->id;
        
        // Save the profile to the database
        $profile->save();

        // Return with a success message
        return redirect()->back()->with('status', 'user_profiles-updated');
    }
}
