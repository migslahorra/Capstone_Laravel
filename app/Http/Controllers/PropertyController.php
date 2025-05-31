<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->latest()
            ->paginate(5);

        return view('properties', compact('properties'));
    }
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
        // Validate the incoming request including latitude and longitude
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_range' => 'required|decimal:0,2',
            'area' => 'required|numeric',
            'address' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'purok' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
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

        // Create property with authenticated user ID
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
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'status' => $validated['status'],
            'images' => json_encode($imagePaths),
        ]);

        // 🔁 Redirect to the correct route or view name for the map
        return redirect()->route('map')->with('success', 'Property uploaded successfully!');
    }

    /**
     * Display the map with all properties marked.
     */
    public function showMap()
    {
        $properties = Property::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('map', compact('properties'));
    }
}