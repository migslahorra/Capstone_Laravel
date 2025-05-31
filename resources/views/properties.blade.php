<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ 'LandSeek: ' . ucfirst(Auth::user()->role) . "'s List of Properties" }}
            </h2>

            <form method="GET" action="{{ route('properties') }}" class="flex space-x-2 items-center">
                <select name="filter" class="border border-gray-300 rounded px-3 py-1 focus:outline-none focus:ring focus:border-blue-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">
                    <option value="province" {{ request('filter') == 'province' ? 'selected' : '' }}>Province</option>
                    <option value="city" {{ request('filter') == 'city' ? 'selected' : '' }}>City</option>
                    <option value="barangay" {{ request('filter') == 'barangay' ? 'selected' : '' }}>Barangay</option>
                    <option value="price" {{ request('filter') == 'price' ? 'selected' : '' }}>Price Range</option>
                </select>

                <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}"
                       class="border border-gray-300 rounded px-3 py-1 focus:outline-none focus:ring focus:border-blue-300 dark:bg-gray-800 dark:text-white dark:border-gray-600">

                <button type="submit"
                        class="bg-blue-600 text-white font-semibold px-4 py-1 rounded hover:bg-blue-700 transition">
                    Search
                </button>
            </form>
        </div>
    </x-slot>

    {{-- Upload Property Button for Sellers --}}
    @auth
        @if (Auth::user()->role === 'Seller')
            <div>
                <a href="{{ route('upload.property.form') }}"
                   style="background-color: #1E2633; color: white; font-weight: bold; padding: 15px;
                          position: absolute; margin-left: 5%; margin-top: 2.5%; border-radius: 5px; border: 1px solid grey;">
                    <i class="fas fa-plus" style="margin-right: 10px; color: white;"></i>
                    Upload My Property
                </a>
            </div>

            {{-- Seller's Uploaded Properties --}}
            <div class="p-6 pb-32 mt-20" style="color: white; width: 90%; max-width: 900px;">
                <h3 class="text-lg font-bold mb-4" style="margin: 5%; position: absolute">My Uploaded Properties</h3>

                @php
                    $sellerProperties = $properties->where('user_id', Auth::id());
                @endphp

                @if ($sellerProperties->isEmpty())
                    <p>You haven't uploaded any properties yet.</p>
                @else
                    @foreach ($sellerProperties as $property)
                        <div class="mb-6 p-4 border rounded bg-gray-800" style="margin: 15%;">
                            @php
                                $images = json_decode($property->images, true);
                                $firstImage = $images[0] ?? null;
                            @endphp
                            @if ($firstImage)
                                <img src="{{ asset('storage/property_images/' . $firstImage) }}"
                                     alt="Property Image"
                                     style="max-height: 200px; object-fit: cover; border-radius: 5px; width: 100%; margin-bottom: 15px;">
                            @endif

                            <h3 class="text-lg font-semibold">{{ $property->title }}</h3>
                            <p>
                                <b>Address:</b> {{ $property->address }}<br>
                                <b>City:</b> {{ $property->city }}<br>
                                <b>Province:</b> {{ $property->province }} <br>
                                <b>Latitude:</b> {{ $property->latitude }}<br>
                                <b>Longitude:</b> {{ $property->longitude }}
                            </p>

                            <a href="{{ route('map', ['lat' => $property->latitude, 'lng' => $property->longitude]) }}">
                                <button type="button"
                                        style="background-color: green; padding: 5px 10px; border-radius: 5px; margin-top: 15px;">
                                    <i class="fa-solid fa-eye"></i> See in Map
                                </button>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    @endauth

    {{-- Display Properties for Buyers --}}
    @auth
        @if (Auth::user()->role === 'Buyer')
            <div class="p-6 pb-32" style="color: white; width: 90%; max-width: 900px; margin: auto;">
                @if ($properties->isEmpty())
                    <p>No properties found with coordinates.</p>
                @else
                    @foreach ($properties as $property)
                        <div class="mb-6 p-4 border rounded bg-gray-800">
                            {{-- Preview Image --}}
                            @php
                                $images = json_decode($property->images, true);
                                $firstImage = $images[0] ?? null;
                            @endphp
                            @if ($firstImage)
                                <img src="{{ asset('storage/property_images/' . $firstImage) }}"
                                     alt="Property Image"
                                     style="max-height: 200px; object-fit: cover; border-radius: 5px; width: 100%; margin-bottom: 15px;">
                            @endif

                            <h3 class="text-lg font-semibold">{{ $property->title }}</h3>
                            <p>
                                <b> <i class="fas fa-map-marker-alt" style="margin-right: 5px;"></i>Address:</b> {{ $property->address }}<br>
                                <b> <i class="fas fa-city" style="margin-right: 5px;"></i>City:</b> {{ $property->city }}<br>
                                <b> <i class="fas fa-map" style="margin-right: 5px;"></i>Province:</b> {{ $property->province }}
                            </p>
                            <p>
                                <b> <i class="fas fa-compass" style="margin-right: 5px;"></i>Latitude:</b> {{ $property->latitude }}<br>
                                <b> <i class="fas fa-compass" style="margin-right: 5px;"></i>Longitude:</b> {{ $property->longitude }}
                            </p>

                            <a href="{{ route('map', ['lat' => $property->latitude, 'lng' => $property->longitude]) }}">
                                <button type="button"
                                        style="background-color: green; padding: 5px 10px; border-radius: 5px; margin-top: 15px;">
                                    <i class="fa-solid fa-eye"></i> See in Map
                                </button>
                            </a>

                            <form action="{{ route('saved_properties', ['property' => $property->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit"
                                        style="background-color: #1E90FF; color: white; padding: 5px 10px; border-radius: 5px; margin-left: 10px;">
                                    <i class="fa-solid fa-bookmark"></i> Save Property
                                </button>
                            </form>
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    @endauth
</x-app-layout>
