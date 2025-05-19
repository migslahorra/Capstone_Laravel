<style>
    .header {
        display: flex;
        justify-content: space-between;
    }
</style>
<!-- Include Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ 'LandSeek: ' . ucfirst(Auth::user()->role) . "'s Dashboard" }}
        </h2>
    </x-slot>

    <! -- Seller Dashboard (Can only be displayed if logged in user is a seller) -->
    @auth
        @if (Auth::user()->role === 'Seller')
            <div class="recent-activity">
                <div class="seller-recent-activity">
                    <h2><i class="fa-solid fa-clock"></i> Recent Activity</h2>
                    <ul>
                        
                    </ul>
                </div>
            </div>
        @endif
    @endauth

    <! -- Buyer Dashboard (Can only be displayed if logged in user is a buyer) -->
    @auth
        @if (Auth::user()->role === 'Buyer')
            <div class="recent-activity">
                <div class="buyer-recent-activity">
                    <h2 style="color: white; margin: 5%; background-color: #1f2937; padding: 20px; width: 200px; border-radius: 10px;"><i class="fa-solid fa-clock" style="margin-right: 10px"></i> Recent Activity</h2>
                    <ul>
                        
                    </ul>
                </div>
            </div>
        @endif
    @endauth

    <! -- Buyer Dashboard (Can only be displayed if logged in user is a buyer) -->
    @auth
        @if (Auth::user()->role === 'Buyer')
            <div class="recent-activity">
                <div class="buyer-recent-activity">
                    <h2 style="color: white; margin: 5%; background-color: #1f2937; padding: 20px; width: 300px; border-radius: 10px;"><i class="fa-solid fa-eye" style="margin-right: 10px;"></i> Recently  Viewed Properties</h2>
                    <ul>
                        
                    </ul>
                </div>
            </div>
        @endif
    @endauth

    <! -- Buyer Dashboard (Can only be displayed if logged in user is a Buyer and Seller) -->
    @auth
        @if (Auth::user()->role === 'Buyer and Seller')
            <div class="recent-activity">
                <div class="seller-recent-activity">
                    <h2><i class="fa-solid fa-clock"></i> Recent Activity</h2>
                    <ul>
                        
                    </ul>
                </div>
            </div>
        @endif
    @endauth

</x-app-layout>
