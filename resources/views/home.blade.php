@include('layouts.web-nav')

<x-home-layout>
    <div style="margin-top: 12%; margin-left: 10%">
        <main>
                <h1 style="color: white; font-size: xx-large;">
                    Welcome to LandSeek!
                </h1>

                <p style="color: white;">
                    LandSeek is a Digital Marketplace for Land Hunting <br>
                    Where you can find land properties with convenience <br>
                </p>

                <div style="margin-top: 20px;">
                    <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}" style="margin-right: 15px; padding: 10px; color: white; padding: 10px; border-radius: 5px; background-color: #1E2633;">
                        <i class="fa-solid fa-user-plus" style="margin-right: 5px;"></i> Get Started
                    </a>

                    <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}" style="margin-right: 15px; padding: 10px; color: white; padding: 10px; border-radius: 5px; background-color: #1E2633;">
                        <i class="fa-solid fa-sign-in-alt" style="margin-right: 5px;"></i> Login
                    </a>
                </div>
            </main>
    </div>
    
</x-home-layout>