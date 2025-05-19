<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'LandSeek: ' . ucfirst(Auth::user()->role) . "'s Saved Properties" }}
        </h2>
    </x-slot>

    <footer style="position: fixed; bottom: 15px; width: 100%; text-align: center; color: white;">
        <p>&copy; 2025 Landseek: A Digital Marketplace for Land Hunting. All Rights Reserved.</p>
    </footer>
</x-app-layout>