<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'LandSeek: Listed Properties for ' . ucfirst(Auth::user()->role) . "s" }}
        </h2>
    </x-slot>
</x-app-layout>