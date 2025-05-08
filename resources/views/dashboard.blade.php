<style>
    .header {
        display: flex;
        justify-content: space-between;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'LandSeek: ' . ucfirst(Auth::user()->role) . "'s Dashboard" }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-auto">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <b>
                    {{ __("You're logged in as " . ucfirst(optional(Auth::user()->profile)->firstname)) }}
                </b><br>
                Welcome Back {{ ucfirst(Auth::user()->role) }}!
            </div>
        </div>
    </div>
</div>


    <! -- Buyer Dashboard (Can only be displayed if logged in user is a buyer) -->
    @auth
        @if (Auth::user()->role === 'Buyer')
            <div class="recent-activity">
                <div class="buyer-recent-activity">
                    <h2>Recent Activity</h2>
                    <ul>
                        {{-- List buyer's recent activities here --}}
                    </ul>
                </div>
            </div>
        @endif
    @endauth

    <! -- Seller Dashboard (Can only be displayed if logged in user is a seller) -->
    @auth
        @if (Auth::user()->role === 'Seller')
            <div class="recent-activity">
                <div class="seller-recent-activity">
                    <h2>Recent Activity</h2>
                    <ul>
                        {{-- List seller's recent activities here --}}
                    </ul>
                </div>
            </div>
        @endif
    @endauth

</x-app-layout>
