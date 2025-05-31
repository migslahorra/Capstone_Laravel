<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class MapController extends Controller
{
    /**
     * Display the map with properties having latitude and longitude.
     */
    public function showMap()
{
    $properties = Property::whereNotNull('latitude')
                          ->whereNotNull('longitude')
                          ->get();

    return view('map', compact('properties'));
}
}
