<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Property;

class PropertyController extends Controller
{
    /**
     * Show the form to upload a property.
     */
    public function create()
    {
        return view('upload-property-form');
    }

    /**
     * Store a new property.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_range' => 'required|numeric',
            'area' => 'required|numeric',
            'address' => 'required|string|max:255',    // Added validation
            'street' => 'required|string|max:255',
            'purok' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|string|in:available,sold,pending',
        ]);

        // Ensure the uploads directory exists
        $uploadPath = public_path('uploads');
        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        // Handle image upload
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $originalName = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $image->getClientOriginalName());
                $filename = time() . '_' . uniqid() . '_' . $originalName;
                $image->move($uploadPath, $filename);
                $imagePaths[] = $filename;
            }
        }

        // Create property with authenticated user ID, include address
        $property = Property::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'price_range' => $validated['price_range'],
            'area' => $validated['area'],
            'address' => $validated['address'],    
            'street' => $validated['street'],
            'purok' => $validated['purok'] ?? null,
            'city' => $validated['city'],
            'province' => $validated['province'],
            'country' => $validated['country'],
            'postal_code' => $validated['postal_code'],
            'status' => $validated['status'],
            'images' => json_encode($imagePaths),
        ]);

        return redirect()->route('map')->with('success', 'Property uploaded successfully!');
    }
}