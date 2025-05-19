
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        nav a:hover {
            border-bottom: 2px solid white;
        }
        .fa-house, .fa-circle-exclamation, .fa-phone, .fa-briefcase {
            margin-right: 5px;
        }
        .fa-binoculars {
            margin-left: 5px;
        }
    </style>
</head>

<nav style="background-color: #1E2633; padding: 20px; display: flex; align-items: center; justify-content: space-between;">
    <div>
        <h1 style="color: white; font-size: x-large;">
            LandSeek
        </h1>
        
        <p style="color: grey;">
            A Digital Marketplace for Land Hunting <i class="fa-solid fa-binoculars" style="color: white"></i>
        </p>
    </div>
    
    <div>
    <ul style="display: flex; color: white;">
        <li>
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}" style="margin-right: 15px; padding: 10px;">
                <i class="fa-solid fa-house"></i> Home
            </a>
        </li>
        <li>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}" style="margin-right: 15px; padding: 10px;">
            <i class="fa-solid fa-circle-exclamation"></i> About
            </a>
        </li>
        <li>
            <a href="{{ route('contacts') }}" class="{{ request()->routeIs('contacts') ? 'active' : '' }}" style="margin-right: 15px; padding: 10px;">
            <i class="fa-solid fa-phone"></i> Contacts
            </a>
        </li>
        <li>
            <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}" style="margin-right: 15px; padding: 10px;">
            <i class="fa-solid fa-briefcase"></i> Services
            </a>
        </li>
    </ul>
</div>
    
</nav>