<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ 'LandSeek: ' . ucfirst(Auth::user()->role) . "'s Map Navigation" }}
    </h2>
</x-slot>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Legazpi City Map</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="map"></div>

    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        var map = L.map('map').setView([13.1391, 123.7438], 13); // Coordinates of Legazpi City

        // Load and display tile layer from OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Optional: Add a marker
        L.marker([13.1391, 123.7438]).addTo(map)
            .bindPopup('Legazpi City, Albay')
            .openPopup();
    </script>
</body>
</html>

</x-app-layout>

