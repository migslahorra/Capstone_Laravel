<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'LandSeek: ' . ucfirst(Auth::user()->role) . "'s List of Properties" }}
        </h2>
    </x-slot>

    {{-- Upload Property Button --}}
    @auth
        @if (Auth::user()->role === 'Seller')
            <div>
                <a href="{{ route('upload.property.form') }}" style="background-color: #1E2633; color: white; font-weight: bold; padding: 15px; position: absolute; margin-left: 5%; margin-top: 2.5%; border-radius: 5px; border: 1px solid grey;">            <i class="fas fa-plus" style="margin-right: 10px; color: white;"></i> Upload My Property
                </a>
            </div>
        @endif
    @endauth

    <footer style="position: fixed; bottom: 15px; width: 100%; text-align: center; color: white;">
        <p>&copy; 2025 Landseek: A Digital Marketplace for Land Hunting. All Rights Reserved.</p>
    </footer>
</x-app-layout>
