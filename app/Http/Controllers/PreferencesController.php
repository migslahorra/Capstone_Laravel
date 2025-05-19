<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property; // Make sure you have a Property model

class PreferencesController extends Controller
{
    /**
     * Show the form to upload a property.
     */
    public function create()
    {
        return view('preferences'); // Make sure resources/views/preferences.blade.php exists
    }
}