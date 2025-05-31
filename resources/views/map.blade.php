<x-app-layout>
    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>

    <div id="map" data-properties='@json($properties)'></div>

    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
    var mapDiv = document.getElementById('map');
    var propertyData = JSON.parse(mapDiv.getAttribute('data-properties'));

    // Helper functions
    function formatPrice(price) {
        return parseFloat(price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }

    function escapeHtml(unsafe) {
        return unsafe
            .toString()
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    // Configure Leaflet default icons
    delete L.Icon.Default.prototype._getIconUrl;
    L.Icon.Default.mergeOptions({
        iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
        iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
        shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    // Initialize map
    var map = L.map('map').setView([13.1391, 123.7438], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
    }).addTo(map);

    var bounds = [];

    propertyData.forEach(function(property) {
        if (property.latitude && property.longitude) {
            var lat = parseFloat(property.latitude);
            var lng = parseFloat(property.longitude);
            var marker = L.marker([lat, lng]).addTo(map);

            var popup = `
                <div style="min-width: 200px">
                    <strong>${escapeHtml(property.title)}</strong><br>
                    Price: ₱${formatPrice(property.price_range)}<br>
                    Area: ${property.area} sqm<br>
                    ${escapeHtml(property.address || '')}, 
                    ${escapeHtml(property.city || '')}, 
                    ${escapeHtml(property.province || '')}
                </div>
            `;

            marker.bindPopup(popup);
            bounds.push([lat, lng]);
        }
    });

    if (bounds.length) {
        map.fitBounds(bounds, { padding: [50, 50] });
    }
});
    </script>
</x-app-layout>
